<?php
namespace App\Http\Controllers\Backoffice;

/*
 * @Author      : Ferdhika Yudira
 * @Date        : 2020-07-18 14:17:32
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\MataPelajaran;
use App\Models\Jenjang;
use App\Models\Tingkat;
use App\Models\Kelas;
use App\Models\GuruMataPelajaran;
use App\Services\UploadService;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class ExternalUserController extends Controller{

    function __construct(){
        $this->middleware('permission:external-user-list|external-user-create|external-user-edit|external-user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:external-user-create', ['only' => ['create','store']]);
        $this->middleware('permission:external-user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:external-user-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.external-user';
        $this->routePath = 'backoffice::external-users';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable($request){
        $role = $request->role;
        $isPengunjung = $request->is_pengunjung;
        $query = ExternalUser::query();
        // relation with kelas and tingkat
        $query = $query->with('kelas.tingkat.jenjang', 'mataPelajarans', 'jenjang');

        if(!empty($role)){
            $query = $query->where('role', $role);
        }

        $query = $query->where('is_pengunjung', @$isPengunjung ?? 0);

        $dt = datatables()
        ->of($query)
        ->filter(function ($query) use ($request) {

            $role = $request->role;
            $isPengunjung = $request->is_pengunjung;

            $search = @$request->search['value'];

            if($search){
                
                $query->where('name', 'LIKE', '%'.$search.'%');
                $query->orWhere('nis', 'LIKE', '%'.$search.'%');
                
                $query->orWhereHas('mataPelajarans', function($query2) use ( $search ){
                    $query2->where('name', 'LIKE', '%'.$search.'%');
                });

                if(!empty($role)){
                    $query->where('role', $role);
                }
        
                $query->where('is_pengunjung', @$isPengunjung ?? 0);
            }
           
        })
        ->addIndexColumn()
        ->addColumn('show-img', function($data) {
            return view("components.datatable.image", [
                "url" => asset($data->photo)
            ]);
        })
        ->addColumn('show-status', function($data) {
            return view("components.datatable.status", [
                "route" => route($this->routePath.".update-status", $data->id),
                "text" => $data->status,
                "id" => $data->id,
                "role" => $data->role
            ]);
        })
        ->addColumn('mengajar', function($data) {
            $mapels = $data->mataPelajarans->pluck('name');

            $m = [];
            foreach($mapels as $idx){
                $m[] = $idx;
            }

            return view("components.datatable.wrapText", [
                "text" => (implode(', ', $m)),
            ]);
        })
        ->addColumn("created_at", function ($data) {
            $createdAt = new Carbon($data->created_at);

            return $createdAt->format("d-m-Y H:i:s");
        })
        ->addColumn("action", function ($data) {
            $actions = [
                "name" => $data->name,
                "deleteRoute" => route($this->routePath.".destroy", $data->id),
            ];

            if($data->is_pengunjung){
                $actions["enableMapelRoute"] = route($this->routePath.".enableMapel", $data->id).(\Request::get('role') ? "?role=".\Request::get('role') : "");
            }else{
                $actions["editRoute"] = route($this->routePath.".edit", $data->id).(\Request::get('role') ? "?role=".\Request::get('role') : "");
            }

            return view("components.datatable.actions", $actions);
        });

        $dt = $dt->order(function ($query) {
            $query->orderBy('created_at', 'desc');
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

        return view($this->prefix.'.index');
    }

    /**
     * Get tingkat
     */
    private function getTingkat(){
        // get list tingkat
        $tingkats = Tingkat::all();
        $tingkatList = [];
        $tingkatList[""] = "Pilih tingkat";

        foreach($tingkats as $tingkat){
            $tingkatList[$tingkat->id] = $tingkat->name . " " . @$tingkat->jenjang->name;
        }

        return $tingkatList;
    }

    /**
     * Get mata pelajaran
     */
    private function getMataPelajaran($guruId="", $jenjangId=null){
        // get list mapel
        $mapels = MataPelajaran::with('tingkat');

        if($jenjangId){
            $mapels = $mapels->whereHas('tingkat', function($q2) use($jenjangId) {
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

        foreach($mapels as $mapel){
            $mapelList[$mapel->id] = $mapel->name . " (Tingkat ".@$mapel->tingkat->name." ".@$mapel->tingkat->jenjang->name.")";
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

        return view($this->prefix.'.create', ['tingkatList' => $tingkatList, 'mapelList' => $mapelList, 'mapelIDS' => $mapelIDS]);
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
            'nis' => 'required|unique:external_users,nis',
            'name' => 'required',
            'email' => 'required|email|unique:external_users,email',
            // 'phone' => 'required|unique:external_users,phone',
            'password' => 'required',
        ]);

        if(@$request->role === "SISWA"){
            $this->validate($request, [
                'kelas_id' => 'required',
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = "AKTIF";
        $input['email_verified_at'] = now();
        $input['phone_verified_at'] = now();

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

        if(@$request->role === "GURU"){
            if(@$request->mapel && count($request->mapel) > 0){
                $user->mataPelajarans()->sync($request->mapel);
            }
        }

        return redirect()->route($this->routePath.'.index', ['role'=>$request->role])->with(
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

        $mapelIDS = [];
        foreach($dt->mataPelajarans as $mapel)
        {
            $mapelIDS[] = $mapel->id;
        }  

        return view($this->prefix.'.edit', ['data' => $dt, 'tingkatList' => $tingkatList, 'mapelList' => $mapelList, 'mapelIDS' => $mapelIDS]);
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
            'username' => 'required|unique:external_users,username,'.$id,
            'name' => 'required',
            'email' => 'required|email|unique:external_users,email,'.$id,
            // 'phone' => 'required|unique:external_users,phone,'.$id,
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
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
        $user->update($input);

        if(@$request->role === "GURU"){
            if(@$request->mapel){
                if(count(@$request->mapel) > 0){
                    $user->mataPelajarans()->sync($request->mapel);
                }
            }
        }

        return redirect()->route($this->routePath.'.index', ['role'=>$request->role])->with(
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

        return redirect()->route($this->routePath.'.index', ['role'=>$request->role])->with(
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
    public function destroy(Request $request, $id){
        $d = ExternalUser::findOrFail($id);
        $d->nis = "DEL_".date('Ymdhis');
        $d->username = "DEL_".date('Ymdhis')."_".$d->username;
        $d->email = "DEL_".date('Ymdhis')."@sample.id";
        $d->save();

        $d->delete();
    }

    /**
     * Bulk upload user from excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function batchImport(Request $request){
        return view($this->prefix.'.batch_upload');
    }

    /**
     * Bulk upload user from excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request){
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
                    $username = @$row["F"];
                    $password = @$row["G"];
                    $email = $row["H"];

                    // skip existing nis
                    if(ExternalUser::where('nis', $nis)->first()!==null){
                        continue;
                    }

                    // send password to email siswa
                    if(@$request->payload->sendEmail){
                        
                    }

                    // cek jenjang if not exist
                    $jenjangObject = Jenjang::firstOrCreate([
                        'name' => $jenjang,
                    ], [
                        'name' => $jenjang,
                        'description' => $jenjang.' from batch',
                        'status' => 'active',
                    ]);

                    // cek tingkat if not exist
                    $tingkatObject = Tingkat::firstOrCreate([
                        'name' => $tingkat,
                        'jenjang_id' => $jenjangObject->id,
                    ], [
                        'name' => $tingkat,
                        'description' => $tingkat.' from batch',
                        'status' => 'active',
                    ]);

                    // cek kelas if not exist
                    $kelasObject = Kelas::firstOrCreate([
                        'name' => $kelas,
                        'tingkat_id' => $tingkatObject->id,
                    ], [
                        'name' => $kelas,
                        'description' => $kelas.' from batch',
                        'status' => 'active',
                    ]);

                    // assign kelas id
                    if($kelasObject!==null){
                        $input['kelas_id'] = $kelasObject->id;
                    }

                    if(!$password){
                        $password = "123456"; // default password
                    }

                    $input['nis'] = $nis;
                    $input['name'] = $name;
                    $input['username'] = $name;
                    $input['email'] = $email;
                    if(@$phone){
                        $input['phone'] = $phone;
                        $input['phone_verified_at'] = now();
                    }
                    if(@$rombonganBelajar){
                        $input['rombongan_belajar'] = $rombonganBelajar;
                    }
                    $input['password'] = Hash::make($password);
                    $input['status'] = "AKTIF";
                    $input['role'] = "SISWA";
                    $input['email_verified_at'] = now();

                    $user = ExternalUser::create($input);
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

        $mapelList = $this->getMataPelajaran($id, @$dt->jenjang->id);

        $mapelIDS = [];
        foreach($dt->mataPelajaranGuests as $mapel)
        {
            $mapelIDS[] = $mapel->id;
        }  

        return view($this->prefix.'.enableMapel', ['data' => $dt, 'mapelList' => $mapelList, 'mapelIDS' => $mapelIDS]);
    }

    public function enableMapelUpdate(Request $request, $id){

        $this->validate($request, [
            'mapel' => 'required',
        ]);

        $user = ExternalUser::find($id);

        if(@$request->mapel){
            if(count(@$request->mapel) > 0){
                $user->mataPelajaranGuests()->sync($request->mapel);
            }
        }

        return redirect()->route($this->routePath.'.index', ['role'=> 'SISWA', 'is_pengunjung' => 1])->with(
            $this->success(__("External User updated successfully"), $user)
        );

    }
}
