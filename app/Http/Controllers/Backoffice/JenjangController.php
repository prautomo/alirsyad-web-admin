<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Jenjang;

class JenjangController extends Controller{

    function __construct(){
        $this->middleware('permission:jenjang-list|jenjang-create|jenjang-edit|jenjang-delete', ['only' => ['index','show']]);
        $this->middleware('permission:jenjang-create', ['only' => ['create','store']]);
        $this->middleware('permission:jenjang-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:jenjang-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.jenjangs';
        $this->routePath = 'backoffice::jenjangs';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = Jenjang::query();

        return datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where('name', 'LIKE', '%'.$search.'%');
                    
                    $query = $query->orWhereHas('uploader', function($query2) use ( $search ){
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });
                }
            })
            ->addIndexColumn()
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'jenjang',
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
                ]);
            })
            ->addColumn("uploader", function ($data) {
                return @$data->uploader_id ? $data->uploader->name : "not set";
            })
            ->addColumn("kepala_sekolah", function ($data) {
                return @$data->kepalaSekolah ? $data->kepalaSekolah->name : 'not set';
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
    private function getGuruUploader(){
        // get list jenjang
        $role = "GURU";
        $users = User::whereHas("roles", function($q) use ($role){ $q->where("key", $role); })->get();
        // $users = $users->whereNotIn('id', Jenjang::whereNotNull('uploader_id')->pluck('uploader_id'));
        
        $uploaderList = [];
        $uploaderList[""] = "Pilih guru uploader";
        foreach($users as $user){
            $uploaderList[$user->id] = $user->name;
        }

        return $uploaderList;
    }
    
    /**
     * Get Guru List
     */
    private function getGuruList(){
        // get list guru
        $role = "GURU";
        $guru = ExternalUser::where("role", $role);
        $guru = $guru->whereNotIn('id', Jenjang::whereNotNull('kepala_sekolah_id')->pluck('kepala_sekolah_id'));
        $guru = $guru->orderBy("name")->get();
        $guruList = [];
        $guruList[""] = "Pilih Kepala Sekolah";
        foreach($guru as $guru){
            $guruList[$guru->id] = $guru->name;
        }

        return $guruList;
    }
    
    public function create(){
        $uploaderList = $this->getGuruUploader();
        $showForGuest = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        $guruList = $this->getGuruList();

        return view($this->prefix.'.create', ['uploaderList' => $uploaderList, 'showForGuest' => $showForGuest, 'guruList'=> $guruList]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $data = Jenjang::create($request->only(['description', 'name', 'uploader_id', 'show_for_guest', 'kepala_sekolah_id']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Jenjang"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Jenjang::findOrFail($id);
        $uploaderList = $this->getGuruUploader();
        $showForGuest = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        $guruList = $this->getGuruList();
        // get wali kelas info
        if($dt->kepala_sekolah_id){
            $guru = $dt->kepalaSekolah;
            $guruList[$guru->id] = $guru->name;
        }

        return view($this->prefix.'.edit', ['data'=>$dt, 'uploaderList' => $uploaderList, 'showForGuest' => $showForGuest, 'guruList'=> $guruList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'uploader_id' => 'required',
        ]);
        
        $dt = Jenjang::findOrFail($id);
        $dt->update($request->only(['description', 'name', 'uploader_id', 'show_for_guest', 'kepala_sekolah_id']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Jenjang"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Jenjang::findOrFail($id);

        $d->delete();
    }
}