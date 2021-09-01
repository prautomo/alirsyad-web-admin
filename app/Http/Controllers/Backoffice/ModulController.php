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
use App\Helpers\ExtractArchive;

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
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'modul',
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
        $mapels = MataPelajaran::with('kelas.tingkat')->get();

        // filter kalo rolenya guru uploader (khusus mapel di tingkatnya aja)

        $mapelList = [];
        $mapelList[""] = "Pilih mata pelajaran";

        foreach($mapels as $mapel){
            $mapelList[$mapel->id] = $mapel->name . " (Kelas ".@$mapel->kelas->name." ".@$mapel->kelas->tingkat->name.")";
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
            'modul' => 'required|file|mimes:pdf',
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

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Modul"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Modul::with('mataPelajaran')->findOrFail($id);
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
            $url = UploadService::uploadImage($image, 'icon/modul');

            $dataReq['icon'] = $url;
        }

        if ($request->hasFile('modul')) {
            $fileModul = $request->file('modul');
            $extension = $fileModul->extension();
            $url = UploadService::uploadFile($fileModul, 'uploads/modul');
            $dataReq['pdf_path'] = $url;
        }

        $dt = Modul::findOrFail($id);
        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Modul"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Modul::findOrFail($id);

        $d->delete();
    }
}