<?php    
namespace App\Http\Controllers\Guru;

/*
 * @Author      : Ferdhika Yudira 
 * @Date        : 2021-11-20 11:17:32 
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\MataPelajaran;
use DB;
    
class ProgressController extends Controller {

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
        // parse data
        $data = [
            
        ];

        return view('pages.guru.progress.list_siswa', $data);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailSiswa(Request $request, $mapelId, $siswaId)
    {
        // get mapel info
        $mapel = MataPelajaran::find($mapelId);
        
        // get siswa info
        $siswa = ExternalUser::find($siswaId);

        // parse data
        $data = [
            'mataPelajaran' => $mapel,
            'siswa' => $siswa,
        ];

        return view('pages.guru.progress.detail_siswa', $data);
    }
}