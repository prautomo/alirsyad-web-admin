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
   
class ScoreController extends BaseController
{

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
        
        $simulasis = $simulasis->where('mata_pelajaran_id', $id)->get();
        $datas['simulasis'] = $simulasis;
   
        return $this->sendResponse(new ScoreResource($datas), 'Score retrieved successfully.');
    }

    private function calculatePercentage($total, $done){
        return ($done === 0 || $total === 0) ? 0 : ($done/$total) * 100;
    }
}