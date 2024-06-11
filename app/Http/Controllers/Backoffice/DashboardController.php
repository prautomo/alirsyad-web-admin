<?php    
namespace App\Http\Controllers\Backoffice;

/*
 * @Author      : Ferdhika Yudira 
 * @Date        : 2020-07-18 14:17:32 
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ERaport;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\PaketSoal;
use App\Models\Tingkat;
use DB;
use Illuminate\Support\Facades\Auth;

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
        // dd(Auth::user()->roles->pluck('name'));
        return view('pages.backoffice.dashboard.superadmin', $data);

        // return view('pages.backoffice.dashboard.guru_mapel', $data);
    }

    public function allJenjang(Request $request)
    {
        $result = [];
        $result_ids = [];

        $jenjangs = Jenjang::where(['deleted_at' => NULL, 'show_for_guest' => 1])->get();
        $tingkat_kesulitans = [
            [
                "level" => "mudah",
                "bobot" => 1
            ],
            [
                "level" => "sedang",
                "bobot" => 2
            ],
            [
                "level" => "sulit",
                "bobot" => 3
            ]
        ];

        foreach($jenjangs as $jenjang){
            $count_score = 0;
            foreach($tingkat_kesulitans as $tingkat_kesulitan){
                $paket_soals = PaketSoal::whereHas('mataPelajaran.tingkat.jenjang', function ($query2) use ($jenjang) {
                    $query2->where('id', '=',  $jenjang->id);
                })->where(['tingkat_kesulitan' => $tingkat_kesulitan['level'], 'deleted_at' => NULL])->get();
                foreach($paket_soals as $paket_soal){
                    $siswa_ids = ERaport::where(['paket_soal_id' => $paket_soal->id])->distinct()->pluck('user_id')->toArray();
                    foreach($siswa_ids as $siswa_id){
                        $eraport = ERaport::where(['paket_soal_id' => $paket_soal->id, 'user_id' => $siswa_id])->orderBy('created_at')->first();
                        $count_score += $eraport->total_benar * $tingkat_kesulitan['bobot'];
                    }
                }
            }
            array_push($result, [
                "label" => $jenjang->name,
                "score" => $count_score
            ]);
            array_push($result_ids, $jenjang->id);
        }

        $next_api = [
            "name" => "tingkat",
            "param" => "jenjang_id",
        ];
        
        $data = [
            "level" => "jenjang",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getDataTingkat(Request $request)
    {
        $jenjang_id = 0;
        if($request->jenjang_id){
            $jenjang_id = $request->jenjang_id;
        }
        
        $result = [];
        $result_ids = [];

        $tingkats = Tingkat::where(['deleted_at' => NULL, 'jenjang_id' => $jenjang_id])->get();
        $tingkat_kesulitans = [
            [
                "level" => "mudah",
                "bobot" => 1
            ],
            [
                "level" => "sedang",
                "bobot" => 2
            ],
            [
                "level" => "sulit",
                "bobot" => 3
            ]
        ];

        foreach($tingkats as $tingkat){
            $count_score = 0;
            foreach($tingkat_kesulitans as $tingkat_kesulitan){
                $paket_soals = PaketSoal::whereHas('mataPelajaran.tingkat', function ($query2) use ($tingkat) {
                    $query2->where('id', '=',  $tingkat->id);
                })->where(['tingkat_kesulitan' => $tingkat_kesulitan['level'], 'deleted_at' => NULL])->get();
                foreach($paket_soals as $paket_soal){
                    $siswa_ids = ERaport::where(['paket_soal_id' => $paket_soal->id])->distinct()->pluck('user_id')->toArray();
                    foreach($siswa_ids as $siswa_id){
                        $eraport = ERaport::where(['paket_soal_id' => $paket_soal->id, 'user_id' => $siswa_id])->orderBy('created_at')->first();
                        $count_score += $eraport->total_benar * $tingkat_kesulitan['bobot'];
                    }
                }
            }
            array_push($result, [
                "label" => $tingkat->jenjang->name . " " . $tingkat->name,
                "score" => $count_score
            ]);
            array_push($result_ids, $tingkat->id);
        }

        $next_api = [
            "name" => "kelas",
            "param" => "tingkat_id",
        ];
        
        $data = [
            "level" => "tingkat",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }

    
    public function getDataKelas(Request $request)
    {
        $tingkat_id = 0;
        if($request->tingkat_id){
            $tingkat_id = $request->tingkat_id;
        }
        
        $result = [];
        $result_ids = [];

        $classes = Kelas::where(['deleted_at' => NULL, 'tingkat_id' => $tingkat_id])->get();
        $tingkat_kesulitans = [
            [
                "level" => "mudah",
                "bobot" => 1
            ],
            [
                "level" => "sedang",
                "bobot" => 2
            ],
            [
                "level" => "sulit",
                "bobot" => 3
            ]
        ];

        foreach($classes as $class){
            $count_score = 0;
            foreach($tingkat_kesulitans as $tingkat_kesulitan){
                $paket_soals = PaketSoal::whereHas('mataPelajaran.tingkat', function ($query2) use ($class) {
                    $query2->where('id', '=',  $class->tingkat->id);
                })->where(['tingkat_kesulitan' => $tingkat_kesulitan['level'], 'deleted_at' => NULL])->get();
                foreach($paket_soals as $paket_soal){
                    $siswa_ids = ERaport::where(['paket_soal_id' => $paket_soal->id])->whereHas('external_user.kelas', function ($query2) use ($class) {
                        $query2->where('id', '=',  $class->id);
                    })->distinct()->pluck('user_id')->toArray();
                            
                    foreach($siswa_ids as $siswa_id){
                        $eraport = ERaport::where(['paket_soal_id' => $paket_soal->id, 'user_id' => $siswa_id])->orderBy('created_at')->first();
                        $count_score += $eraport->total_benar * $tingkat_kesulitan['bobot'];
                    }
                }
            }
            array_push($result, [
                "label" => $class->tingkat->jenjang->name . " " . $class->tingkat->name . " " . $class->name,
                "score" => $count_score
            ]);
            array_push($result_ids, $class->id);
        }

        $next_api = [
            "name" => "mapel",
            "param" => "kelas_id",
        ];

        
        $data = [
            "level" => "kelas",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }
}