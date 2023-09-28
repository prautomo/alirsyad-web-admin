<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Services\UploadService;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\Simulasi;
use App\Models\UploaderMataPelajaran;
use App\Helpers\GenerateSlug;

class SimulasiController extends Controller{

    function __construct(){
        $this->middleware('permission:simulasi-list|simulasi-create|simulasi-edit|simulasi-delete', ['only' => ['index','show']]);
        $this->middleware('permission:simulasi-create', ['only' => ['create','store']]);
        $this->middleware('permission:simulasi-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:simulasi-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.simulasis';
        $this->routePath = 'backoffice::simulasis';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = Simulasi::query();

        // relation with tingkat
        $query = $query->with('modul.mataPelajaran.tingkat.jenjang');

        $datas = $query->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                // kalo bukan superadmin, tambahin filter by mapel na
                if(!@\Auth::user()->hasRole('Superadmin')){
                    $mapelIdsUser = $this->getMapelIdsUser();
                    $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
                }

                $search = @$request->search['value'];

                if($search){
                    $query->where(function($query) use ($search){
                        $query->where('name', 'LIKE', '%'.$search.'%');
                    
                        $query = $query->orWhereHas('modul.mataPelajaran.tingkat.jenjang', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%');
                        });

                        $query = $query->orWhereHas('modul.mataPelajaran.tingkat', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%');
                        });

                        $query = $query->orWhereHas('modul.mataPelajaran', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%');
                        });

                        $query = $query->orWhereHas('modul', function($query2) use ( $search ){
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
                return @$data->modul->mataPelajaran->tingkat->jenjang ? $data->modul->mataPelajaran->tingkat->jenjang->name : '-';
            })
            ->addColumn("tingkat", function ($data) {
                return @$data->modul->mataPelajaran->tingkat ? $data->modul->mataPelajaran->tingkat->name : '-';
            })
            ->addColumn("mapel", function ($data) {
                $mapel = @$data->modul->mataPelajaran->name ? $data->modul->mataPelajaran->name : 'none';
                $mapelID = @$data->modul->mataPelajaran->id ? $data->modul->mataPelajaran->id : '';

                return view("components.datatable.link", [
                    "link" => route($this->routePath.".index")."?mata_pelajaran_id=".$mapelID,
                    "text" => $mapel,
                ]);
                return $mapel;
            })
            ->addColumn("modul", function ($data) {
                $modul = (@$data->modul->name ? $data->modul->name : 'none') . " (Level ".(@$data->level ?? '1').")";
                $modulID = @$data->modul->id ? $data->modul->id : '';

                return view("components.datatable.link", [
                    "link" => route($this->routePath.".index")."?modul_id=".$modulID,
                    "text" => $modul,
                ]);
            })
            ->addColumn("created_by", function ($data) {
                return @$data->uploader->name ?? "-";
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
            })
            ->addColumn("action", function ($data) {
                $relModul = @$data->modul->slug ? "?rel=modul/".@$data->modul->slug.".html" : "";
                $url_userdev = "https://user.alirsyadbandung.sch.id/";
                $simulasi = Simulasi::find($data->id);
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'simulasi',
                    "class" => $data->class,
                    // "copySlug" => asset('simulasi/'.$data->slug.".html").$relModul,
                    // "copySlug" => $url_userdev . 'subject/'  . $simulasi->mata_pelajaran_id . '/learning-module/' . $data->id . $relModul,
                    "copySlug" => $url_userdev . '/module/' . $data->id . $relModul,
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
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
        $mapels = MataPelajaran::with('tingkat')->get();

        // filter kalo rolenya guru uploader (khusus mapel di tingkatnya aja)

        $mapelList = [];
        $mapelList[""] = "Pilih mata pelajaran";

        foreach($mapels as $mapel){
            $mapelList[$mapel->id] = $mapel->name . " (Tingkat ".@$mapel->tingkat->name." ".@$mapel->tingkat->jenjang->name.")";
        }

        return $mapelList;
    }

    /**
     * Get modul
     */
    private function getModul(){
        // get list modul
        $moduls = Modul::with('mataPelajaran.tingkat');

        // filter kalo rolenya guru uploader (khusus mapel aja)
        // kalo bukan superadmin, tambahin filter by mapel na
        if(!@\Auth::user()->hasRole('Superadmin')){
            $mapelIdsUser = $this->getMapelIdsUser();
            $moduls = $moduls->whereIn('mata_pelajaran_id', $mapelIdsUser);
        }

        $moduls = $moduls->get();

        $modulList = [];
        $modulList[""] = "Pilih modul";

        foreach($moduls as $modul){
            $modulList[$modul->id] = $modul->name . " (".@$modul->mataPelajaran->name." Tingkat: ".@$modul->mataPelajaran->tingkat->name. " ". @$modul->mataPelajaran->tingkat->jenjang->name .")";
        }

        return $modulList;
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
        $modulList = $this->getModul();
        $semesterList = $this->getSemester();

        return view($this->prefix.'.create', ['mapelList' => $mapelList, 'semesterList' => $semesterList, 'modulList' => $modulList]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'modul_id' => 'required',
            'game' => 'required|file|mimes:zip',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
            'level' => 'required|numeric|min:1',
        ]);
        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['name', 'icon', 'description', 'modul_id', 'semester', 'urutan', 'level']);
        $dataReq['uploader_id'] = \Auth::user()->id;

        if ($request->hasFile('icon')) {

            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/simulasi');
            $dataReq['icon'] = $url;
        }

        // extract file game
        if ($request->hasFile('game')) {
            $fileArchive = $request->file('game');
            $extpath = "uploads/simulasi/".date("Ymd")."/".strtolower(str_replace(" ", "_", $request->name));
        
            $zip = new \ZipArchive;
            if ($zip->open($fileArchive) === TRUE) {
                $zip->extractTo($extpath);
                $zip->close();
                $dataReq['path_simulasi'] = $extpath;
            } else {
                return redirect()->route($this->routePath.'.create')->with(
                    $this->failed(__("Failed to upload simulasi"), $request->all())
                );
            }
        }

        // assign mapel id (temporary bad strucure)
        // get mapel id from modul
        $modul = Modul::find($request->modul_id);
        $dataReq['mata_pelajaran_id'] = @$modul->mata_pelajaran_id;

        $data = Simulasi::create($dataReq);

        if(empty($request->slug)){
            $data->slug = GenerateSlug::generateSlug($data->id, $data->name);
            $data->save();
        }

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Simulasi"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Simulasi::with('mataPelajaran')->findOrFail($id);
        $mapelList = $this->getMataPelajaran();
        $modulList = $this->getModul();
        $semesterList = $this->getSemester();

        return view($this->prefix.'.edit', ['data' => $dt, 'mapelList' => $mapelList, 'semesterList' => $semesterList, 'modulList' => $modulList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'slug' => 'unique:mata_pelajarans,slug,'.$id,
            'name' => 'required|string',
            'modul_id' => 'required',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
            'level' => 'required|numeric|min:1',
        ]);

        $dataReq = $request->only(['name', 'icon', 'description', 'modul_id', 'slug', 'semester', 'urutan', 'level']);

        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/simulasi');

            $dataReq['icon'] = $url;
        }

        // extract file game
        if ($request->hasFile('game')) {
            $validated = $request->validate([
                'game' => 'file|mimes:zip',
            ]);

            $fileArchive = $request->file('game');
            $extpath = "uploads/simulasi/".date("Ymd")."/".strtolower(str_replace(" ", "_", $request->name));
        
            $zip = new \ZipArchive;
            if ($zip->open($fileArchive) === TRUE) {
                $zip->extractTo($extpath);
                $zip->close();
                $dataReq['path_simulasi'] = $extpath;
            } else {
                return redirect()->route($this->routePath.'.create')->with(
                    $this->failed(__("Failed to upload simulasi"), $request->all())
                );
            }
        }

        if(empty($request->slug)){
            $dataReq['slug'] = GenerateSlug::generateSlug($id, $request->name);
        }

        // assign mapel id (temporary bad strucure)
        // get mapel id from modul
        $modul = Modul::find($request->modul_id);
        $dataReq['mata_pelajaran_id'] = @$modul->mata_pelajaran_id;

        $dt = Simulasi::findOrFail($id);
        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Simulasi"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Simulasi::findOrFail($id);

        $d->delete();
    }

}