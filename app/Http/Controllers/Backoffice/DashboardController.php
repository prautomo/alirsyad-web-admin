<?php    
namespace App\Http\Controllers\Backoffice;

/*
 * @Author      : Ferdhika Yudira 
 * @Date        : 2020-07-18 14:17:32 
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return view('pages.backoffice.dashboard.guru_mapel', $data);
    }
}