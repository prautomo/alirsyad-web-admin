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

class KontenController extends Controller{

    function __construct(){
        // $this->middleware('permission:konten-list|konten-create|konten-edit|konten-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:konten-create', ['only' => ['create','store']]);
        // $this->middleware('permission:konten-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:konten-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.kontens';
        $this->routePath = 'backoffice::kontens';
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
                    // "permissionName" => 'konten',
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
        // $this->validate($request, [
        //     'name' => 'required|string',
        // ]);

        $unzipper = new ExtractArchive;

        $fileArchive = $request->file('game');
        $extpath = "uploads/game";
        
        $archive = isset($fileArchive) ? $fileArchive : null;
        $destination = isset($extpath) ? strip_tags($extpath) : '';
        $unzipper->extract($archive, $destination);

        dd($archive, $destination);

        $data = Tingkat::create($request->only(['description', 'name']));

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to create Tingkat"), $data)
        );
    }
}