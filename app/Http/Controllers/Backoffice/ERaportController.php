<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ERaport;
use App\Models\ExternalUser;
use App\Models\GuruMataPelajaran;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\PaketSoal;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ERaportController extends Controller
{
    function __construct(){
        $this->middleware('permission:e-raport-list', ['only' => ['index','show']]);

        $this->prefix = 'pages.backoffice.e-raport';
        $this->routePath = 'backoffice::e-raport';
    }
    
    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = ExternalUser::query();

        // filter if its other roles than superadmin
        $activeRole = Session::get('activeRole');
        if ($activeRole == "Guru Mata Pelajaran") {
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $kelas_ids = GuruMataPelajaran::where([
                'guru_id' => $guru->id
            ])->pluck('kelas_id');
            
            $query = $query->whereIn('kelas_id', $kelas_ids);
        }else if($activeRole == "Wali Kelas"){
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $kelas = Kelas::where(['wali_kelas_id' => $guru->id])->first();

            if($kelas){
                $query = $query->where('kelas_id', $kelas->id);
            }
        }else if($activeRole == "Kepala Sekolah"){
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $jenjang = Jenjang::where(['kepala_sekolah_id' => $guru->id])->first();

            if($jenjang){
                $query = $query->whereHas('kelas.tingkat.jenjang', function ($query2) use ($jenjang) {
                    $query2->where('id', '=',  $jenjang->id);
                });
            }
        }
        
        $datas = $query->where(['role' => 'SISWA', 'is_pengunjung' => 0, 'deleted_at' => NULL])->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];
                
                $tahun_ajaran = $request->tahun_ajaran;
                $jenjang_id = $request->jenjang_id;
                $tingkat_id = $request->tingkat_id;
                $kelas_id = $request->kelas_id;

                if($tahun_ajaran){
                    $query = $query->whereHas('classHistory', function($query2) use ($tahun_ajaran){
                        $query2->where('is_current', 1)->where('tahun_ajaran', 'LIKE', '%'. $tahun_ajaran. '%');
                    });
                }

                if($jenjang_id){
                    $query = $query->whereHas('kelas.tingkat.jenjang', function ($query2) use ($jenjang_id) {
                        $query2->where('id', '=',  $jenjang_id);
                    });
                }

                if($tingkat_id){
                    $query = $query->whereHas('kelas.tingkat', function ($query2) use ($tingkat_id) {
                        $query2->where('id', '=',  $tingkat_id);
                    });
                }
                
                if($kelas_id){
                    $query = $query->whereHas('kelas', function ($query2) use ($kelas_id) {
                        $query2->where('name', '=',  $kelas_id);
                    });
                }

                if($search){
                    $query->where(function($query) use ($search){
                        $query = $query->orWhereHas('external_user', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%')->orWhere('nis', 'LIKE', '%'.$search.'%');
                        });
                    });
                }

            })
            ->addIndexColumn()
            ->addColumn('nis', function($data) {
                return @$data->nis;
            })
            ->addColumn('name', function($data) {
                return @$data->name;
            })
            ->addColumn('jenjang', function($data) {
                return @$data->kelas->tingkat->jenjang->name;
            })
            ->addColumn('tingkat', function($data) {
                return @$data->kelas->tingkat->name;
            })
            ->addColumn('kelas', function($data) {
                return @$data->kelas->name;
            })
            ->addColumn("tahun_ajaran", function ($data) {
                $current_class = KelasSiswa::where(['siswa_id' => $data->id, 'is_current' => 1])->first();

                if($current_class != null){
                    return $current_class->tahun_ajaran;
                }

                return "";
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "permissionName" => 'e-raport',
                    "viewRoute" => route($this->routePath.".show", $data->id),
                    "viewBtnText" => "View"
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

    public function datatableShow(Request $request, $id){
        $query = MataPelajaran::query();

        $activeRole = Session::get('activeRole');

        // filter if its other roles than superadmin
        if ($activeRole == "Guru Mata Pelajaran") {
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $mapel_ids = GuruMataPelajaran::where([
                'guru_id' => $guru->id
            ])->pluck('mata_pelajaran_id');
            
            $query = $query->whereIn('id', $mapel_ids);
        }

        $user = ExternalUser::find($id);
        $datas = $query->where(['tingkat_id' => $user->kelas->tingkat->id])->select('*');

        return datatables()
            ->of($datas)
            ->addIndexColumn()
            ->addColumn('jumlah_bab', function($data) {
                return count(@$data->modul);
            })
            ->addColumn('jumlah_subbab', function($data) {
                $total_subbab = 0;

                foreach($data->modul as $bab){
                    $count_subbab = PaketSoal::where(['bab_id' => $bab->id, 'deleted_at' => null])
                        ->select('subbab', DB::raw('count(subbab) as total'))
                        ->groupBy('subbab')
                        ->get()->count();
                        
                    $total_subbab += $count_subbab;
                }

                return $total_subbab;
            })
            ->addColumn('final_score', function($data) use ($id) {
                $total = 0;
                $paket_soal_ids = PaketSoal::where(['mata_pelajaran_id' => $data->id, 'deleted_at' => null])->distinct()->pluck('id')->toArray();

                foreach ($paket_soal_ids as $paket_soal_id) {
                    $paket_soal = PaketSoal::find($paket_soal_id);
                    $score = ERaport::where(['user_id' => $id, 'paket_soal_id' => $paket_soal_id])->orderBy('created_at', 'DESC')->first();
                    $total_benar = 0;
                    if($score){
                        $total_benar = $score->total_benar;
                    }

                    $total += $this->getScoreFinal($total_benar, $paket_soal->tingkat_kesulitan);
                }
                return $total;
            })
            ->addColumn("action", function ($data) use ($user) {
                return view("components.datatable.actions", [
                    "permissionName" => 'e-raport',
                    "viewRoute" => route($this->routePath.".show-detail-mapel", [$user->id, $data->id]),
                    "viewBtnText" => "Detail Mapel"
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('urutan', 'asc');
            })
            ->toJson();
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            return $this->datatableShow($request, $id);
        }

        $user = ExternalUser::find($id);

        $current_class = KelasSiswa::where(['siswa_id' => $user->id, 'is_current' => 1])->first();
        if($current_class != null){
            $user['tahun_ajaran'] = $current_class->tahun_ajaran;
        }

        return view($this->prefix.'.show', ['user' => $user]);
    }

    public function getMapel($tingkat_id){
        $query = MataPelajaran::query();
        $data = $query->where(['tingkat_id' => $tingkat_id])->orderBy('urutan', 'asc')->get();

        return $data;
    }

    public function showDetailMapel(Request $request, $id, $mapelId)
    {
        $req_bab_id = $request->bab;
        $req_subbab_id = $request->subbab;
        $req_view_type = 'table';

        $auth_user_roles = Auth::user()->roles->pluck('name')->toArray();
        $is_guru_mapel = false;
        if (in_array("Guru Mata Pelajaran", $auth_user_roles)) {
            $is_guru_mapel = true;
        }

        if($request->view_type){
            $req_view_type = $request->view_type;
        }

        $user = ExternalUser::find($id);
        $user['tahun_ajaran'] = "";

        $current_class = KelasSiswa::where(['siswa_id' => $user->id, 'is_current' => 1])->first();
        
        if($current_class != null){
            $user['tahun_ajaran'] = $current_class->tahun_ajaran;
        }
        
        $mapel = MataPelajaran::find($mapelId);
        $bab_ids = PaketSoal::where(['mata_pelajaran_id' => $mapelId, 'deleted_at' => null])->distinct()->pluck('bab_id')->toArray();
        
        if($req_bab_id){
            $bab_ids = [$req_bab_id];
        }

        if($req_subbab_id){
            $paket_soal = PaketSoal::find($req_subbab_id);
            $bab_ids = [$paket_soal->bab_id];
        }

        $result = [
            "name" => $mapel->name,
            "mudah" => 0,
            "sedang" => 0,
            "sulit" => 0,
            "total" => 0,
            "babs" => [],
        ];
        
        foreach($bab_ids as $bab_id){
            $modul = Modul::find($bab_id);
            $subbabs = PaketSoal::where(['bab_id' => $bab_id, 'deleted_at' => null])->distinct()->pluck('subbab')->toArray();
                
            if($req_subbab_id){
                $paket_soal = PaketSoal::find($req_subbab_id);
                $subbabs = [$paket_soal->subbab];
            }

            $total_score = [
                "mudah" => 0,
                "sedang" => 0,
                "sulit" => 0,
                "total" => 0,
            ];
            $result_subbab = [];
            
            foreach($subbabs as $subbab){
                $subbab_paket_soals = PaketSoal::where(['bab_id' => $bab_id, 'subbab' => $subbab, 'deleted_at' => null])->get();
                $subbab_obj = [
                    "name" => "",
                    "mudah" => 0,
                    "sedang" => 0,
                    "sulit" => 0
                ];
                $total_per_subbab = 0;

                foreach($subbab_paket_soals as $paket_soal){
                    $subbab_obj['name'] = $paket_soal->judul_subbab;

                    $score = ERaport::where(['user_id' => $id, 'paket_soal_id' => $paket_soal->id])->orderBy('created_at', 'DESC')->first();
                    $total_benar = 0;
                    if($score){
                        $total_benar = $score->total_benar;
                    }
                    
                    $subbab_obj[$paket_soal->tingkat_kesulitan] = $total_benar;
                    $total_per_subbab += $this->getScoreFinal($total_benar, $paket_soal->tingkat_kesulitan);
                    $total_score[$paket_soal->tingkat_kesulitan] += $total_benar;
                    $result[$paket_soal->tingkat_kesulitan] += $total_benar;
                }

                $subbab_obj['total'] = $total_per_subbab;
                $total_score['total'] += $total_per_subbab;
                $result['total'] += $total_per_subbab;
                array_push($result_subbab, $subbab_obj);
            }

            $bab_obj = $total_score;
            $bab_obj['name'] = $modul->name;
            $bab_obj['subbabs'] = $result_subbab;
            array_push($result['babs'], $bab_obj);
        }

        $mapelList = $this->getMapel($user->kelas->tingkat->id);
        return view($this->prefix.'.show_mapel', ['data' => $result, 'mapelList' => $mapelList, 'selectedMapel' => $mapelId, 'user' => $user, 'viewType' => $req_view_type, 'isGuruMapel' => $is_guru_mapel]);
    }

    public function showDetailMapelGrafik(Request $request, $id, $mapelId)
    {
        $req_bab_id = $request->bab;
        $req_subbab_id = $request->subbab;

        $user = ExternalUser::find($id);
        $mapel = MataPelajaran::find($mapelId);
        $bab_ids = PaketSoal::where(['mata_pelajaran_id' => $mapelId, 'deleted_at' => null])->distinct()->pluck('bab_id')->toArray();
        
        if($req_bab_id){
            $bab_ids = [$req_bab_id];
        }

        if($req_subbab_id){
            $paket_soal = PaketSoal::find($req_subbab_id);
            $bab_ids = [$paket_soal->bab_id];
        }

        $result = [
            "label" => $mapel->name,
            "score" => 0,
            "babs" => [],
        ];
        
        foreach($bab_ids as $bab_id){
            $modul = Modul::find($bab_id);
            $subbabs = PaketSoal::where(['bab_id' => $bab_id, 'deleted_at' => null])->distinct()->pluck('subbab')->toArray();
                
            if($req_subbab_id){
                $paket_soal = PaketSoal::find($req_subbab_id);
                $subbabs = [$paket_soal->subbab];
            }

            $total_score = 0;
            $result_subbab = [];
            
            foreach($subbabs as $subbab){
                $subbab_paket_soals = PaketSoal::where(['bab_id' => $bab_id, 'subbab' => $subbab, 'deleted_at' => null])->get();
                $subbab_obj = [
                    "id" => "",
                    "label" => ""
                ];
                $total_per_subbab = 0;

                foreach($subbab_paket_soals as $paket_soal){
                    $subbab_obj['id'] = $paket_soal->id;
                    $subbab_obj['label'] = $paket_soal->judul_subbab;

                    $score = ERaport::where(['user_id' => $id, 'paket_soal_id' => $paket_soal->id])->orderBy('created_at', 'DESC')->first();
                    $total_benar = 0;
                    if($score){
                        $total_benar = $score->total_benar;
                    }
                    
                    $total_per_subbab += $this->getScoreFinal($total_benar, $paket_soal->tingkat_kesulitan);
                }

                $subbab_obj['score'] = $total_per_subbab;
                $total_score += $total_per_subbab;
                $result['score'] += $total_per_subbab;
                array_push($result_subbab, $subbab_obj);
            }

            $bab_obj['id'] = $modul->id;
            $bab_obj['label'] = $modul->name;
            $bab_obj['score'] = $total_score;
            $bab_obj['subbabs'] = $result_subbab;
            array_push($result['babs'], $bab_obj);
        }
        // dd($result);

        $mapelList = $this->getMapel($user->kelas->tingkat->id);
        // return view($this->prefix.'.show_mapel', ['data' => $result, 'mapelList' => $mapelList, 'selectedMapel' => $mapelId, 'user' => $user]);
        return response()->json(['message' => 'success', 'data' => $result]);

    }

    public function getScoreFinal($total_benar, $tingkat_kesulitan){
        $score = 0;
        switch ($tingkat_kesulitan) {
            case "mudah":
                $score = $total_benar * 1;
                break;
            case "sedang":
                $score = $total_benar * 2;
                break;
            case "sulit":
                $score = $total_benar * 3;
                break;
            default:
              //code block
        }
        return $score;
    }

    public function filterCol(Request $request)
    {
        $params_origin = '';
        $data = [
            [
                'label' => 'Tahun Ajaran',
                'name' => 'tahun_ajaran',
                'param' => 'tahun_ajaran',
                'data' => KelasSiswa::distinct()->orderBy('tahun_ajaran')->get(['tahun_ajaran AS val', 'tahun_ajaran AS name'])->unique('name')
            ],
            [
                'label' => 'Jenjang',
                'name' => 'jenjangs',
                'param' => 'jenjang_id',
                'data' => Jenjang::where('show_for_guest', 1)->get(['id AS val', 'name'])
            ],
            [
                'label' => 'Tingkat',
                'name' => 'tingkats',
                'param' => 'tingkat_id',
                'data' => Tingkat::get(['id AS val', 'name'])
            ],
            [
                'label' => 'Kelas',
                'name' => 'kelas',
                'param' => 'kelas_id',
                'data' => Kelas::distinct()->orderBy('name')->get(['name AS val', 'name'])->unique('name')
            ],
        ];
    
        return response()->json(['message' => 'success', 'data' => $data, 'params_origin' => $params_origin]);
    }

    public function filterColShowDetailMapel($id, $mapelId)
    {
        $user = ExternalUser::find($id);

        $mapelQuery = MataPelajaran::query();
        $mapelList = $mapelQuery->where(['tingkat_id' => $user->kelas->tingkat->id])->orderBy('urutan', 'asc')->get(['id AS val', 'name']);

        $bab_ids = PaketSoal::where(['mata_pelajaran_id' => $mapelId, 'deleted_at' => null])->distinct()->pluck('bab_id')->toArray();
        $babs = Modul::whereIn('id', $bab_ids)->get();

        $babList = [];
        foreach($babs as $bab){
            array_push($babList, [
                'val' => $bab->id,
                'name' => $bab->name,
            ]);
        }
        
        $subbabs = PaketSoal::whereIn('bab_id', $bab_ids)->where(['deleted_at' => null])->groupBy('bab_id', 'subbab')->distinct()->get();
        $subbabList = [];
        foreach($subbabs as $subbab){
            array_push($subbabList, [
                'val' => $subbab->id,
                'name' => $subbab->judul_subbab,
            ]);
        }

        $data = [
            [
                'label' => 'Mata Pelajaran',
                'name' => 'mapel',
                'param' => 'mapel',
                'data' => $mapelList
            ],
            [
                'label' => 'Bab',
                'name' => 'bab',
                'param' => 'bab',
                'data' => $babList
            ],
            [
                'label' => 'Subbab',
                'name' => 'subbab',
                'param' => 'subbab',
                'data' => $subbabList
            ]
        ];
    
        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function showGrafik(Request $request)
    {
        $data = [];
        // dd(Auth::user()->roles->pluck('name'));

        return view('pages.backoffice.e-raport.show_grafik', $data);
    }
}
