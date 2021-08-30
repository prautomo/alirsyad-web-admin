<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Tingkat;
use App\Helpers\ExtractArchive;

class ModulController extends Controller{

    function __construct(){
        $this->middleware('permission:modul-list|modul-create|modul-edit|modul-delete', ['only' => ['index','show']]);
        $this->middleware('permission:modul-create', ['only' => ['create','store']]);
        $this->middleware('permission:modul-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:modul-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.moduls';
        $this->routePath = 'backoffice::moduls';
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
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    // "permissionName" => 'modul',
                    // "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    // "editRoute" => route($this->routePath.".edit", $data->id),
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
            'name' => 'required|string',
            'game' => 'required|file|mimes:zip',
        ]);

        $fileArchive = $request->file('game');
        $extpath = "uploads/simulasi/".strtolower(str_replace(" ", "_", $request->name));
    
        $zip = new \ZipArchive;
        if ($zip->open($fileArchive) === TRUE) {
            $zip->extractTo($extpath);
            $zip->close();
            echo 'ok';
        } else {
            echo 'failed';
        }
        dd($fileArchive);

        $data = Tingkat::create($request->only(['description', 'name']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Tingkat"), $data)
        );
    }
}