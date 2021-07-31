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
use App\Models\SubCategory;
use App\Helpers\GenerateSlug;

class SubCategoryController extends Controller{

    function __construct(){
        $this->middleware('permission:subcategory-list|subcategory-create|subcategory-edit|subcategory-delete', ['only' => ['index','show']]);
        $this->middleware('permission:subcategory-create', ['only' => ['create','store']]);
        $this->middleware('permission:subcategory-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:subcategory-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.sub_categories';
        $this->routePath = 'backoffice::sub_categories';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable($categoryId){
        $query = SubCategory::query()->where('category_id', $categoryId);

        return datatables()
            ->of($query)
            ->addColumn("action", function ($data) use ($categoryId) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", ['categoryId' => $categoryId, 'id' => $data->id]),
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->toJson();
    }

    public function index(Request $request, $categoryId){
        if ($request->ajax()) {
            return $this->datatable($categoryId);
        }

        $category = Category::findOrFail($categoryId);

        return view($this->prefix.'.index', compact('categoryId', 'category'));
    }

    public function create(Request $request, $categoryId){
        return view($this->prefix.'.create', compact('categoryId'));
    }

    public function store(Request $request, $categoryId){
        // validasi form
        $this->validate($request, [
            'slug' => 'unique:categories,slug',
            'name' => 'required|string'
        ]);
        // temp request
        $dataReq = $request->only(['class', 'name', 'slug']);
        $dataReq['category_id'] = $categoryId;
        $data = SubCategory::create($dataReq);

        if(empty($request->slug)){
            $data->slug = GenerateSlug::generateSlug($data->id, $data->name);
            $data->save();
        }

        return redirect()->route($this->routePath.'.index', ['categoryId' => $categoryId])->with(
            $this->success(__("Success to create SubCategory"), $data)
        );
    }

    public function edit(Request $request, $categoryId, $id){
        $dt = SubCategory::findOrFail($id);

        return view($this->prefix.'.edit', ['data'=>$dt, 'categoryId'=> $categoryId]);
    }

    public function update(Request $request, $categoryId, $id){
        // validasi form
        $this->validate($request, [
            'slug' => 'unique:categories,slug,'.$id,
            'name' => 'required|string'
        ]);

        $dataReq = $request->only(['class', 'name', 'slug']);

        if(empty($request->slug)){
            $dataReq['slug'] = GenerateSlug::generateSlug($id, $request->name);
        }

        $dt = SubCategory::findOrFail($id);
        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index', ['categoryId'=> $categoryId])->with(
            $this->success(__("Success to update SubCategory"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = SubCategory::findOrFail($id);

        $d->delete();
    }
}
