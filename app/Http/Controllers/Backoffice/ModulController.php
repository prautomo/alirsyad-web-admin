<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Services\UploadService;
use App\Models\Modul;
use App\Models\MataPelajaran;
use App\Models\Tingkat;
use App\Models\Update;
use App\Models\UploaderMataPelajaran;
use App\Helpers\ExtractArchive;
use App\Helpers\GenerateSlug;

class ModulController extends Controller{

    function __construct(){
        $this->middleware('permission:modul-list|modul-create|modul-edit|modul-delete', ['only' => ['index','show']]);
        $this->middleware('permission:modul-create', ['only' => ['create','store']]);
        $this->middleware('permission:modul-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:modul-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.moduls';
        $this->routePath = 'backoffice::moduls';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = Modul::query();

        // kalo bukan superadmin, tambahin filter by mapel na
        if(!@\Auth::user()->hasRole('Superadmin')){
            $mapelIdsUser = $this->getMapelIdsUser();
            $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
        }

        $query = $query->with('mataPelajaran.tingkat.jenjang');

        $datas = $query->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where(function($query) use ($search){
                        $query->where('name', 'LIKE', '%'.$search.'%');

                        $query = $query->orWhereHas('mataPelajaran.tingkat.jenjang', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%');
                        });

                        $query = $query->orWhereHas('mataPelajaran.tingkat', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%');
                        });

                        $query = $query->orWhereHas('mataPelajaran', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%');
                        });
                    });
                }

                // query param mapel id
                if(@$request->mata_pelajaran_id) $query->where('mata_pelajaran_id', @$request->mata_pelajaran_id);
            })
            ->addIndexColumn()
            ->addColumn('show-img', function($data) {
                if(empty($data->icon)){
                    return "not available";
                }else{
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
                    "link" => route($this->routePath.".index")."?mata_pelajaran_id=".$mapelID,
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
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'modul',
                    "class" => $data->class,
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
                    "viewPdfRoute" => asset($data->pdf_path),
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->toJson();
    }

    private function getMapelIdsUser(){
        $userId = @\Auth::user()->id;
        $mapelIdsUser = UploaderMataPelajaran::where('guru_uploader_id', $userId)->pluck('mata_pelajaran_id')->all();
        $mapelIdsUser = count($mapelIdsUser) > 0 ? $mapelIdsUser : [];

        return $mapelIdsUser;
    }

    public function index(Request $request){
        if ($request->ajax()) {
            return $this->datatable($request);
        }

        return view($this->prefix.'.index');
    }

    /**
     * Get mata pelajaran
     */
    private function getMataPelajaran(){
        // get list mapel
        $mapels = MataPelajaran::with('tingkat');

        // filter kalo rolenya guru uploader (khusus mapel aja)
        // kalo bukan superadmin, tambahin filter by mapel na
        if(!@\Auth::user()->hasRole('Superadmin')){
            $mapelIdsUser = $this->getMapelIdsUser();
            $mapels = $mapels->whereIn('id', $mapelIdsUser);
        }

        $mapels = $mapels->get();

        $mapelList = [];
        $mapelList[""] = "Pilih mata pelajaran";

        foreach($mapels as $mapel){
            $mapelList[$mapel->id] = $mapel->name . " (Tingkat ".@$mapel->tingkat->name." ".@$mapel->tingkat->jenjang->name.")";
        }

        return $mapelList;
    }

    private function getSemester(){
        $semesterList = [];
        $semesterList[""] = "Pilih semester";

        $semesterList[1] = "1";
        $semesterList[2] = "2";

        return $semesterList;
    }

    public function create(){

        $mapelList = $this->getMataPelajaran();
        $semesterList = $this->getSemester();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        return view($this->prefix.'.create', ['mapelList' => $mapelList, 'semesterList' => $semesterList, 'showUpdate' => $show]);
    }

    public function store(Request $request){
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
        $dataReq = $request->only(['name', 'icon', 'description', 'mata_pelajaran_id', 'slug', 'semester', 'tahun_ajaran', 'urutan']);
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

        if(empty($request->slug)){
            $data->slug = GenerateSlug::generateSlug($data->id, $data->name);
            $data->save();
        }

        if(@$request->showUpdate){

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

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Modul"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Modul::with('mataPelajaran')->findOrFail($id);
        $mapelList = $this->getMataPelajaran();
        $semesterList = $this->getSemester();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        // last update data
        $update = Update::where(['trigger' => 'modul', 'trigger_id' => $id])->orderBy('created_at', 'desc')->first();

        return view($this->prefix.'.edit', ['data' => $dt, 'mapelList' => $mapelList, 'semesterList' => $semesterList, 'showUpdate' => $show, 'update' => $update]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'slug' => 'unique:mata_pelajarans,slug,'.$id,
            'name' => 'required|string',
            'mata_pelajaran_id' => 'required',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);

        $dataReq = $request->only(['name', 'icon', 'description', 'mata_pelajaran_id', 'slug', 'semester', 'tahun_ajaran', 'urutan']);

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

        if(empty($request->slug)){
            $dataReq['slug'] = GenerateSlug::generateSlug($id, $request->name);
        }

        $dt = Modul::findOrFail($id);
        $dt->update($dataReq);

        if(@$request->showUpdate){

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
            }else {
                // last update data
                $update = Update::where(['trigger' => 'modul', 'trigger_id' => $id])->orderBy('created_at', 'desc')->first();

                $coverUpdate = @$update->logo;
            }
            $this->insertToUpdateLog(Modul::findOrFail($id), $coverUpdate, 'update');
        }else{
            $dt = Modul::where('id', $id)->update(['show_update' => 0]);
        }

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Modul"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Modul::findOrFail($id);

        $d->delete();
    }

    /**
     * Insert to update log
     *
     * @param  \App\Models\Modul  $modul
     * @param  String  $type
     * @return void
     */
    private function insertToUpdateLog(Modul $modul, $cover, $type){
        $data = [
            'trigger_event' => @$type ?? 'other',
            'trigger' => 'modul',
            'trigger_id' => @$modul->id,
            'trigger_name' => @$modul->name,
            'mata_pelajaran' => @$modul->mataPelajaran->name,
            'tingkat_id' => @$modul->mataPelajaran->tingkat_id,
            'mata_pelajaran_id' => @$modul->mataPelajaran->id,
            'logo' => $cover,
        ];

        if(Update::where('trigger_id', @$modul->id)){
            Update::where('trigger_id', @$modul->id)->delete();
        }

        Update::create($data);
    }
}
