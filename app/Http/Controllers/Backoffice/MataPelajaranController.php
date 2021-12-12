<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Services\UploadService;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Helpers\GenerateSlug;

class MataPelajaranController extends Controller{

    function __construct(){
        $this->middleware('permission:mata_pelajaran-list|mata_pelajaran-create|mata_pelajaran-edit|mata_pelajaran-delete', ['only' => ['index','show']]);
        $this->middleware('permission:mata_pelajaran-create', ['only' => ['create','store']]);
        $this->middleware('permission:mata_pelajaran-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:mata_pelajaran-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.mata_pelajarans';
        $this->routePath = 'backoffice::mata_pelajarans';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable($request){
        $query = MataPelajaran::query();

        // relation with tingkat
        $query = $query->with('tingkat.jenjang');

        return datatables()
            ->of($query)
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
                }
            })
            ->addIndexColumn()
            ->addColumn("jenjang", function ($data) {
                return @$data->tingkat->jenjang ? $data->tingkat->jenjang->name : '-';
            })
            ->addColumn("tingkat", function ($data) {
                return @$data->tingkat ? $data->tingkat->name : '-';
            })
            ->addColumn('show-img', function($data) {
                if(empty($data->icon)){
                    return "not available";
                }else{
                    return view("components.datatable.image", [
                        "url" => asset($data->icon)
                    ]);
                }
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
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
            return $this->datatable($request);
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
            $tingkatList[$tingkat->id] = $tingkat->name . " " . @$tingkat->jenjang->name;
        }

        return $tingkatList;
    }

    public function create(){
        $tingkatList = $this->getTingkat();

        return view($this->prefix.'.create', ['tingkatList' => $tingkatList]);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            // 'name' => 'required|string',
            'tingkat_id' => 'required',
            'name' => Rule::unique('mata_pelajarans')->where(function ($query) use ($request) {
                return $query->where('name', $request->name)
                   ->where('tingkat_id', $request->tingkat_id);
            }),
        ]);
        // default image
        $url = "images/placeholder.png";
        // temp request
        $dataReq = $request->only(['class', 'name', 'icon', 'slug', 'tingkat_id', 'urutan']);

        if ($request->hasFile('icon')) {

            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/mata_pelajarans');
            $dataReq['icon'] = $url;
        }

        $data = MataPelajaran::create($dataReq);

        if(empty($request->slug)){
            $data->slug = GenerateSlug::generateSlug($data->id, $data->name);
            $data->save();
        }

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create MataPelajaran"), $data)
        );
    }

    public function edit(Request $request, $id){
        $dt = MataPelajaran::with('tingkat')->findOrFail($id);
        $tingkatList = $this->getTingkat();

        return view($this->prefix.'.edit', ['data' => $dt, 'tingkatList' => $tingkatList]);
    }

    public function update(Request $request, $id){
        // validasi form
        $this->validate($request, [
            'slug' => 'unique:mata_pelajarans,slug,'.$id,
            // 'name' => 'required|string',
            'tingkat_id' => 'required',
            'name' => Rule::unique('mata_pelajarans')->ignore($id)->where(function ($query) use ($request) {
                return $query->where('name', $request->name)
                   ->where('tingkat_id', $request->tingkat_id);
            }),
        ]);

        $dataReq = $request->only(['class', 'name', 'icon', 'slug', 'tingkat_id', 'urutan']);

        if ($request->hasFile('icon')) {
            $validated = $request->validate([
                'icon' => 'mimes:jpeg,png|max:2028',
            ]);

            $image = $request->file('icon');
            $extension = $image->extension();
            $url = UploadService::uploadImage($image, 'icon/mata_pelajarans');

            $dataReq['icon'] = $url;
        }

        if(empty($request->slug)){
            $dataReq['slug'] = GenerateSlug::generateSlug($id, $request->name);
        }

        $dt = MataPelajaran::findOrFail($id);
        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update MataPelajaran"), $dt)
        );
    }

    public function destroy(Request $request, $id){
        $d = MataPelajaran::findOrFail($id);

        $d->delete();
    }
}
