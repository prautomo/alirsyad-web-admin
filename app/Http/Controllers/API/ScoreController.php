<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Score;
use App\Models\MataPelajaran;
use App\Models\Simulasi;
use App\Models\HistorySimulasi;
use App\Models\Modul;
use App\Models\HistoryModul;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Score as ScoreResource;
use Validator;
   
class ScoreController extends BaseController
{

    /**
     * Display a mata pelajaran listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $datas = [];

        // load mapel active kelas/tingkat
        $mapels = MataPelajaran::where('tingkat_id', @$user->kelas->tingkat_id)->get();
        $mapelsWithDetail = [];
        foreach($mapels as $mapel){
            $mapel['detail'] = $this->getProgress($mapel->id);
            $mapelsWithDetail[] = $mapel;
        }
        $datas[] = [
            'jenjang' => @$user->kelas->tingkat->jenjang->name ?? "-",
            'tingkat' => @$user->kelas->tingkat->name ?? "-",
            'kelas' => @$user->kelas->name  ?? "-",
            'mata_pelajarans' => @$mapelsWithDetail,
        ];

        return $this->sendResponse(ScoreResource::collection($datas), 'Scores retrieved.');
    }

    /**
     * Display a mata pelajaran listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mapels(Request $request)
    {
        $user = Auth::user();
        $datas = [];

        // load mapel active kelas/tingkat
        $mapels = MataPelajaran::where('tingkat_id', @$user->kelas->tingkat_id)->get();
        $datas[] = [
            'jenjang' => @$user->kelas->tingkat->jenjang->name ?? "-",
            'tingkat' => @$user->kelas->tingkat->name ?? "-",
            'kelas' => @$user->kelas->name  ?? "-",
            'mata_pelajarans' => @$mapels,
        ];

        // load history kelas/tingkat

        return $this->sendResponse(ScoreResource::collection($datas), 'Mata Pelajaran retrieved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id // ud mapel
     * @return \Illuminate\Http\Response
     */
    public function progress($id)
    {
        $datas = $this->getProgress($id);
   
        return $this->sendResponse(new ScoreResource($datas), 'Score retrieved successfully.');
    }

    private function getProgress($id){
        $user = Auth::user();
        $datas = [];

        // check mapel detail
        $mapel =  MataPelajaran::with('tingkat.jenjang')->find($id);
        if (is_null($mapel)) {
            return $this->sendError('Mata Pelajaran not found.');
        }

        $datas['mata_pelajaran'] = $mapel->name;

        // counting simulasi by mapel
        $simulasis = Simulasi::where('mata_pelajaran_id', $id)->get();
        $totalSimulasi = count($simulasis);
        // simulasi done by siswa
        $simulasiHistory = HistorySimulasi::where('siswa_id', Auth::user()->id);
        // simulasi history by mapel
        $simulasiHistory = $simulasiHistory->whereHas('simulasi', function($query) use ($id) {
            $query->where('mata_pelajaran_id', $id);
        });
        $simulasiHistory = $simulasiHistory->get();
        $doneSimulasi = count($simulasiHistory);

        // progress
        $datas['progress'] = [
            'percentage' => $this->calculatePercentage($totalSimulasi, $doneSimulasi),
            'total' => $totalSimulasi,
            'done' => $doneSimulasi,
        ];

        // list simulasi
        $simulasis = Simulasi::with('mataPelajaran');
        // handle hak akses mapel
        if($user->role !== "GURU"){
            $simulasis = $simulasis->whereHas('mataPelajaran', function($query) use($user) {
                $query->where('tingkat_id', @$user->kelas->tingkat_id);
            });
        }
        
        $simulasis = $simulasis->where('mata_pelajaran_id', $id);
        
        // sorting by urutan
        $simulasis = $simulasis->orderBy('urutan', 'asc')->orderBy('level', 'asc');
        $simulasis = $simulasis->get();
        
        $datas['simulasis'] = $simulasis;

        return $datas;
    }

    private function calculatePercentage($total, $done){
        return ($done === 0 || $total === 0) ? 0 : round(($done/$total) * 100, 2);
    }

    // GURU
    /**
     * Display a mata pelajaran listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listNilaiSiswa(Request $request, $id)
    {
        $datas = [];
        
        return $this->sendResponse(ScoreResource::collection($datas), 'Siswas retrieved.');
    }
    
    /**
     * Display a mata pelajaran listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nilaiSiswa(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());     
        }

        $idSiswa = $request->siswa_id;
        $idSimulasi = $id;

        $scores = Score::where(['siswa_id'=> $idSiswa, 'simulasi_id' => $idSimulasi])->get();

        // data semua percobaan
        $percobaans = [];
        foreach($scores as $score){
            $percobaans[] = [
                'percobaan_ke' => @$score->percobaan_ke,
                'status' => (@$score->score ?? 0) < 50 ? 'salah' : 'benar',
            ];
        }

        $percobaans = collect($percobaans)->sortBy('percobaan_ke');
        $jumlahPercobaan = count($scores->toArray());
        $percobaansBenar = $percobaans->where('status', 'benar')->all();
        $percobaansSalah = $percobaans->where('status', 'salah')->all();
        
        // 10 percobaan terakhir
        $percobaanTerakhirs = $percobaans->take(-10);
        $percobaanTerakhirsBenar = $percobaanTerakhirs->where('status', 'benar')->all();
        $percobaanTerakhirsSalah = $percobaanTerakhirs->where('status', 'salah')->all();
        
        $jumlahPercobaanTerakhirBenar = count(@$percobaanTerakhirsBenar ?? []);
        $jumlahPercobaanTerakhirSalah = count(@$percobaanTerakhirsSalah ?? []);

        // nilai akhir
        $nilaiAkhir = ($jumlahPercobaanTerakhirBenar === 0) ? 0 : $jumlahPercobaanTerakhirBenar/($jumlahPercobaan <= 10 ? $jumlahPercobaan : 10) * 100;

        $datas = [
            'jumlah_percobaan' => $jumlahPercobaan,
            'jumlah_benar' => count(@$percobaansBenar ?? []),
            'jumlah_salah' => count(@$percobaansSalah ?? []),
            'percobaan_terakhir' => [
                'jumlah_benar' => $jumlahPercobaanTerakhirBenar,
                'jumlah_salah' => count(@$percobaanTerakhirsSalah ?? []),
                'data_percobaan' => $percobaanTerakhirs,
            ],
            'data_percobaan' => $percobaans,
            'nilai_akhir' => round($nilaiAkhir, 2),
        ];

        return $this->sendResponse(new ScoreResource($datas), 'Score retrieved successfully.');
    }
}