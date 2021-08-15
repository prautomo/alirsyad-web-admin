<?php
namespace App\Http\Controllers\Backoffice;

/*
 * @Author      : Ferdhika Yudira
 * @Date        : 2020-07-18 14:17:32
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\Tingkat;
use App\Services\UploadService;
use DB;
use Hash;
use Illuminate\Support\Arr;

class ExternalUserController extends Controller{

    function __construct(){
        $this->middleware('permission:external-user-list|external-user-create|external-user-edit|external-user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:external-user-create', ['only' => ['create','store']]);
        $this->middleware('permission:external-user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:external-user-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.external-user';
        $this->routePath = 'backoffice::external-users';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable($role){
        $query = ExternalUser::query();
        // relation with kelas and tingkat
        $query = $query->with('kelas.tingkat');

        if(!empty($role)){
            $query = $query->where('role', $role);
        }

        $dt = datatables()
        ->of($query)
        ->addIndexColumn()
        ->addColumn('show-img', function($data) {
            return view("components.datatable.image", [
                "url" => asset($data->photo)
            ]);
        })
        ->addColumn('show-status', function($data) {
            return view("components.datatable.status", [
                "route" => route($this->routePath.".update-status", $data->id),
                "text" => $data->status,
                "id" => $data->id,
                "role" => $data->role
            ]);
        })
        ->addColumn("action", function ($data) {
            return view("components.datatable.actions", [
                "name" => $data->name,
                // "deleteRoute" => route($this->routePath.".destroy", $data->id),
                "editRoute" => route($this->routePath.".edit", $data->id),
            ]);
        });

        $dt = $dt->order(function ($query) {
            $query->orderBy('created_at', 'desc');
        })->toJson();

        return $dt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->datatable($request->role);
        }

        return view($this->prefix.'.index');
    }

    /**
     * Get tingkat
     */
    private function getTingkat(){
        // get list tingkat
        $tingkats = Tingkat::all();
        $tingkatList = [];
        $tingkatList[""] = "Pilih tingkat";

        foreach($tingkats as $tingkat){
            $tingkatList[$tingkat->id] = $tingkat->name;
        }

        return $tingkatList;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tingkatList = $this->getTingkat();

        return view($this->prefix.'.create', ['tingkatList' => $tingkatList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:external_users,username',
            'nis' => 'required|unique:external_users,nis',
            'name' => 'required',
            'email' => 'required|email|unique:external_users,email',
            // 'phone' => 'required|unique:external_users,phone',
            'password' => 'required',
            'kelas_id' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = "AKTIF";
        $input['email_verified_at'] = now();
        $input['phone_verified_at'] = now();

        if ($request->hasFile('photo')) {

            $validated = $request->validate([
                'photo' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('photo');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'images/external_users');
            $input['photo'] = $url;
        }

        $user = ExternalUser::create($input);

        return redirect()->route($this->routePath.'.index', ['role'=>$request->role])->with(
            $this->success(__("External User created successfully"), $data)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dt = ExternalUser::with('kelas')->findOrFail($id);
        $tingkatList = $this->getTingkat();

        return view($this->prefix.'.edit', ['data' => $dt, 'tingkatList' => $tingkatList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:external_users,username,'.$id,
            'name' => 'required',
            'email' => 'required|email|unique:external_users,email,'.$id,
            // 'phone' => 'required|unique:external_users,phone,'.$id,
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, array('password'));
        }

        if ($request->hasFile('photo')) {

            $validated = $request->validate([
                'photo' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('photo');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'images/external_users');
            $input['photo'] = $url;
        }

        $user = ExternalUser::find($id);
        $user->update($input);

        return redirect()->route($this->routePath.'.index', ['role'=>$request->role])->with(
            $this->success(__("External User updated successfully"), $user)
        );
    }

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $input = $request->only(['status']);
        $user = ExternalUser::find($id);
        $user->update($input);

        return redirect()->route($this->routePath.'.index', ['role'=>$request->role])->with(
            $this->success(__("Status updated successfully"), $data)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        ExternalUser::find($id)->delete();

        return redirect()->route($this->routePath.'.index', ['role'=>$request->role])->with(
            $this->success(__("User deleted successfully"), $data)
        );
    }
}
