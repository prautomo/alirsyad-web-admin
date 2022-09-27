<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Services\UploadService;
use App\Models\Modul;
use App\Helpers\GenerateSlug;

class SoalController extends Controller{
    
    function __construct(){
        $this->middleware('permission:soal-list|soal-create|soal-edit|soal-delete', ['only' => ['index','show']]);
        $this->middleware('permission:soal-create', ['only' => ['create','store']]);
        $this->middleware('permission:soal-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:soal-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.soals';
        $this->routePath = 'backoffice::soals';
    }

    public function create(){

        return view($this->prefix.'.subab.create', []);
    }

}