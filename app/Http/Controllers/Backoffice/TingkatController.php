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
use App\Models\User;
use App\Models\Jenjang;
use App\Models\Tingkat;

class TingkatController extends Controller{

    function __construct(){
        $this->middleware('permission:tingkat-list|tingkat-create|tingkat-edit|tingkat-delete', ['only' => ['index','show']]);
        $this->middleware('permission:tingkat-create', ['only' => ['create','store']]);
        $this->middleware('permission:tingkat-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tingkat-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.tingkats';
        $this->routePath = 'backoffice::tingkats';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = Tingkat::query();

        return datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where('name', 'LIKE', '%'.$search.'%');

                    $query = $query->orWhereHas('jenjang', function($query2) use ( $search ){
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });
                }
            })
            ->addIndexColumn()
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'tingkat',
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
                ]);
            })
            ->addColumn("jenjang", function ($data) {
                return @$data->jenjang_id ? $data->jenjang->name : "not set";
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
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
     * Get List Teacher Uploader
     */
    private function getJenjang(){
        // get list jenjang
        $jenjangs = Jenjang::get();
        $jenjangList = [];
        $jenjangList[""] = "Pilih jenjang pendidikan";
        foreach($jenjangs as $jenjang){
            $jenjangList[$jenjang->id] = $jenjang->name;
        }

        return $jenjangList;
    }

    public function create(){
        $jenjangList = $this->getJenjang();

        return view($this->prefix.'.create', ['jenjangList' => $jenjangList]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'jenjang_id' => 'required',
            'name' => 'required|string',
        ]);

        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['description', 'name', 'jenjang_id', 'logo']);
        $dataReq['uploader_id'] = \Auth::user()->id;

        if ($request->hasFile('logo')) {
            $validated = $request->validate([
                'logo' => 'mimes:jpeg,png|max:2028',
            ]);
            $image = $request->file('logo');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/tingkat');
            $dataReq['logo'] = $url;
        }

        $data = Tingkat::create($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Tingkat"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Tingkat::findOrFail($id);
        $jenjangList = $this->getJenjang();

        return view($this->prefix.'.edit', ['data'=>$dt, 'jenjangList' => $jenjangList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'jenjang_id' => 'required',
        ]);

        $dt = Tingkat::findOrFail($id);

        $dataReq = $request->only(['description', 'name', 'jenjang_id', 'logo']);

        if ($request->hasFile('logo')) {
            $validated = $request->validate([
                'logo' => 'mimes:jpeg,png|max:2028',
            ]);
            $image = $request->file('logo');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/tingkat');
            $dataReq['logo'] = $url;
        }

        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Tingkat"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Tingkat::findOrFail($id);

        $d->delete();
    }
}
