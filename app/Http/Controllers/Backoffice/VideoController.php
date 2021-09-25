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
        $query = $query->with('mataPelajaran.tingkat.jenjang');

        return datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
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
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'video',
                    "class" => $data->class,
                    "copySlug" => route("app.video.detail", $data->id),
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

        return view($this->prefix.'.create', ['mapelList' => $mapelList, 'semesterList' => $semesterList]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'mata_pelajaran_id' => 'required',
            'video_url' => 'required|url',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);
        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['name', 'video_url', 'icon', 'description', 'mata_pelajaran_id', 'semester', 'urutan']);
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

        $data = Video::create($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Video"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Video::with('mataPelajaran')->findOrFail($id);
        $mapelList = $this->getMataPelajaran();
        $semesterList = $this->getSemester();

        return view($this->prefix.'.edit', ['data' => $dt, 'mapelList' => $mapelList, 'semesterList' => $semesterList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'mata_pelajaran_id' => 'required',
            'video_url' => 'required|url',
            'semester' => 'required|numeric|min:1,max:2',
            'urutan' => 'required|numeric|min:0',
        ]);

        $dataReq = $request->only(['name', 'video_url', 'icon', 'description', 'mata_pelajaran_id', 'semester', 'urutan']);

        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/video');

            $dataReq['icon'] = $url;
        }

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