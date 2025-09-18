<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\GuruMataPelajaran;
use App\Models\Jenjang;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Services\UploadService;
use App\Models\Modul;
use App\Models\Update;
use App\Models\UploaderMataPelajaran;
use App\Models\MataPelajaran;
use App\Models\Tingkat;
use App\Models\Video;
use App\Traits\LogActivityTrait;
use App\Constants\LogActivityConst;

class VideoController extends Controller
{
    use LogActivityTrait;

    function __construct()
    {
        $this->middleware('permission:video-list|video-create|video-edit|video-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:video-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:video-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:video-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.videos';
        $this->routePath = 'backoffice::videos';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request)
    {
        $query = Video::query();
        $query = $query->with('modul.mataPelajaran.tingkat.jenjang');
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

                if($visibilitas){
                    $query = $query->where(['is_visible' => $visibilitas]);
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

                        $query = $query->orWhereHas('modul', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });
                    });
                }

                // query param mapel id
                if (@$request->mata_pelajaran_id) $query->where('mata_pelajaran_id', @$request->mata_pelajaran_id);

                // query param modul id
                if (@$request->modul_id) $query->where('modul_id', @$request->modul_id);
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
                if (@$data->modul->mataPelajaran) {
                    $mapel = @$data->modul->mataPelajaran->name ? $data->modul->mataPelajaran->name : 'none';
                    $mapelID = @$data->modul->mataPelajaran->id ? $data->modul->mataPelajaran->id : '';
                } else {
                    $mapel = @$data->mataPelajaran->name ?? 'none';
                    $mapelID = @$data->mataPelajaran->id ?? '';
                }

                return view("components.datatable.link", [
                    "link" => route($this->routePath . ".index") . "?mata_pelajaran_id=" . $mapelID,
                    "text" => $mapel,
                ]);
            })
            ->addColumn("modul", function ($data) {
                $modul = @$data->modul->name ? $data->modul->name : 'none';
                $modulID = @$data->modul->id ? $data->modul->id : '';

                return view("components.datatable.link", [
                    "link" => route($this->routePath . ".index") . "?modul_id=" . $modulID,
                    "text" => $modul,
                ]);
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
                $relModul = @$data->modul->slug ? "?rel=modul/" . @$data->modul->slug . ".html" : "";
                $url_userdev = "https://user.alirsyadbandung.sch.id/";
                $video = Video::find($data->id);
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'video',
                    "class" => $data->class,
                    // "copySlug" => route("app.video.detail", $data->id) . $relModul,
                    // "copySlug" => $url_userdev . 'subject/'  . $video->mata_pelajaran_id . '/learning-video/' . $data->id . $relModul,
                    "copySlug" => $url_userdev . 'video/' . $data->id . $relModul,
                    "deleteRoute" => route($this->routePath . ".destroy", $data->id),
                    "editRoute" => route($this->routePath . ".edit", $data->id),
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

    /**
     * Get modul
     */
    private function getModul()
    {
        // get list modul
        $moduls = Modul::with('mataPelajaran.tingkat');

        // filter kalo rolenya guru uploader (khusus mapel aja)
        // kalo bukan superadmin, tambahin filter by mapel na
        if (!@\Auth::user()->hasRole('Superadmin')) {
            $mapelIdsUser = $this->getMapelIdsUser();
            $moduls = $moduls->whereIn('mata_pelajaran_id', $mapelIdsUser);
        }

        $moduls = $moduls->get();

        $modulList = [];
        $modulList[""] = "Pilih modul";

        foreach ($moduls as $modul) {
            $modulList[$modul->id] = $modul->name . " (" . @$modul->mataPelajaran->name . " Tingkat: " . @$modul->mataPelajaran->tingkat->name . " " . @$modul->mataPelajaran->tingkat->jenjang->name . ")";
        }

        return $modulList;
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
        $modulList = $this->getModul();
        $semesterList = $this->getSemester();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        return view($this->prefix . '.create', ['mapelList' => $mapelList, 'semesterList' => $semesterList, 'modulList' => $modulList, 'showUpdate' => $show]);
    }

    public function store(Request $request)
    {
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'video_url' => 'required|url',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);

        if (@$request->modul_id == null) {
            $validated = $request->validate([
                'mata_pelajaran_id' => 'required',
            ]);
        }

        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['name', 'video_url', 'icon', 'description', 'modul_id', 'mata_pelajaran_id', 'semester', 'urutan', 'visible', 'is_visible']);

        $dataReq['visible'] = @$request->visible == "ya" ? 1 : 0;

        $dataReq['uploader_id'] = \Auth::user()->id;

        if ($request->hasFile('icon')) {

            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/video');
            $dataReq['icon'] = $url;
        }

        if (@$request->mata_pelajaran_id == null) {
            // assign mapel id (temporary bad strucure)
            // get mapel id from modul
            $modul = Modul::find($request->modul_id);
            $dataReq['mata_pelajaran_id'] = @$modul->mata_pelajaran_id;
        }

        $data = Video::create($dataReq);

        // log create activity
        $this->logActivity(
            LogActivityConst::ACTION_TYPE_CREATE,
            'Create Video ' . $data->name,
            LogActivityConst::MODULE_VIDEO,
            $data->id,
            null,
            $data->toArray()
        );

        // insert to log update
        if (@$request->showUpdate) {

            Video::where('id', $data->id)->update(['show_update' => 1]);

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
            $this->success(__("Success to create Video"), $data)
        );
    }

    public function edit(Request $request, $id)
    {
        $dt = Video::with('mataPelajaran')->findOrFail($id);
        $mapelList = $this->getMataPelajaran();
        $modulList = $this->getModul();
        $semesterList = $this->getSemester();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        // last update data
        $update = Update::where(['trigger' => 'video', 'trigger_id' => $id])->orderBy('created_at', 'desc')->first();

        return view($this->prefix . '.edit', ['data' => $dt, 'mapelList' => $mapelList, 'semesterList' => $semesterList, 'modulList' => $modulList, 'showUpdate' => $show, 'update' => $update]);
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'video_url' => 'required|url',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);

        if (@$request->modul_id == null) {
            $validated = $request->validate([
                'mata_pelajaran_id' => 'required',
            ]);
        }

        $dataReq = $request->only(['name', 'video_url', 'icon', 'description', 'modul_id', 'mata_pelajaran_id', 'semester', 'urutan', 'visible', 'is_visible']);

        $dataReq['visible'] = @$request->visible == "ya" ? 1 : 0;

        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/video');

            $dataReq['icon'] = $url;
        }

        if (@$request->mata_pelajaran_id == null) {
            // assign mapel id (temporary bad strucure)
            // get mapel id from modul
            $modul = Modul::find($request->modul_id);
            $dataReq['mata_pelajaran_id'] = @$modul->mata_pelajaran_id;
        }

        $dt = Video::findOrFail($id);
        $before = $dt->toArray();
        $dt->update($dataReq);

        $this->logActivity(
            LogActivityConst::ACTION_TYPE_UPDATE,
            'Update Video ' . $dt->name,
            LogActivityConst::MODULE_VIDEO,
            $dt->id,
            $before,
            $dt->toArray()
        );

        // insert to log update
        if (@$request->showUpdate) {

            $dt = Video::where('id', $id)->update(['show_update' => 1]);

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
                $update = Update::where(['trigger' => 'video', 'trigger_id' => $id])->orderBy('created_at', 'desc')->first();

                $coverUpdate = @$update->logo;
            }
            $this->insertToUpdateLog(Video::findOrFail($id), $coverUpdate, 'update', 1);
        } else {
            $dt = Video::where('id', $id)->update(['show_update' => 0]);
            $update = Update::where(['trigger' => 'video', 'trigger_id' => $id])->orderBy('created_at', 'desc')->first();
            $this->insertToUpdateLog(Video::findOrFail($id), @$update->logo, 'update', 0);
        }

        return redirect()->route($this->routePath . '.index')->with(
            $this->success(__("Success to update Video"), $dt)
        );
    }

    public function destroy(Request $request, $id)
    {
        $delete_update = Update::where(['trigger' => 'video', 'trigger_id' => $id])->delete();
        $d = Video::findOrFail($id);
        $before = $d->toArray();

        $d->delete();

        $this->logActivity(
            LogActivityConst::ACTION_TYPE_DELETED,
            'Delete Video ' . $d->name,
            LogActivityConst::MODULE_VIDEO,
            $id,
            $before,
            null
        );
    }

    /**
     * Insert to update log
     *
     * @param  \App\Models\Video  $video
     * @param  String  $type
     * @return void
     */
    private function insertToUpdateLog(Video $video, $cover, $type, $visible = 1)
    {
        $data = [
            'trigger_event' => @$type ?? 'other',
            'trigger' => 'video',
            'trigger_id' => @$video->id,
            'trigger_name' => @$video->name,
            'mata_pelajaran' => @$video->mataPelajaran->name,
            'tingkat_id' => @$video->mataPelajaran->tingkat_id,
            'mata_pelajaran_id' => @$video->mataPelajaran->id,
            'visible' => @$visible,
        ];

        if ($cover) {
            $data['logo'] = $cover;
        }

        if (Update::where(['trigger_id' => @$video->id, 'trigger' => "video"])) {
            Update::where(['trigger_id' => @$video->id, 'trigger' => "video"])->delete();
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
