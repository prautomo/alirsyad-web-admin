<?php    
namespace App\Http\Controllers\Guru;

/*
 * @Author      : Ferdhika Yudira 
 * @Date        : 2021-09-12 11:17:32 
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use DB;
    
class DashboardController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];

        return view('pages.guru.dashboard', $data);
    }
}