<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Services\UploadService;
use App\Models\Category;
use App\Helpers\GenerateSlug;

class CategoryController extends Controller{

    function __construct(){
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.categories';
        $this->routePath = 'backoffice::categories';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(){
        $query = Category::query();

        return datatables()
            ->of($query)
            ->addColumn('show-img', function($data) {
                if(empty($data->icon)){
                    return "not available";
                }else{
                    return view("components.datatable.image", [
                        "url" => asset($data->icon)
                    ]);
                }
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
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
            return $this->datatable();
        }

        return view($this->prefix.'.index');
    }

    public function create(){
        return view($this->prefix.'.create');
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['class', 'name', 'icon', 'slug']);

        if ($request->hasFile('icon')) {

            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/categories');
            $dataReq['icon'] = $url;
        }

        $data = Category::create($dataReq);

        if(empty($request->slug)){
            $data->slug = GenerateSlug::generateSlug($data->id, $data->name);
            $data->save();
        }

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Category"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = Category::findOrFail($id);

        return view($this->prefix.'.edit', ['data'=>$dt]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'slug' => 'unique:categories,slug,'.$id,
            'name' => 'required|string'
        ]);

        $dataReq = $request->only(['class', 'name', 'icon', 'slug']);

        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/categories');

            $dataReq['icon'] = $url;
        }

        if(empty($request->slug)){
            $dataReq['slug'] = GenerateSlug::generateSlug($id, $request->name);
        }

        $dt = Category::findOrFail($id);
        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Category"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = Category::findOrFail($id);

        $d->delete();
    }
}
