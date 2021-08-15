<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Tingkat;

class KelasController extends Controller{

    function __construct(){
        $this->middleware('permission:kelas-list|kelas-create|kelas-edit|kelas-delete', ['only' => ['index','show']]);
        $this->middleware('permission:kelas-create', ['only' => ['create','store']]);
        $this->middleware('permission:kelas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:kelas-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.kelas';
        $this->routePath = 'backoffice::kelas';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(){
        $query = Kelas::query();

        // relation with tingkat
        $query = $query->with('tingkat');

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'kelas',
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
                ]);
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y h:i:s");
            })
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->toJson();
    }

    public function index(Request $request){
        if ($request->ajax()) {
            return $this->datatable();
        }

        return view($this->prefix.'.index');
    }

    public function listJson(Request $request){
        $datas = Kelas::search($request)->get();

        return response()->json($datas, 200);
    }
    
    public function create(){
        // get list tingkat
        $tingkats = Tingkat::all();
        $tingkatList = [];

        foreach($tingkats as $tingkat){
            $tingkatList[$tingkat->id] = $tingkat->name;
        }

        return view($this->prefix.'.create', ['tingkatList' => $tingkatList]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'tingkat_id' => 'required',
        ]);

        $data = Kelas::create($request->only(['description', 'name', 'tingkat_id']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Kelas"), $data)
        );
    }

    public function edit(Request $request, $id){
        // get list tingkat
        $tingkats = Tingkat::all();
        $tingkatList = [];

        foreach($tingkats as $tingkat){
            $tingkatList[$tingkat->id] = $tingkat->name;
        }

        $dt = Kelas::findOrFail($id);

        return view($this->prefix.'.edit', ['data'=>$dt, 'tingkatList' => $tingkatList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'tingkat_id' => 'required',
        ]);
        
        $dt = Kelas::findOrFail($id);
        $dt->update($request->only(['description', 'name', 'tingkat_id']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Kelas"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Kelas::findOrFail($id);

        $d->delete();
    }
}