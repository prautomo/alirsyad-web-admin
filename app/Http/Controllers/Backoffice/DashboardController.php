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
use App\Models\ExternalUser;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Modul;
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
            "next_api" => $next_api,
            "graphic_title" => "Ringkasan Grafik"
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
        
        $jenjang = Jenjang::find($jenjang_id);
        $data = [
            "level" => "tingkat",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "graphic_title" => $jenjang->name
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
                "label" => $class->tingkat->jenjang->name . " " . $class->tingkat->name . $class->name,
                "score" => $count_score
            ]);
            array_push($result_ids, $class->id);
        }

        $next_api = [
            "name" => "mapel",
            "param" => "kelas_id",
        ];

        $tingkat = Tingkat::find($tingkat_id);
        $data = [
            "level" => "kelas",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "graphic_title" => $tingkat->jenjang->name . " " . $tingkat->name
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function getDataMapel(Request $request)
    {
        $kelas_id = 0;
        if($request->kelas_id){
            $kelas_id = $request->kelas_id;
        }
        
        $result = [];
        $result_ids = [];

        $tingkat_id = Kelas::find($kelas_id)->tingkat_id;
        $mata_pelajarans = MataPelajaran::where(['deleted_at' => NULL, 'tingkat_id' => $tingkat_id])->orderBy('urutan')->get();
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

        foreach($mata_pelajarans as $mata_pelajaran){
            $count_score = 0;
            foreach($tingkat_kesulitans as $tingkat_kesulitan){
                $paket_soals = PaketSoal::whereHas('mataPelajaran', function ($query2) use ($mata_pelajaran) {
                    $query2->where('id', '=',  $mata_pelajaran->id);
                })->where(['tingkat_kesulitan' => $tingkat_kesulitan['level'], 'deleted_at' => NULL])->get();
                foreach($paket_soals as $paket_soal){
                    $siswa_ids = ERaport::where(['paket_soal_id' => $paket_soal->id])->whereHas('external_user.kelas', function ($query2) use ($kelas_id) {
                        $query2->where('id', '=',  $kelas_id);
                    })->distinct()->pluck('user_id')->toArray();
                            
                    foreach($siswa_ids as $siswa_id){
                        $eraport = ERaport::where(['paket_soal_id' => $paket_soal->id, 'user_id' => $siswa_id])->orderBy('created_at')->first();
                        $count_score += $eraport->total_benar * $tingkat_kesulitan['bobot'];
                    }
                }
            }
            array_push($result, [
                "label" => $mata_pelajaran->name,
                "score" => $count_score
            ]);
            array_push($result_ids, $mata_pelajaran->id);
        }

        $next_api = [
            "name" => "bab",
            "param" => "mapel_id",
        ];

        $kelas = Kelas::find($kelas_id);
        $data = [
            "level" => "mapel",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "kelas_id" => $kelas_id,
            "graphic_title" => $kelas->tingkat->jenjang->name . " " . $kelas->tingkat->name . $kelas->name
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function getDataBab(Request $request)
    {
        $mapel_id = 0;
        $kelas_id = 0;

        if($request->mapel_id){
            $mapel_id = $request->mapel_id;
        }

        if($request->kelas_id){
            $kelas_id = $request->kelas_id;
        }
        
        $result = [];
        $result_ids = [];

        $babs = Modul::where(['deleted_at' => NULL, 'mata_pelajaran_id' => $mapel_id])->orderBy('urutan')->get();
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

        foreach($babs as $bab){
            $count_score = 0;
            foreach($tingkat_kesulitans as $tingkat_kesulitan){
                $paket_soals = PaketSoal::where(['bab_id' => $bab->id, 'tingkat_kesulitan' => $tingkat_kesulitan['level'], 'deleted_at' => NULL])->get();
                foreach($paket_soals as $paket_soal){
                    $siswa_ids = ERaport::where(['paket_soal_id' => $paket_soal->id])->whereHas('external_user.kelas', function ($query2) use ($kelas_id) {
                        $query2->where('id', '=',  $kelas_id);
                    })->distinct()->pluck('user_id')->toArray();
                            
                    foreach($siswa_ids as $siswa_id){
                        $eraport = ERaport::where(['paket_soal_id' => $paket_soal->id, 'user_id' => $siswa_id])->orderBy('created_at')->first();
                        $count_score += $eraport->total_benar * $tingkat_kesulitan['bobot'];
                    }
                }
            }
            array_push($result, [
                "label" => $bab->name,
                "score" => $count_score
            ]);
            array_push($result_ids, $bab->id);
        }

        $next_api = [
            "name" => "subbab",
            "param" => "bab_id",
        ];

        $kelas = Kelas::find($kelas_id);
        $mapel = MataPelajaran::find($mapel_id);
        $data = [
            "level" => "bab",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "kelas_id" => $kelas_id,
            "graphic_title" => $kelas->tingkat->jenjang->name . " " . $kelas->tingkat->name . $kelas->name . " / " . $mapel->name
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getDataSubbab(Request $request)
    {
        $bab_id = 0;
        $kelas_id = 0;

        if($request->bab_id){
            $bab_id = $request->bab_id;
        }

        if($request->kelas_id){
            $kelas_id = $request->kelas_id;
        }
        
        $result = [];
        $result_ids = [];

        $subbab_ids = PaketSoal::where(['deleted_at' => NULL, 'bab_id' => $bab_id])->distinct()->pluck('subbab')->toArray();
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

        foreach($subbab_ids as $subbab_id){
            $count_score = 0;
            foreach($tingkat_kesulitans as $tingkat_kesulitan){
                $paket_soals = PaketSoal::where(['subbab' => $subbab_id, 'bab_id' => $bab_id, 'tingkat_kesulitan' => $tingkat_kesulitan['level'], 'deleted_at' => NULL])->get();
                foreach($paket_soals as $paket_soal){
                    $siswa_ids = ERaport::where(['paket_soal_id' => $paket_soal->id])->whereHas('external_user.kelas', function ($query2) use ($kelas_id) {
                        $query2->where('id', '=',  $kelas_id);
                    })->distinct()->pluck('user_id')->toArray();
                            
                    foreach($siswa_ids as $siswa_id){
                        $eraport = ERaport::where(['paket_soal_id' => $paket_soal->id, 'user_id' => $siswa_id])->orderBy('created_at')->first();
                        $count_score += $eraport->total_benar * $tingkat_kesulitan['bobot'];
                    }
                }
            }
            $subbab = PaketSoal::where(['subbab' => $subbab_id, 'bab_id' => $bab_id, 'deleted_at' => NULL])->first();
            array_push($result, [
                "label" => $subbab->judul_subbab,
                "score" => $count_score
            ]);
            array_push($result_ids, $subbab->subbab);
        }

        $next_api = [
            "name" => "siswa",
            "param" => "subbab_number",
        ];

        $kelas = Kelas::find($kelas_id);
        $bab = Modul::find($bab_id);
        $data = [
            "level" => "subbab",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "kelas_id" => $kelas_id,
            "bab_id" => $bab_id,
            "graphic_title" => $kelas->tingkat->jenjang->name . " " . $kelas->tingkat->name . $kelas->name . " / " . $bab->mataPelajaran->name . " " . $bab->name
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function getDataSiswa(Request $request)
    {
        $bab_id = 0;
        $subbab_number = 0;
        $kelas_id = 0;

        if($request->bab_id){
            $bab_id = $request->bab_id;
        }

        if($request->subbab_number){
            $subbab_number = $request->subbab_number;
        }

        if($request->kelas_id){
            $kelas_id = $request->kelas_id;
        }
        
        $result = [];
        $result_ids = [];

        $tingkat_id = Kelas::find($kelas_id)->tingkat_id;
        $siswas =  ExternalUser::where(['kelas_id' => $kelas_id, 'deleted_at' => NULL])->get();
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

        foreach($siswas as $siswa){
            $count_score = 0;
            foreach($tingkat_kesulitans as $tingkat_kesulitan){
                $paket_soals = PaketSoal::where(['bab_id' => $bab_id, 'subbab' => $subbab_number, 'tingkat_kesulitan' => $tingkat_kesulitan['level'], 'deleted_at' => NULL])->get();
                foreach($paket_soals as $paket_soal){
                    $eraport = ERaport::where(['paket_soal_id' => $paket_soal->id, 'user_id' => $siswa->id])->orderBy('created_at')->first();
                    $count_score += $eraport->total_benar * $tingkat_kesulitan['bobot'];
                }
            }
            array_push($result, [
                "label" => $siswa->name,
                "score" => $count_score
            ]);
            array_push($result_ids, $siswa->id);
        }

        $next_api = [
            "name" => "",
            "param" => "",
        ];
        
        $kelas = Kelas::find($kelas_id);
        $bab = Modul::find($bab_id);
        $subbab = PaketSoal::where(['subbab' => $subbab_number, 'bab_id' => $bab_id, 'deleted_at' => NULL])->first();

        $data = [
            "level" => "siswa",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "kelas_id" => $kelas_id,
            "graphic_title" => $kelas->tingkat->jenjang->name . " " . $kelas->tingkat->name . $kelas->name . " / " . $bab->mataPelajaran->name . " " . $bab->name . " " . $subbab->judul_subbab
        ];
        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
}