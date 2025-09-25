<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Services\UploadService;
use App\Models\Modul;
use App\Models\MataPelajaran;
use App\Models\Tingkat;
use App\Models\Update;
use App\Models\UploaderMataPelajaran;
use App\Helpers\ExtractArchive;
use App\Helpers\GenerateSlug;
use App\Models\ExternalUser;
use App\Models\GuruMataPelajaran;
use App\Models\Jenjang;
use App\Traits\LogActivityTrait;
use App\Constants\LogActivityConst;

class ModulController extends Controller
{
    use LogActivityTrait;

    function __construct()
    {
        $this->middleware('permission:modul-list|modul-create|modul-edit|modul-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:modul-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:modul-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:modul-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.moduls';
        $this->routePath = 'backoffice::moduls';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request)
    {
        $query = Modul::query();
        $query = $query->with('mataPelajaran.tingkat.jenjang');
        $query = $this->filterQueryByRole($query);

        $datas = $query->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {
                $search = @$request->search['value'];
                $visibilitas = $request->visibilitas;
                $jenjang_id = $request->jenjang_id;
                $tingkat_id = $request->tingkat_id;
                $mata_pelajaran_id = $request->mata_pelajaran_id;
                $isSubBab = $request->is_subbab;

                if($visibilitas){
                    $query = $query->where(['is_visible' => $visibilitas]);
                }

                if($isSubBab){
                    $query = $query->where(['is_subbab' => $isSubBab]);
                }

                if($jenjang_id){
                    $query = $query->whereHas('mataPelajaran.tingkat.jenjang', function ($query2) use ($jenjang_id) {
                        $query2->where('id', '=',  $jenjang_id);
                    });
                }

                if($tingkat_id){
                    $query = $query->whereHas('mataPelajaran.tingkat', function ($query2) use ($tingkat_id) {
                        $query2->where('id', '=',  $tingkat_id);
                    });
                }

                if($mata_pelajaran_id){
                    $query = $query->whereHas('mataPelajaran', function ($query2) use ($mata_pelajaran_id) {
                        $query2->where('id', '=',  $mata_pelajaran_id);
                    });
                }

                if ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');

                        $query = $query->orWhereHas('mataPelajaran.tingkat.jenjang', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });

                        $query = $query->orWhereHas('mataPelajaran.tingkat', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });

                        $query = $query->orWhereHas('mataPelajaran', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });
                    });
                }

                // query param mapel id
                if (@$request->mata_pelajaran_id) $query->where('mata_pelajaran_id', @$request->mata_pelajaran_id);
            })
            ->addIndexColumn()
            ->addColumn('show-img', function ($data) {
                if (empty($data->icon)) {
                    return "not available";
                } else {
                    return view("components.datatable.image", [
                        "url" => asset($data->icon)
                    ]);
                }
            })
            ->addColumn("jenjang", function ($data) {
                return @$data->mataPelajaran->tingkat->jenjang ? $data->mataPelajaran->tingkat->jenjang->name : '-';
            })
            ->addColumn("tingkat", function ($data) {
                return @$data->mataPelajaran->tingkat ? $data->mataPelajaran->tingkat->name : '-';
            })
            ->addColumn("mapel", function ($data) {
                $mapel = @$data->mataPelajaran->name ? $data->mataPelajaran->name : 'none';
                $mapelID = @$data->mataPelajaran->id ? $data->mataPelajaran->id : '';

                return view("components.datatable.link", [
                    "link" => route($this->routePath . ".index") . "?mata_pelajaran_id=" . $mapelID,
                    "text" => $mapel,
                ]);
                return $mapel;
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
            })
            ->addColumn("created_by", function ($data) {
                return @$data->uploader->name ?? "-";
            })
            ->addColumn("visibilitas", function ($data) {
                return @$data->is_visible ? 'Tampilkan': 'Sembunyikan';
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'modul',
                    "class" => $data->class,
                    "deleteRoute" => route($this->routePath . ".destroy", $data->id),
                    "editRoute" => route($this->routePath . ".edit", $data->id),
                    "viewPdfRoute" => asset($data->pdf_path),
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
            })
            ->toJson();
    }

    private function getMapelIdsUser()
    {
        // WH 23/05/24 - Covered guru uploader as guru mapel
        // $userId = @\Auth::user()->id;
        // $mapelIdsUser = UploaderMataPelajaran::where('guru_uploader_id', $userId)->pluck('mata_pelajaran_id')->all();

        $userEmail = @\Auth::user()->email;
        $user = ExternalUser::where(['email' => $userEmail, 'deleted_at' => null])->first();

        $mapelIdsUser = GuruMataPelajaran::where('guru_id', $user->id)->pluck('mata_pelajaran_id')->all();
        $mapelIdsUser = count($mapelIdsUser) > 0 ? $mapelIdsUser : [];

        return $mapelIdsUser;
    }

    private function filterQueryByRole($query){
        $activeRole = Session::get('activeRole');
        $extUser = ExternalUser::where(['email' => @\Auth::user()->email])->first();

        if($activeRole != null){
            if ($activeRole == "Guru Mata Pelajaran" || $activeRole == "Guru Uploader") {
                $mapelIdsUser = $this->getMapelIdsUser();
                $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
            }else if($activeRole == "Wali Kelas"){
                $kelas = Kelas::where(['wali_kelas_id' => $extUser->id])->first();
                $query = $query->whereHas('mataPelajaran.tingkat', function ($query2) use ($kelas) {
                    $query2->where('id', '=',  $kelas->tingkat_id);
                });
            }else if($activeRole == "Kepala Sekolah"){
                $jenjang = Jenjang::where(['kepala_sekolah_id' => $extUser->id])->first();
                $query = $query->whereHas('mataPelajaran.tingkat.jenjang', function ($query2) use ($jenjang) {
                    $query2->where('id', '=',  $jenjang->id);
                });
            }
        }else{
            $authUserRole = Auth::user()->roles->pluck('name')->toArray();

            if (in_array("Guru Mata Pelajaran", $authUserRole) || in_array("Guru Uploader", $authUserRole)) {
                $mapelIdsUser = $this->getMapelIdsUser();
                $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
            }else if(in_array("Wali Kelas", $authUserRole)){
                $kelas = Kelas::where(['wali_kelas_id' => $extUser->id])->first();
                $query = $query->whereHas('mataPelajaran.tingkat', function ($query2) use ($kelas) {
                    $query2->where('id', '=',  $kelas->tingkat_id);
                });
            }else if(in_array("Kepala Sekolah", $authUserRole)){
                $jenjang = Jenjang::where(['kepala_sekolah_id' => $extUser->id])->first();
                $query = $query->whereHas('mataPelajaran.tingkat.jenjang', function ($query2) use ($jenjang) {
                    $query2->where('id', '=',  $jenjang->id);
                });
            }
        }
        return $query;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->datatable($request);
        }

        return view($this->prefix . '.index');
    }

    /**
     * Get mata pelajaran
     */
    private function getMataPelajaran()
    {
        // get list mapel
        $mapels = MataPelajaran::with('tingkat');

        // filter kalo rolenya guru uploader (khusus mapel aja)
        // kalo bukan superadmin, tambahin filter by mapel na
        if (!@\Auth::user()->hasRole('Superadmin')) {
            $mapelIdsUser = $this->getMapelIdsUser();
            $mapels = $mapels->whereIn('id', $mapelIdsUser);
        }

        $mapels = $mapels->get();

        $mapelList = [];
        $mapelList[""] = "Pilih mata pelajaran";

        foreach ($mapels as $mapel) {
            $mapelList[$mapel->id] = $mapel->name . " (Tingkat " . @$mapel->tingkat->name . " " . @$mapel->tingkat->jenjang->name . ")";
        }

        return $mapelList;
    }

    private function getSemester()
    {
        $semesterList = [];
        $semesterList[""] = "Pilih semester";

        $semesterList[1] = "1";
        $semesterList[2] = "2";

        return $semesterList;
    }

    public function create()
    {

        $mapelList = $this->getMataPelajaran();
        $semesterList = $this->getSemester();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        return view($this->prefix . '.create', ['mapelList' => $mapelList, 'semesterList' => $semesterList, 'showUpdate' => $show]);
    }

    public function store(Request $request)
    {
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'mata_pelajaran_id' => 'required',
            'modul' => 'required|file|mimes:pdf',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);

        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['name', 'icon', 'description', 'mata_pelajaran_id', 'slug', 'semester', 'tahun_ajaran', 'urutan', 'is_visible', 'is_subbab']);
        $dataReq['uploader_id'] = \Auth::user()->id;

        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);
            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/modul');
            $dataReq['icon'] = $url;
        }

        if ($request->hasFile('modul')) {
            $fileModul = $request->file('modul');
            $extension = $fileModul->extension();
            $url = UploadService::uploadFile($fileModul, 'uploads/modul');
            $dataReq['pdf_path'] = $url;
        }

        $data = Modul::create($dataReq);

        // log create activity
        $this->logActivity(
            LogActivityConst::ACTION_TYPE_CREATE,
            'Create Modul ' . $data->name,
            LogActivityConst::MODULE_MODUL,
            $data->id,
            null,
            $data->toArray()
        );

        if (empty($request->slug)) {
            $data->slug = GenerateSlug::generateSlug($data->id, $data->name);
            $data->save();
        }

        if (@$request->showUpdate) {

            Modul::where('id', $data->id)->update(['show_update' => 1]);

            $coverUpdate = "";
            if ($request->hasFile('cover_update')) {
                $validated = $request->validate([
                    'cover_update' => 'mimes:jpeg,png|max:2028',
                ]);

                $image = $request->file('cover_update');
                $extension = $image->extension();
                $url = UploadService::uploadImage($image, 'icon/cover_update');

                $coverUpdate = $url;
            }
            // asalnya error $dt (var not found, diubah jadi $data)
            $this->insertToUpdateLog($data, $coverUpdate, 'create');
        }

        return redirect()->route($this->routePath . '.index')->with(
            $this->success(__("Success to create Modul"), $data)
        );
    }

    public function edit(Request $request, $id)
    {
        $dt = Modul::with('mataPelajaran')->findOrFail($id);
        $mapelList = $this->getMataPelajaran();
        $semesterList = $this->getSemester();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        // last update data
        $update = Update::where(['trigger' => 'modul', 'trigger_id' => $id])->orderBy('created_at', 'desc')->first();

        return view($this->prefix . '.edit', ['data' => $dt, 'mapelList' => $mapelList, 'semesterList' => $semesterList, 'showUpdate' => $show, 'update' => $update]);
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'slug' => 'unique:mata_pelajarans,slug,' . $id,
            'name' => 'required|string',
            'mata_pelajaran_id' => 'required',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);

        $dataReq = $request->only(['name', 'icon', 'description', 'mata_pelajaran_id', 'slug', 'semester', 'tahun_ajaran', 'urutan', 'is_visible', 'is_subbab']);
        
        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/modul');

            $dataReq['icon'] = $url;
        }

        if ($request->hasFile('modul')) {
            $fileModul = $request->file('modul');
            $extension = $fileModul->extension();
            $url = UploadService::uploadFile($fileModul, 'uploads/modul');
            $dataReq['pdf_path'] = $url;
        }

        if (empty($request->slug)) {
            $dataReq['slug'] = GenerateSlug::generateSlug($id, $request->name);
        }

        $dt = Modul::findOrFail($id);
        $before = $dt->toArray();
        $dt->update($dataReq);

        $this->logActivity(
            LogActivityConst::ACTION_TYPE_UPDATE,
            'Update Modul ' . $dt->name,
            LogActivityConst::MODULE_MODUL,
            $dt->id,
            $before,
            $dt->toArray()
        );

        if (@$request->showUpdate) {

            $dt = Modul::where('id', $id)->update(['show_update' => 1]);

            $coverUpdate = "";
            if ($request->hasFile('cover_update')) {
                $validated = $request->validate([
                    'cover_update' => 'mimes:jpeg,png|max:2028',
                ]);

                $image = $request->file('cover_update');
                $extension = $image->extension();
                $url = UploadService::uploadImage($image, 'icon/cover_update');

                $coverUpdate = $url;
            } else {
                // last update data
                $update = Update::where(['trigger' => 'modul', 'trigger_id' => $id])->orderBy('created_at', 'desc')->first();

                $coverUpdate = @$update->logo;
            }
            $this->insertToUpdateLog(Modul::findOrFail($id), $coverUpdate, 'update', 1);
        } else {
            $dt = Modul::where('id', $id)->update(['show_update' => 0]);
            // last update data
            $update = Update::where(['trigger' => 'modul', 'trigger_id' => $id])->orderBy('created_at', 'desc')->first();
            $this->insertToUpdateLog(Modul::findOrFail($id), @$update->logo, 'update', 0);
        }

        return redirect()->route($this->routePath . '.index')->with(
            $this->success(__("Success to update Modul"), $dt)
        );
    }

    public function destroy(Request $request, $id)
    {
        $delete_update = Update::where(['trigger' => 'modul', 'trigger_id' => $id])->delete();
        $d = Modul::findOrFail($id);
        $before = $d->toArray();

        $d->delete();

        $this->logActivity(
            LogActivityConst::ACTION_TYPE_DELETED,
            'Delete Modul ' . $d->name,
            LogActivityConst::MODULE_MODUL,
            $id,
            $before,
            null
        );
    }

    /**
     * Insert to update log
     *
     * @param  \App\Models\Modul  $modul
     * @param  String  $type
     * @return void
     */
    private function insertToUpdateLog(Modul $modul, $cover, $type, $visible = 1)
    {
        $data = [
            'trigger_event' => @$type ?? 'other',
            'trigger' => 'modul',
            'trigger_id' => @$modul->id,
            'trigger_name' => @$modul->name,
            'mata_pelajaran' => @$modul->mataPelajaran->name,
            'tingkat_id' => @$modul->mataPelajaran->tingkat_id,
            'mata_pelajaran_id' => @$modul->mataPelajaran->id,
            'visible' => @$visible,
        ];

        if ($cover) {
            $data['logo'] = $cover;
        }

        if (Update::where(['trigger_id' => @$modul->id, 'trigger' => "modul"])) {
            Update::where(['trigger_id' => @$modul->id, 'trigger' => "modul"])->delete();
        }

        Update::create($data);
    }
    
    public function filterCol(Request $request)
    {
        $params_origin = '';
        $data = [
            [
                'label' => 'Visibilitas',
                'name' => 'visibilitas',
                'param' => 'visibilitas',
                'data' => [
                    [
                        'val' => 1,
                        'name' => 'Tampilkan'
                    ],
                    [
                        'val' => 0,
                        'name' => 'Sembunyikan'
                    ]
                ]
            ],
            [
                'label' => 'Jenjang',
                'name' => 'jenjangs',
                'param' => 'jenjang_id',
                'data' => Jenjang::where(['show_for_guest' => 1, 'deleted_at' => NULL])->get(['id AS val', 'name'])
            ],
            [
                'label' => 'Tingkat',
                'name' => 'tingkats',
                'param' => 'tingkat_id',
                'data' => Tingkat::where(['deleted_at' => NULL])->get(['id AS val', 'name'])
            ],
            [
                'label' => 'Mata Pelajaran',
                'name' => 'mata_pelajarans',
                'param' => 'mata_pelajaran_id',
                'data' => MataPelajaran::where(['deleted_at' => NULL])->get(['id AS val', 'name'])
            ],
        ];
    
        return response()->json(['message' => 'success', 'data' => $data, 'params_origin' => $params_origin]);
    }
}
