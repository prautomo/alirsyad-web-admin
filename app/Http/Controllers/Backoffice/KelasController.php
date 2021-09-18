<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\ExternalUser;
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
    public function datatable(Request $request){
        $queryData = Kelas::query();

        // relation with tingkat
        $queryData = $queryData->with(['tingkat.jenjang', 'waliKelas']);
        
        return datatables()
            ->of($queryData)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where('name', 'LIKE', '%'.$search.'%');
                    
                    $query = $query->orWhereHas('tingkat.jenjang', function($query2) use ( $search ){
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });

                    $query = $query->orWhereHas('tingkat', function($query2) use ( $search ){
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });

                    $query = $query->orWhereHas('waliKelas', function($query2) use ( $search ){
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });
                }
            })
            ->addIndexColumn()
            ->addColumn("jenjang", function ($data) {
                return @$data->tingkat->jenjang ? $data->tingkat->jenjang->name : '-';
            })
            ->addColumn("tingkat", function ($data) {
                return @$data->tingkat ? $data->tingkat->name : '-';
            })
            ->addColumn("wali_kelas", function ($data) {
                return @$data->waliKelas ? $data->waliKelas->name : 'not set';
            })
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

    public function listJson(Request $request){
        $datas = Kelas::search($request)->get();

        return response()->json($datas, 200);
    }

    /**
     * Get Guru List
     */
    private function getGuruList(){
        // get list guru
        $role = "GURU";
        $guru = ExternalUser::where("role", $role);
        $guru = $guru->whereNotIn('id', Kelas::whereNotNull('wali_kelas_id')->pluck('wali_kelas_id'));
        $guru = $guru->get();
        $guruList = [];
        $guruList[""] = "Pilih Wali Kelas";
        foreach($guru as $guru){
            $guruList[$guru->id] = $guru->name;
        }

        return $guruList;
    }
    
    public function create(){
        // get list tingkat
        $tingkats = Tingkat::all();
        $tingkatList = [];
        $tingkatList[""] = "Pilih Jenjang Pendidikan";
        foreach($tingkats as $tingkat){
            $tingkatList[$tingkat->id] = "Tingkat ". $tingkat->name . " " . @$tingkat->jenjang->name;
        }

        $guruList = $this->getGuruList();

        return view($this->prefix.'.create', ['tingkatList'=> $tingkatList, 'guruList'=> $guruList]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'tingkat_id' => 'required',
        ]);

        $data = Kelas::create($request->only(['description', 'name', 'tingkat_id', 'wali_kelas_id']));

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

        $guruList = $this->getGuruList();
        // get wali kelas info
        if($dt->wali_kelas_id){
            $guru = $dt->waliKelas;
            $guruList[$guru->id] = $guru->name;
        }

        return view($this->prefix.'.edit', ['data'=> $dt, 'tingkatList'=> $tingkatList, 'guruList'=> $guruList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'tingkat_id' => 'required',
        ]);
        
        $dt = Kelas::findOrFail($id);
        $dt->update($request->only(['description', 'name', 'tingkat_id', 'wali_kelas_id']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Kelas"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Kelas::findOrFail($id);

        $d->delete();
    }
}