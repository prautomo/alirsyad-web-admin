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
use App\Models\Modul;
use App\Models\MataPelajaran;
use App\Models\Video;

class VideoController extends Controller{

    function __construct(){
        $this->middleware('permission:video-list|video-create|video-edit|video-delete', ['only' => ['index','show']]);
        $this->middleware('permission:video-create', ['only' => ['create','store']]);
        $this->middleware('permission:video-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:video-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.videos';
        $this->routePath = 'backoffice::videos';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = Video::query();

        // relation with tingkat
        $query = $query->with('modul.mataPelajaran.tingkat.jenjang');

        return datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
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
            })
            ->addColumn("modul", function ($data) {
                $modul = @$data->modul->name ? $data->modul->name : 'none';
                $modulID = @$data->modul->id ? $data->modul->id : '';

                return view("components.datatable.link", [
                    "link" => route($this->routePath.".index")."?modul_id=".$modulID,
                    "text" => $modul,
                ]);
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
            })
            ->addColumn("action", function ($data) {
                $relModul = @$data->modul->slug ? "?rel=modul/".@$data->modul->slug.".html" : "";
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'video',
                    "class" => $data->class,
                    "copySlug" => route("app.video.detail", $data->id).$relModul,
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->toJson();
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
        $moduls = Modul::with('mataPelajaran.tingkat')->get();

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
            'video_url' => 'required|url',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);
        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['name', 'video_url', 'icon', 'description', 'modul_id', 'semester', 'urutan']);
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

        // assign mapel id (temporary bad strucure)
        // get mapel id from modul
        $modul = Modul::find($request->modul_id);
        $dataReq['mata_pelajaran_id'] = @$modul->mata_pelajaran_id;

        $data = Video::create($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Video"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Video::with('mataPelajaran')->findOrFail($id);
        $mapelList = $this->getMataPelajaran();
        $modulList = $this->getModul();
        $semesterList = $this->getSemester();

        return view($this->prefix.'.edit', ['data' => $dt, 'mapelList' => $mapelList, 'semesterList' => $semesterList, 'modulList' => $modulList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'modul_id' => 'required',
            'video_url' => 'required|url',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);

        $dataReq = $request->only(['name', 'video_url', 'icon', 'description', 'modul_id', 'semester', 'urutan']);

        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/video');

            $dataReq['icon'] = $url;
        }

        // assign mapel id (temporary bad strucure)
        // get mapel id from modul
        $modul = Modul::find($request->modul_id);
        $dataReq['mata_pelajaran_id'] = @$modul->mata_pelajaran_id;

        $dt = Video::findOrFail($id);
        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Video"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Video::findOrFail($id);

        $d->delete();
    }

}