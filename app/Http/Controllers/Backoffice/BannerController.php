<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Banner;

class BannerController extends Controller{

    function __construct(){
        $this->middleware('permission:banner-list|banner-create|banner-edit|banner-delete', ['only' => ['index','show']]);
        $this->middleware('permission:banner-create', ['only' => ['create','store']]);
        $this->middleware('permission:banner-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:banner-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.banners';
        $this->routePath = 'backoffice::banners';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = Banner::query();

        return datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where('title', 'LIKE', '%'.$search.'%');
                }
            })
            ->addIndexColumn()
            ->addColumn('show-img', function($data) {
                return view("components.datatable.image", [
                    "url" => asset($data->image)
                ]);
            })
            ->addColumn('status', function($data) {
                return @$data->activeStatus ? "Ditampilkan" : "Disembunyikan";
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'banner',
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
                    "viewPdfRoute" => asset(@$data->file),
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

    /**
     * Get List Teacher Uploader
     */
    private function getGuruUploader(){
        // get list banner
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
    
    public function create(){
        $activeStatus = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        return view($this->prefix.'.create', ['activeStatus' => $activeStatus]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'title' => 'required|string',
            'image' => 'required',
            'file' => 'required',
        ]);

        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['description', 'title', 'image', 'file', 'urutan', 'activeStatus']);

        if ($request->hasFile('image')) {

            $validated = $request->validate([
                'image' => 'mimes:jpeg,png|max:22028',
            ]);

            $image = $request->file('image');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'banners');
            $dataReq['image'] = $url;
        }

        if ($request->hasFile('file')) {
            $fileModul = $request->file('file');
            $extension = $fileModul->extension();
            $url = UploadService::uploadFile($fileModul, 'uploads/banners');
            $dataReq['file'] = $url;
        }

        $data = Banner::create($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Banner"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Banner::findOrFail($id);
        $activeStatus = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        return view($this->prefix.'.edit', ['data'=>$dt, 'activeStatus' => $activeStatus]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'title' => 'required|string'
        ]);
        
        $dt = Banner::findOrFail($id);

        $dataReq = $request->only(['description', 'title', 'image', 'file', 'urutan', 'activeStatus']);
        
        if ($request->hasFile('image')) {
            $validated = $request->validate([
                'image' => 'mimes:jpeg,png|max:22028',
            ]);

            $image = $request->file('image');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'banners');
            $dataReq['image'] = $url;
        }

        if ($request->hasFile('file')) {
            $fileModul = $request->file('file');
            $extension = $fileModul->extension();
            $url = UploadService::uploadFile($fileModul, 'uploads/banners');
            $dataReq['file'] = $url;
        }

        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Banner"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Banner::findOrFail($id);

        $d->delete();
    }
}