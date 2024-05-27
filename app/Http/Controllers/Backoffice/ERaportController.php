<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ERaport;
use App\Models\ExternalUser;
use App\Models\KelasSiswa;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\PaketSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $query = ERaport::query();

        // filter if its guru uploader
        if (!@\Auth::user()->hasRole('Superadmin')) {
            // $mapelIdsUser = $this->getMapelIdsUser();
            // $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
        }

        $datas = $query->groupBy('user_id')->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

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
                return @$data->external_user->nis;
            })
            ->addColumn('name', function($data) {
                return @$data->external_user->name;
            })
            ->addColumn('jenjang', function($data) {
                return @$data->external_user->kelas->tingkat->jenjang->name;
            })
            ->addColumn('tingkat', function($data) {
                return @$data->external_user->kelas->tingkat->name;
            })
            ->addColumn('kelas', function($data) {
                return @$data->external_user->kelas->name;
            })
            ->addColumn("tahun_ajaran", function ($data) {
                $current_class = KelasSiswa::where(['siswa_id' => $data->external_user->id, 'is_current' => 1])->first();

                if($current_class != null){
                    return $current_class->tahun_ajaran;
                }

                return "";
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "viewRoute" => route($this->routePath.".show", $data->external_user->id),
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

        // filter if its guru uploader
        if (!@\Auth::user()->hasRole('Superadmin')) {
            // $mapelIdsUser = $this->getMapelIdsUser();
            // $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
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
        // $paketSoal = PaketSoal::with('mataPelajaran', 'bab')->findOrFail($id);

        $data = [
            // 'paket_soal' => $paketSoal,
            // 'id' => $id,
        ];

        return view($this->prefix.'.show', $data);
    }

    public function getMapel($tingkat_id){
        $query = MataPelajaran::query();
        $data = $query->where(['tingkat_id' => $tingkat_id])->orderBy('urutan', 'asc')->get();

        return $data;
    }

    public function showDetailMapel($id, $mapelId)
    {
        $user = ExternalUser::find($id);
        $mapel = MataPelajaran::find($mapelId);
        $bab_ids = PaketSoal::where(['mata_pelajaran_id' => $mapelId, 'deleted_at' => null])->distinct()->pluck('bab_id')->toArray();
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
            // $subbabs = PaketSoal::where(['bab_id' => $bab_id, 'deleted_at' => null])->get();
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
        return view($this->prefix.'.show_mapel', ['data' => $result, 'mapelList' => $mapelList, 'selectedMapel' => $mapelId]);
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
}
