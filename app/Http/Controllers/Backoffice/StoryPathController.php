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
use App\Models\Simulasi;
use App\Models\StoryPath;

class StoryPathController extends Controller{

    function __construct(){
        $this->middleware('permission:story-path-list|story-path-create|story-path-edit|story-path-delete', ['only' => ['index','show']]);
        $this->middleware('permission:story-path-create', ['only' => ['create','store']]);
        $this->middleware('permission:story-path-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:story-path-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.story-paths';
        $this->routePath = 'backoffice::story-paths';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = StoryPath::query();

        // relation with tingkat
        $query = $query->with('mataPelajaran');

        return datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where('name', 'LIKE', '%'.$search.'%');
                    
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
                    "permissionName" => 'story-path',
                    "class" => $data->class,
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
     * Get modul kelas story path enable
     */
    public function getModul(){
        // get list mapel
        $moduls = Modul::whereHas('mataPelajaran.kelas.tingkat', function($query){
            $query->where('use_story_path', true);
        })->get();

        // filter kalo rolenya guru uploader (khusus modul di tingkatnya aja)
        $modulList = [];

        foreach($moduls as $modul){
            // $modulList[$modul->id] = $modul->name . " (Mata Pelajaran: ".@$modul->mataPelajaran->name.")";
            $modulList[] = [
                'value' => $modul->id,
                'label' => $modul->name . " (Mata Pelajaran: ".@$modul->mataPelajaran->name.")",
                'mata_pelajaran_id' => $modul->mata_pelajaran_id,
            ];
        }
        
        return response()->json($modulList, 200);
    }

    /**
     * Get simulasi by mapel kelas story path enable (can beres)
     */
    public function getSimulasi($mataPelajaranId){
        // get list mapel
        $simulasis = Simulasi::whereHas('mataPelajaran.kelas.tingkat', function($query){
            $query->where('use_story_path', true);
        })->where('mata_pelajaran_id', $mataPelajaranId)->get();

        // filter kalo rolenya guru uploader (khusus modul di tingkatnya aja)
        $simulasiList = [];

        foreach($simulasis as $modul){
            $simulasiList[] = [
                'value' => $modul->id,
                'label' => $modul->name,
            ];
        }
        
        return response()->json($simulasiList, 200);
    }

    public function create(){
        return view($this->prefix.'.create');
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'mata_pelajaran_id' => 'required',
            'game' => 'required|file|mimes:zip',
        ]);
        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['name', 'icon', 'description', 'mata_pelajaran_id']);
        $dataReq['uploader_id'] = \Auth::user()->id;

        if ($request->hasFile('icon')) {

            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/story-path');
            $dataReq['icon'] = $url;
        }

        // extract file game
        if ($request->hasFile('game')) {
            $fileArchive = $request->file('game');
            $extpath = "uploads/story-path/".date("Ymd")."/".strtolower(str_replace(" ", "_", $request->name));
        
            $zip = new \ZipArchive;
            if ($zip->open($fileArchive) === TRUE) {
                $zip->extractTo($extpath);
                $zip->close();
                $dataReq['path_story-path'] = $extpath;
            } else {
                return redirect()->route($this->routePath.'.create')->with(
                    $this->failed(__("Failed to upload story-path"), $request->all())
                );
            }
        }

        $data = StoryPath::create($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create StoryPath"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = StoryPath::with('mataPelajaran')->findOrFail($id);
        $mapelList = $this->getMataPelajaran();

        return view($this->prefix.'.edit', ['data' => $dt, 'mapelList' => $mapelList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'mata_pelajaran_id' => 'required',
        ]);

        $dataReq = $request->only(['name', 'icon', 'description', 'mata_pelajaran_id']);

        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/story-path');

            $dataReq['icon'] = $url;
        }

        // extract file game
        if ($request->hasFile('game')) {
            $validated = $request->validate([
                'game' => 'file|mimes:zip',
            ]);

            $fileArchive = $request->file('game');
            $extpath = "uploads/story-path/".date("Ymd")."/".strtolower(str_replace(" ", "_", $request->name));
        
            $zip = new \ZipArchive;
            if ($zip->open($fileArchive) === TRUE) {
                $zip->extractTo($extpath);
                $zip->close();
                $dataReq['path_story-path'] = $extpath;
            } else {
                return redirect()->route($this->routePath.'.create')->with(
                    $this->failed(__("Failed to upload story-path"), $request->all())
                );
            }
        }

        $dt = StoryPath::findOrFail($id);
        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update StoryPath"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = StoryPath::findOrFail($id);

        $d->delete();
    }

}