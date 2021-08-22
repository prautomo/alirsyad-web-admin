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
use App\Models\Tingkat;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::whereNotIn('id', [\Auth::user()->id]);

        // get role from query params
        $role = $request->role;
        if(!empty($role)){
            $data = $data->whereHas("roles", function($q) use ($role){ $q->where("key", $role); });
        }

        $data = $data->orderBy('id','DESC')->paginate(5);
        return view($this->prefix.'.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Get Available Tingkat List
     */
    private function getTingkat(){
        // get list tingkat
        $tingkats = Tingkat::whereNull('uploader_id')->get();
        
        $tingkatList = [];
        $tingkatList[""] = "Bukan Uploader";
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
        $roles = Role::pluck('name','name')->all();
        $tingkatList = $this->getTingkat();

        return view($this->prefix.'.create',compact('roles', 'tingkatList'));
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
    
        $input = $request->except(['uploader_tingkat_id']);
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // if guru
        if(strtolower(@$request->input('roles')[0]) === "guru"){
            // validate assign uploader
            // $this->validate($request, [
            //     'uploader_tingkat_id' => 'required'
            // ]);

            // check tingkat
            if($request->uploader_tingkat_id){
                $tingkat = Tingkat::find($request->uploader_tingkat_id);
                $tingkat->update(['uploader_id' => $user->id]);
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
        $tingkatList = $this->getTingkat();

        // get selected tingkat
        $uploaderTingkat = @$data->uploaderTingkat;
        if($uploaderTingkat){
            $tingkatList[$uploaderTingkat->id] = $uploaderTingkat->name;
            $data->uploader_tingkat_id = $uploaderTingkat->id;
        }
    
        return view($this->prefix.'.edit',compact('data','roles','userRole', 'tingkatList'));
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
            //     'uploader_tingkat_id' => 'required'
            // ]);
            
            // update tingkat sebelumnya
            if(@$user->uploaderTingkat){
                $tingkatBefore = Tingkat::find($user->uploaderTingkat->id);
                $tingkatBefore->update(['uploader_id' => null]);
            }

            // check tingkat
            if($request->uploader_tingkat_id){
                $tingkat = Tingkat::find($request->uploader_tingkat_id);
                $tingkat->update(['uploader_id' => $user->id]);
            }
        }
    
        return redirect()->route($this->routePath.'.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        
        return redirect()->route($this->routePath.'.index')
                        ->with('success', 'User deleted successfully');
    }
}