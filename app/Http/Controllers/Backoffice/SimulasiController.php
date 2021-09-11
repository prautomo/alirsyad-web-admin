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
use App\Models\Simulasi;
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
                    "permissionName" => 'simulasi',
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

    public function create(){
        $mapelList = $this->getMataPelajaran();

        return view($this->prefix.'.create', ['mapelList' => $mapelList]);
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

        return view($this->prefix.'.edit', ['data' => $dt, 'mapelList' => $mapelList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'slug' => 'unique:mata_pelajarans,slug,'.$id,
            'name' => 'required|string',
            'mata_pelajaran_id' => 'required',
        ]);

        $dataReq = $request->only(['name', 'icon', 'description', 'mata_pelajaran_id', 'slug']);

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