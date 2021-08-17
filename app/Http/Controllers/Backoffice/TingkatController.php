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
    public function datatable(){
        $query = Tingkat::query();

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'tingkat',
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
                ]);
            })
            ->addColumn("uploader", function ($data) {
                return @$data->uploader_id ? $data->uploader->name : "not set";
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
            return $this->datatable();
        }

        return view($this->prefix.'.index');
    }

    /**
     * Get List Teacher Uploader
     */
    private function getGuruUploader(){
        // get list tingkat
        $role = "GURU";
        $users = User::whereHas("roles", function($q) use ($role){ $q->where("key", $role); })->get();
        $users = $users->whereNotIn('id', Tingkat::whereNotNull('uploader_id')->pluck('uploader_id'));
        
        $uploaderList = [];
        $uploaderList[""] = "Pilih guru uploader";
        foreach($users as $user){
            $uploaderList[$user->id] = $user->name;
        }

        return $uploaderList;
    }
    
    public function create(){
        $uploaderList = $this->getGuruUploader();

        return view($this->prefix.'.create', ['uploaderList' => $uploaderList]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $data = Tingkat::create($request->only(['description', 'name']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Tingkat"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Tingkat::findOrFail($id);
        $uploaderList = $this->getGuruUploader();

        return view($this->prefix.'.edit', ['data'=>$dt, 'uploaderList' => $uploaderList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'uploader_id' => 'required',
        ]);
        
        $dt = Tingkat::findOrFail($id);
        $dt->update($request->only(['description', 'name', 'uploader_id']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Tingkat"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Tingkat::findOrFail($id);

        $d->delete();
    }
}