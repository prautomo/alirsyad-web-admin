<?php
namespace App\Http\Controllers\Backoffice;

/*
 * @Author      : Ferdhika Yudira 
 * @Date        : 2020-07-18 14:17:32 
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jenjang;
use App\Models\MataPelajaran;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Arr;
    
class UserController extends Controller{

    function __construct(){
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.users';
        $this->routePath = 'backoffice::users';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = User::query();

        return datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                // search
                $search = $request->search['value'];

                // filter by column
                $query = $query->where('name', 'LIKE', '%'.$search.'%');
                // $query = $query->orWhere('name', 'LIKE', '%'.$search.'%');

                // filter not me
                $query = $query->whereNotIn('id', [\Auth::user()->id]);

                // filter by role
                $role = $request->role;
                if(!empty($role)){
                    $query = $query->whereHas("roles", function($q) use ($role){ $q->where("key", $role); });
                }

                if($search){
                    $query = $query->orWhereHas('uploaderTingkat', function($query2) use ( $search ){
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });

                    $query = $query->orWhereHas('mataPelajaran', function($query2) use ( $search ){
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });
                }
            })
            ->addIndexColumn()
            ->addColumn("roles", function ($data) {
                $roles = "";

                if(!empty($data->getRoleNames())){
                    foreach($data->getRoleNames() as $v){
                        $roles .= "{$v} ";
                    }
                }

                return view("components.datatable.label", [
                    "badge" => 'success',
                    "text" => $roles,
                ]);
            })
            // ->addColumn("uploader", function ($data) {
            //     if($data->uploaderTingkat){
            //         return view("components.datatable.label", [
            //             "badge" => 'success',
            //             "text" => 'Tingkat : '.@$data->uploaderTingkat->name ,
            //         ]);
            //     }else{
            //         return view("components.datatable.label", [
            //             "badge" => 'warning',
            //             "text" => 'Bukan',
            //         ]);
            //     }
            // })
            ->addColumn("mapel", function ($data) {
                return @$data->mataPelajaran->name ? $data->mataPelajaran->name : 'not set';
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'user',
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = User::whereNotIn('id', [\Auth::user()->id]);

        // // get role from query params
        // $role = $request->role;
        // if(!empty($role)){
        //     $data = $data->whereHas("roles", function($q) use ($role){ $q->where("key", $role); });
        // }

        // $data = $data->orderBy('id','DESC')->paginate(5);
        // return view($this->prefix.'.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);

        if ($request->ajax()) {
            return $this->datatable($request);
        }

        return view($this->prefix.'.index');
    }

    /**
     * Get Available Jenjang List
     */
    private function getJenjang(){
        // get list jenjang
        $jenjangs = Jenjang::whereNull('uploader_id')->get();
        
        $jenjangList = [];
        $jenjangList[""] = "Semua Jenjang";
        foreach($jenjangs as $jenjang){
            $jenjangList[$jenjang->id] = $jenjang->name;
        }

        return $jenjangList;
    }

    /**
     * Get Mata Pelajaran
     */
    private function getMataPelajaran(){
        // get list jenjang
        $mapels = MataPelajaran::whereNotIn('id', User::whereNotNull('mata_pelajaran_id')->pluck('mata_pelajaran_id'))->get();
        
        $mapelList = [];
        // $mapelList[""] = "-";
        foreach($mapels as $mapel){
            $mapelList[$mapel->id] = $mapel->name . " (Kelas ". @$mapel->kelas->name ." ".@$mapel->kelas->jenjang->name.")";
        }

        return $mapelList;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $jenjangList = $this->getJenjang();
        $mapelList = $this->getMataPelajaran();

        return view($this->prefix.'.create',compact('roles', 'jenjangList', 'mapelList'));
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
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->except(['uploader_jenjang_id']);
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // if guru
        if(strtolower(@$request->input('roles')[0]) === "guru"){
            // validate assign uploader
            // $this->validate($request, [
            //     'uploader_jenjang_id' => 'required'
            // ]);

            // check jenjang
            if($request->uploader_jenjang_id){
                $jenjang = Tingkat::find($request->uploader_jenjang_id);
                $jenjang->update(['uploader_id' => $user->id]);
            }
        }
    
        return redirect()->route($this->routePath.'.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view($this->prefix.'.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $data->roles->pluck('name','name')->all();
        $jenjangList = $this->getJenjang();
        $mapelList = $this->getMataPelajaran();

        // get selected jenjang
        $uploaderTingkat = @$data->uploaderTingkat;
        if($uploaderTingkat){
            $jenjangList[$uploaderTingkat->id] = $uploaderTingkat->name;
            $data->uploader_jenjang_id = $uploaderTingkat->id;
        }

        // get selected mapel
        $mapel = @$data->mataPelajaran;
        if($mapel){
            $mapelList[$mapel->id] = $mapel->name . " (Kelas ". @$mapel->kelas->name ." ".@$mapel->kelas->jenjang->name.")";
        }
    
        return view($this->prefix.'.edit', compact('data','roles','userRole', 'jenjangList', 'mapelList'));
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
            'username' => 'required|unique:users,username,'.$id,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));

        // if guru
        if(strtolower(@$request->input('roles')[0]) === "guru"){
            // validate assign uploader
            // $this->validate($request, [
            //     'uploader_jenjang_id' => 'required'
            // ]);
            
            // update jenjang sebelumnya
            if(@$user->uploaderTingkat){
                $jenjangBefore = Tingkat::find($user->uploaderTingkat->id);
                $jenjangBefore->update(['uploader_id' => null]);
            }

            // check jenjang
            if($request->uploader_jenjang_id){
                $jenjang = Tingkat::find($request->uploader_jenjang_id);
                $jenjang->update(['uploader_id' => $user->id]);
            }
        }
    
        return redirect()->route($this->routePath.'.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return null
     */
    public function destroy(Request $request, $id){
        $d = User::findOrFail($id);

        $d->delete();
    }
}