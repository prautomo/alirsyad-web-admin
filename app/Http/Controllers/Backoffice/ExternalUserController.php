<?php

namespace App\Http\Controllers\Backoffice;

/*
 * @Author      : Ferdhika Yudira
 * @Date        : 2020-07-18 14:17:32
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ExternalUser;
use App\Models\MataPelajaran;
use App\Models\Jenjang;
use App\Models\Tingkat;
use App\Models\Kelas;
use App\Models\GuruMataPelajaran;
use App\Models\KelasSiswa;
use App\Services\UploadService;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ExternalUserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:external-user-list|external-user-create|external-user-edit|external-user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:external-user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:external-user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:external-user-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.external-user';
        $this->routePath = 'backoffice::external-users';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable($request)
    {
        $role = $request->role;
        $isPengunjung = $request->is_pengunjung;
        $query = ExternalUser::query();
        // relation with kelas and tingkat
        $query = $query->with(['kelas.tingkat.jenjang', 'mataPelajarans', 'jenjang', 'classHistory'])->select('external_users.*');
        
        if (!empty($role)) {
            $query = $query->where('role', $role);
        }

        $query = $query->where('is_pengunjung', @$isPengunjung ?? 0);

        // return response()->json($query->get(), 200);

        $dt = datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                $role = $request->role;
                $isPengunjung = $request->is_pengunjung;

                $search = @$request->search['value'];

                if ($search) {
                    $query = $query->where('name', 'LIKE', '%' . $search . '%');
                    $query = $query->orWhere('nis', 'LIKE', '%' . $search . '%');

                    if (!empty($role)) {
                        $query = $query->where('role', $role);
                        if($role == "GURU"){
                            if($query->has('mataPelajarans')){
                                $query = $query->orWhereHas('mataPelajarans', function ($query2) use ($search) {
                                    $query2->where('name', 'LIKE', '%' . $search . '%');
                                });
                            }
                        }else if($role == "SISWA"){
                            if($query->has('classHistory')){
                                $query = $query->orWhereHas('classHistory', function($query2) use ( $search ){
                                    $query2->where('is_current', 1)->where('tahun_ajaran', 'LIKE', '%'. $search. '%');
                                });
                            }
                        }
                    }

                    $query = $query->where('is_pengunjung', @$isPengunjung ?? 0);
                }
            })
            ->addIndexColumn()
            ->addColumn('show-img', function ($data) {
                return view("components.datatable.image", [
                    "url" => asset($data->photo)
                ]);
            })
            ->addColumn('show-status', function ($data) {
                return view("components.datatable.status", [
                    "route" => route($this->routePath . ".update-status", $data->id),
                    "text" => $data->status,
                    "id" => $data->id,
                    "role" => $data->role
                ]);
            })
            ->addColumn('mengajar', function ($data) {
                if($data->role == 'GURU'){
                    $mapels = $data->mataPelajarans;

                    $m = [];
                    foreach ($mapels as $value) {
                        $m[] = $value->name . " (" . @$value->tingkat->name . " " . @$value->tingkat->jenjang->name . ")";
                    }
    
                    return view("components.datatable.wrapText", [
                        "text" => (implode(', ', $m)),
                    ]);
                }
                return "";
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
            })
            ->addColumn("tahun_ajaran", function ($data) {
                $current_class = KelasSiswa::where(['siswa_id' => $data->id, 'is_current' => 1])->first();

                if($current_class != null){
                    return $current_class->tahun_ajaran;
                }

                return "";
            })
            ->addColumn("action", function ($data) {
                $actions = [
                    "name" => $data->name,
                    "deleteRoute" => route($this->routePath . ".destroy", $data->id),
                    "generateQR" => $this->generateQRCode($data->id),
                ];

                if ($data->is_pengunjung) {
                    $actions["enableMapelRoute"] = route($this->routePath . ".enableMapel", $data->id) . (\Request::get('role') ? "?role=" . \Request::get('role') : "");
                } else {
                    $actions["editRoute"] = route($this->routePath . ".edit", $data->id) . (\Request::get('role') ? "?role=" . \Request::get('role') : "");
                }

                return view("components.datatable.actions", $actions);
            })
            ->filterColumn('mengajar', function($query, $value) {
                $value = preg_replace('/[^\p{L}\p{N}\s]/u', '', $value);
                // format eg: Tematik 1 SD -> value[0] = mapel, value[1] = tingkat, value[2] = jenjang
                $value = explode(" ", $value);
                $query->orWhereHas('mataPelajarans', function ($query2) use ($value) {
                    $query2->where('name', '=',  $value[0])
                        ->whereHas('tingkat', function ($query2) use ($value) {
                            $query2->where('name', '=',  $value[1]);
                        })
                        ->whereHas('tingkat.jenjang', function ($query2) use ($value) {
                            $query2->where('name', '=',  $value[2]);
                        });
                });
            })
            ->filterColumn('tahun_ajaran', function($query, $value) {
                $value = preg_replace('/[^A-Za-z0-9]/', '', $value);
                $query = $query->orWhereHas('classHistory', function($query2) use ( $value ){
                    $query2->where('is_current', 1)->where('tahun_ajaran', 'LIKE', '%'. $value. '%');
                });
            });

        $dt = $dt->order(function ($query) {
            $query->orderBy('external_users.created_at', 'desc');
        })->toJson();

        return $dt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->datatable($request);
        }

        return view($this->prefix . '.index');
    }

    /**
     * Get tingkat
     */
    private function getTingkat()
    {
        // get list tingkat
        $tingkats = Tingkat::all();
        $tingkatList = [];
        $tingkatList[""] = "Pilih tingkat";

        foreach ($tingkats as $tingkat) {
            $tingkatList[$tingkat->id] = $tingkat->name . " " . @$tingkat->jenjang->name;
        }

        return $tingkatList;
    }

    /**
     * Get mata pelajaran
     */
    private function getMataPelajaran($guruId = "", $jenjangId = null)
    {
        // get list mapel
        $mapels = MataPelajaran::with('tingkat');

        if ($jenjangId) {
            $mapels = $mapels->whereHas('tingkat', function ($q2) use ($jenjangId) {
                $q2->where('jenjang_id', $jenjangId);
            });
        }

        // // filter kalo mapel nya udah ada yg ngajar
        // $guruMengajar = GuruMataPelajaran::get();
        // // for edit
        // if(@$guruId){
        //     $guruMengajar = GuruMataPelajaran::where('guru_id', '!=', $guruId)->get();
        // }
        // $guruMengajar = $guruMengajar->pluck('mata_pelajaran_id');
        // $mapels = $mapels->whereNotIn('id', $guruMengajar);

        $mapels = $mapels->get();

        $mapelList = [];

        foreach ($mapels as $mapel) {
            $mapelList[$mapel->id] = $mapel->name . " (Tingkat " . @$mapel->tingkat->name . " " . @$mapel->tingkat->jenjang->name . ")";
        }

        return $mapelList;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tingkatList = $this->getTingkat();
        $mapelList = $this->getMataPelajaran();
        $mapelIDS = [];
        $isUploader = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        return view($this->prefix . '.create', ['tingkatList' => $tingkatList, 'mapelList' => $mapelList, 'mapelIDS' => $mapelIDS, 'isUploader' => $isUploader]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:external_users,username',
            'nis' => 'required|unique:external_users,nis|unique:users,username',
            'name' => 'required',
            'email' => 'required|email|unique:external_users,email|unique:users,email',
            // 'phone' => 'required|unique:external_users,phone',
            'password' => 'required',
        ]);

        if (@$request->role === "SISWA") {
            $this->validate($request, [
                'kelas_id' => 'required',
            ]);
        }

        $input = $request->except(['tahun_ajaran']);
        $input['password'] = Hash::make($input['password']);
        $input['status'] = "AKTIF";
        $input['email_verified_at'] = now();
        $input['phone_verified_at'] = now();
        $input['uuid'] = (string) Str::uuid();

        if ($request->hasFile('photo')) {

            $validated = $request->validate([
                'photo' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('photo');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'images/external_users');
            $input['photo'] = $url;
        }

        $user = ExternalUser::create($input);

        if (@$request->role === "GURU") {

            if ($request->is_uploader) {
                // insert ke table user jadi guru uploader
                $inputUploader['name'] = $input['name'];
                $inputUploader['username'] = $input['nis'];
                $inputUploader['email'] = $input['email'];
                $inputUploader['password'] = $input['password'];

                $guruUploader = User::create($inputUploader);
                $guruUploader->assignRole("Guru Uploader");
            }

            if (@$request->mapel && count($request->mapel) > 0) {
                // guru
                $user->mataPelajarans()->sync($request->mapel);
                // giuru uplaoder
                if ($request->is_uploader) {
                    $guruUploader->mataPelajarans()->sync($request->mapel);
                }
            }
        }else if(@$request->role === "SISWA"){
            KelasSiswa::create([
                'kelas_id' => $request->kelas_id,
                'siswa_id' => $user->id,
                'tahun_ajaran' => (string) $request->tahun_ajaran
            ]);
        }

        return redirect()->route($this->routePath . '.index', ['role' => $request->role])->with(
            $this->success(__("External User created successfully"), $user)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dt = ExternalUser::with('kelas')->findOrFail($id);
        $tingkatList = $this->getTingkat();
        $mapelList = $this->getMataPelajaran($id);

        $dt['tahun_ajaran'] = "";
        $current_class = KelasSiswa::where([
            'siswa_id' => $id,
            'is_current' => 1
        ])->first();

        if($current_class != null){
            $dt['tahun_ajaran'] = $current_class->tahun_ajaran;
        }

        $mapelIDS = [];
        foreach ($dt->mataPelajarans as $mapel) {
            $mapelIDS[] = $mapel->id;
        }

        $isUploader = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        return view($this->prefix . '.edit', ['data' => $dt, 'tingkatList' => $tingkatList, 'mapelList' => $mapelList, 'mapelIDS' => $mapelIDS, 'isUploader' => $isUploader]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:external_users,username,' . $id,
            'nis' => 'required|unique:external_users,nis,' . $id,
            'name' => 'required',
            'email' => 'required|email|unique:external_users,email,' . $id,
            // 'phone' => 'required|unique:external_users,phone,'.$id,
        ]);

        $input = $request->except(['tahun_ajaran']);
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if ($request->hasFile('photo')) {

            $validated = $request->validate([
                'photo' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('photo');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'images/external_users');
            $input['photo'] = $url;
        }

        $user = ExternalUser::find($id);

        if (@$request->role === "GURU") {
            // update ke table user jadi guru uploader
            if ($request->is_uploader || @$user->is_uploader) {
                $gu = User::where('username', $user->nis)->first();

                $this->validate($request, [
                    'nis' => 'required|unique:users,username,' . @$gu->id,
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . @$gu->id,
                    // 'phone' => 'required|unique:external_users,phone,'.$gu->id,
                ]);

                $inputUploader['name'] = $input['name'];
                $inputUploader['username'] = $input['nis'];
                $inputUploader['email'] = $input['email'];

                if (!empty($input['password'])) {
                    $inputUploader['password'] = $input['password'];
                }

                $guruUploader = User::find(@$gu->id);
                if ($guruUploader) {
                    $guruUploader->update($inputUploader);
                } else {
                    $inputUploader['password'] = $user->password;
                    $guruUploader = User::create($inputUploader);
                    $guruUploader->assignRole("Guru Uploader");
                }

                if (@$request->mapel) {
                    if (count(@$request->mapel) > 0) {
                        // giuru uplaoder
                        $guruUploader->mataPelajarans()->sync($request->mapel);
                    }
                }
            }
        }

        $user->update($input);

        if (@$request->role === "GURU") {
            if (@$request->mapel) {
                if (count(@$request->mapel) > 0) {
                    // guru
                    $user->mataPelajarans()->sync($request->mapel);
                }
            }
        }else if(@$request->role === "SISWA"){
            $current_class = KelasSiswa::where([
                'siswa_id' => $id,
                'is_current' => 1
            ])->first();

            if($current_class != null){
                if($current_class->kelas_id == $user->kelas_id){
                    $current_class->update(['tahun_ajaran' => $request->tahun_ajaran]);
                }else{
                    KelasSiswa::create([
                        'kelas_id' => $user->kelas_id,
                        'siswa_id' => $user->id,
                        'tahun_ajaran' => (string) $request->tahun_ajaran
                    ]);
                    $current_class->update(['is_current' => 0]);
                }
            }else{
                KelasSiswa::create([
                    'kelas_id' => $user->kelas_id,
                    'siswa_id' => $user->id,
                    'tahun_ajaran' => (string) $request->tahun_ajaran
                ]);
            }
        }

        return redirect()->route($this->routePath . '.index', ['role' => $request->role])->with(
            $this->success(__("External User updated successfully"), $user)
        );
    }

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $input = $request->only(['status']);
        $user = ExternalUser::find($id);
        $user->update($input);

        return redirect()->route($this->routePath . '.index', ['role' => $request->role])->with(
            $this->success(__("Status updated successfully"), $user)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request, $id)
    // {
    //     ExternalUser::find($id)->delete();

    //     return redirect()->route($this->routePath.'.index', ['role'=>$request->role])->with(
    //         $this->success(__("User deleted successfully"), $data)
    //     );
    // }
    public function destroy(Request $request, $id)
    {
        $d = ExternalUser::findOrFail($id);
        $dU1 = User::where('username', $d->nis)->first();
        $d->nis = "DEL_" . date('Ymdhis');
        $d->username = "DEL_" . date('Ymdhis') . "_" . $d->username;
        $d->email = "DEL_" . date('Ymdhis') . "@sample.id";
        $d->save();
        $d->delete();

        $dU = User::find(@$dU1->id);
        if ($dU) {
            $dU->username = "DEL_" . date('Ymdhis') . "_" . $d->username;
            $dU->email = "DEL_" . date('Ymdhis') . "@sample.id";
            $dU->save();
            $dU->delete();
        }
    }

    /**
     * Bulk upload user from excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function batchImport(Request $request)
    {
        return view($this->prefix . '.batch_upload');
    }

    /**
     * Bulk upload user from excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        try {
            return DB::transaction(function ()  use ($request) {

                // loop every row
                foreach ($request->data as $key => $row) {
                    // assign init data
                    $nis = $row["A"];
                    $name = $row["B"];
                    $jenjang = $row["C"];
                    $tingkat = $row["D"];
                    $kelas = @$row["E"];
                    $tahun_ajaran = @$row["F"];
                    $username = @$row["G"];
                    $password = @$row["H"];
                    $email = $row["I"];

                    // skip existing nis
                    if (ExternalUser::where('nis', $nis)->first() !== null) {
                        continue;
                    }

                    // send password to email siswa
                    if (@$request->payload->sendEmail) { }

                    // cek jenjang if not exist
                    $jenjangObject = Jenjang::firstOrCreate([
                        'name' => $jenjang,
                    ], [
                        'name' => $jenjang,
                        'description' => $jenjang . ' from batch',
                        'status' => 'active',
                    ]);

                    // cek tingkat if not exist
                    $tingkatObject = Tingkat::firstOrCreate([
                        'name' => $tingkat,
                        'jenjang_id' => $jenjangObject->id,
                    ], [
                        'name' => $tingkat,
                        'description' => $tingkat . ' from batch',
                        'status' => 'active',
                    ]);

                    // cek kelas if not exist
                    $kelasObject = Kelas::firstOrCreate([
                        'name' => $kelas,
                        'tingkat_id' => $tingkatObject->id,
                    ], [
                        'name' => $kelas,
                        'description' => $kelas . ' from batch',
                        'status' => 'active',
                    ]);

                    // assign kelas id
                    if ($kelasObject !== null) {
                        $input['kelas_id'] = $kelasObject->id;
                    }

                    if (!$password) {
                        $password = "Siswa123"; // default password
                    }

                    $input['nis'] = $nis;
                    $input['name'] = $name;
                    $input['username'] = $name;
                    $input['email'] = $email;
                    if (@$phone) {
                        $input['phone'] = $phone;
                        $input['phone_verified_at'] = now();
                    }
                    if (@$rombonganBelajar) {
                        $input['rombongan_belajar'] = $rombonganBelajar;
                    }
                    $input['password'] = Hash::make($password);
                    $input['status'] = "AKTIF";
                    $input['role'] = "SISWA";
                    $input['email_verified_at'] = now();
                    $input['uuid'] = (string) Str::uuid();

                    $user = ExternalUser::create($input);
                    
                    KelasSiswa::create([
                        'kelas_id' => $user->kelas_id,
                        'siswa_id' => $user->id,
                        'tahun_ajaran' => (string) $tahun_ajaran
                    ]);
                    
                }

                return $this->returnData([], "Data Berhasil Di Upload");
            });
        } catch (\Throwable $th) {
            return $this->returnError($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function enableMapel($id)
    {
        $dt = ExternalUser::with('kelas')->findOrFail($id);

        $jenjangId = @$dt->jenjang->id;

        // get list group mapel 
        $mapels = MataPelajaran::with('tingkat');

        if ($jenjangId) {
            $mapels = $mapels->whereHas('tingkat', function ($q2) use ($jenjangId) {
                $q2->where('jenjang_id', $jenjangId);
            });
        }

        $mapels = $mapels->get();

        $groupMapelList = [];
        foreach ($mapels as $mapel) {

            $textTingkat = "Tingkat " . @$mapel->tingkat->name . " " . @$mapel->tingkat->jenjang->name;
            $idxSearch = array_search("Semua " . @$textTingkat, array_column($groupMapelList, 'text'));

            // belum ada
            if ($idxSearch === false) {
                array_push($groupMapelList, [
                    'id' => $mapel->tingkat_id,
                    'text' => "Semua " . @$textTingkat,
                    'children' => [[
                        'id' => $mapel->id,
                        'text' => @$mapel->name . " (" . $textTingkat . ")",
                    ]],
                ]);
            } else {
                // udah ada
                array_push($groupMapelList[$idxSearch]['children'], [
                    'id' => $mapel->id,
                    'text' => @$mapel->name . " (" . $textTingkat . ")",
                ]);
            }
        }

        $mapelIDS = [];
        foreach ($dt->mataPelajaranGuests as $mapel) {
            $mapelIDS[] = $mapel->id;
        }

        return view($this->prefix . '.enableMapel', ['data' => $dt, 'mapelList' => $groupMapelList, 'mapelIDS' => $mapelIDS]);
    }

    public function enableMapelUpdate(Request $request, $id)
    {

        $this->validate($request, [
            'mapel' => 'required',
        ]);

        $user = ExternalUser::find($id);

        $user->status = "AKTIF";
        $user->save();

        if (@$request->mapel) {
            if (count(@$request->mapel) > 0) {
                $user->mataPelajaranGuests()->sync($request->mapel);
            }
        }

        return redirect()->route($this->routePath . '.index', ['role' => 'SISWA', 'is_pengunjung' => 1])->with(
            $this->success(__("External User updated successfully"), $user)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nextGrade()
    {
        // dd("test");
        $tingkatList = $this->getTingkat();

        $listKelas = Kelas::orderBy('tingkat_id')->get();

        $groupKelasList = [];
        foreach ($listKelas as $kelas) {
            $textTingkat = "Tingkat " . @$kelas->tingkat->name. " " . @$kelas->tingkat->jenjang->name;

            $idxSearch = array_search(@$textTingkat, array_column($groupKelasList, 'text'));

            // belum ada
            if ($idxSearch === false) {
                array_push($groupKelasList, [
                    'id' => $kelas->tingkat->id,
                    'text' => $textTingkat,
                    'children' => [[
                        'id' => $kelas->id,
                        'text' => @$kelas->name,
                    ]],
                ]);
            } else {
                // udah ada
                array_push($groupKelasList[$idxSearch]['children'], [
                    'id' => $kelas->id,
                    'text' => @$kelas->name,
                ]);
            }
        }

        // return view($this->prefix . '.next-grade', ['title' => 'Naik Kelas', 'tingkatList' => $tingkatList, 'groupContentList' => $groupContentList, 'contentIDS' => $contentIDS, 'form_mode' => 'create', 'content' => $request->query('content')]);
        return view($this->prefix . '.next_grade', ['title' => 'Naik Kelas', 'tingkatList' => $tingkatList, 'groupKelasList' => $groupKelasList, 'role' => 'SISWA']);
    }
    
    public function listSiswaJson(Request $request){
        $datas = ExternalUser::where('kelas_id', $request->q_kelas_id)->get();

        return response()->json($datas, 200);
    }

    public function nextGradeUpdate(Request $request)
    {
        $this->validate($request, [
            'prev_tingkat_id' => 'required',
            'prev_kelas_id' => 'required',
            'next_tingkat_id' => 'required',
            'next_kelas_id' => 'required',
            'selected_student_list' => 'required',
        ]);

        $selected_students = explode(',', $request->selected_student_list);
        foreach($selected_students as $selected_student){
            $current_class = KelasSiswa::where(['siswa_id' => $selected_student, 'is_current' => 1])->first();
            $siswa = ExternalUser::find($selected_student);

            if($current_class != null){
                $new_school_year = ((int) $current_class->tahun_ajaran) + 1;
                
                KelasSiswa::create([
                    'kelas_id' => $request->next_kelas_id,
                    'siswa_id' => $selected_student,
                    'tahun_ajaran' => (string) $new_school_year
                ]);
                
                $current_class->update(['is_current' => 0]);
                $siswa->update(['kelas_id' => $request->next_kelas_id]);
            }
        }

        return redirect()->route($this->routePath . '.index', ['role' => 'SISWA'])->with(
            $this->success(__("Next graded successfully"))
        );
    }

    // development purpose only (just ONE hit)
    public function initKelasSiswa(Request $request){
        $datas = ExternalUser::where('role', "SISWA")->whereNotNull('kelas_id')->get();

        if($request->secret_key != null){
            if($request->secret_key == "@dev_Dib_naik_kelas_secret_key_432589"){
                foreach($datas as $data){
                    KelasSiswa::create([
                        'kelas_id' => $data->kelas_id,
                        'siswa_id' => $data->id,
                        'tahun_ajaran' => "2022"
                    ]);
                }
        
                return response()->json("Success init data kelas siswa.", 200);
            }
        }
    }

    public function generate_uuid(){
        $external_users = ExternalUser::all();

        foreach($external_users as $user){
            $new_id = (string) Str::uuid();
            $user->update(['uuid' => $new_id]);
        }
        
        return response()->json("Success generate uuid.", 200);
    }

    public function generateQRCode ($id)
    {
        $user = ExternalUser::findOrFail($id);
        $qrcode = QrCode::size(250)->generate(json_encode(['uuid' => $user->uuid]));

        $data = [
            'name' => $user->name, 
            'nis' => $user->nis, 
            'tingkat' => $user->kelas_id ? $user->kelas->tingkat->name . $user->kelas->name : '',
            'qrcode' => (string) $qrcode
        ];
        $data = json_encode($data);

        return $data;
    }
}
