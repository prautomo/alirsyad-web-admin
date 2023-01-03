<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Score;
use App\Models\MataPelajaran;
use App\Models\Simulasi;
use App\Models\HistorySimulasi;
use App\Models\Modul;
use App\Models\Tingkat;
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
        foreach ($mapels as $mapel) {
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

        $tingkatId = @$user->kelas->tingkat_id;

        // pengunjung
        if ($user->is_pengunjung) {
            $tingkats = Tingkat::where('jenjang_id', @$user->jenjang_id)->get();

            foreach ($tingkats as $tingkat) {
                // load mapel active kelas/tingkat
                $mapels = MataPelajaran::where('tingkat_id', $tingkat->id)->get();
                $datas[] = [
                    'jenjang' => @$tingkat->jenjang->name ?? "-",
                    'tingkat' => @$tingkat->name ?? "-",
                    'mata_pelajarans' => @$mapels,
                ];
            }
        } else {
            // load mapel active kelas/tingkat
            $mapels = MataPelajaran::where('tingkat_id', $tingkatId)->get();
            $datas[] = [
                'jenjang' => @$user->kelas->tingkat->jenjang->name ?? "-",
                'tingkat' => @$user->kelas->tingkat->name ?? "-",
                'kelas' => @$user->kelas->name  ?? "-",
                'mata_pelajarans' => @$mapels,
            ];
            // load history kelas/tingkat
        }

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

    private function getProgress($id)
    {
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
        $simulasiHistory = $simulasiHistory->whereHas('simulasi', function ($query) use ($id) {
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
        // // handle hak akses mapel
        // if($user->role !== "GURU"){
        //     $simulasis = $simulasis->whereHas('mataPelajaran', function($query) use($user) {
        //         $query->where('tingkat_id', @$user->kelas->tingkat_id);
        //     });
        // }

        $simulasis = $simulasis->where('mata_pelajaran_id', $id);

        // sorting by urutan
        $simulasis = $simulasis->orderBy('urutan', 'asc')->orderBy('level', 'asc');
        $simulasis = $simulasis->get();

        $datas['simulasis'] = $simulasis;

        foreach ($simulasis as $key => $simulasi) {
            $history_simulasi = HistorySimulasi::where(['siswa_id' => Auth::user()->id, 'simulasi_id' => $simulasi->id])->first();
            if ($history_simulasi == null) {
                $datas['simulasis'][$key]['last_played'] = null;
            } else {
                $datas['simulasis'][$key]['last_played'] = $history_simulasi->updated_at;
            }

            $temp_rata_rata_score = (int) $simulasi->rata_rata_score;
            if ($temp_rata_rata_score == 0) {
                $datas['simulasis'][$key]['rata_rata_score'] = "0";
            }
        }
        return $datas;
    }

    private function calculatePercentage($total, $done)
    {
        return ($done === 0 || $total === 0) ? 0 : round(($done / $total) * 100, 2);
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
            'q_siswa_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());
        }

        $idSiswa = $request->siswa_id;

        $simulasi = Simulasi::find($id);

        $scores = @$simulasi->scores ?? [];

        // data semua percobaan
        $percobaans = [];
        foreach ($scores as $score) {
            $percobaans[] = [
                'percobaan_ke' => @$score->percobaan_ke,
                'status' => (@$score->score ?? 0) < 50 ? 'salah' : 'benar',
            ];
        }

        $percobaans = collect($percobaans)->sortBy('percobaan_ke');
        // $jumlahPercobaan = count($scores->toArray());

        $percobaansBenar = $percobaans->where('status', 'benar')->all();
        $percobaansSalah = $percobaans->where('status', 'salah')->all();

        // 10 percobaan terakhir
        $dataPercobaanTerakhir = $scores->take(-10);

        $datas = [
            'jumlah_percobaan' => @$simulasi->total_percobaan ?? 0,
            'jumlah_benar' => count(@$percobaansBenar ?? []),
            'jumlah_salah' => count(@$percobaansSalah ?? []),
            'percobaan_terakhir' => [
                'jumlah_benar' => @$simulasi->{"10_percobaan_terakhir_berhasil"} ?? 0,
                'jumlah_salah' => @$simulasi->{"10_percobaan_terakhir_gagal"} ?? 0,
                'data_percobaan' => @$dataPercobaanTerakhir ?? [],
            ],
            'data_percobaan' => @$simulasi->scores ?? [],
            'nilai_akhir' => round(@$simulasi->rata_rata_score ?? 0, 2),
        ];

        return $this->sendResponse(new ScoreResource($datas), 'Score retrieved successfully.');
    }
}
