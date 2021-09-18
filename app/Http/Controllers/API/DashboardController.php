<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Kelas;
use App\Models\ExternalUser;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\HistoryModul;
use App\Models\Simulasi;
use App\Models\HistorySimulasi;
use App\Models\Video;
use App\Models\HistoryVideo;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MataPelajaran as MataPelajaranResource;
use App\Http\Resources\GuruMataPelajaran as GuruMataPelajaranResource;
use App\Http\Resources\Summary as SummaryResource;
use App\Http\Resources\Dashboard as DashboardResource;
use Validator;
   
class DashboardController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mata_pelajaran_id' => 'required|numeric',
            'kelas_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());     
        }

        $data = MataPelajaran::whereHas('gurus', function($query){
            $query->where('guru_id', @Auth::user()->id);
        });
        $data = $data->with(['tingkat.kelas' => function($queryKelas) use ($request){
            $queryKelas->where('id', $request->kelas_id);
        }])->find($request->mata_pelajaran_id);

        if (is_null($data)) {
            return $this->returnStatus(400, 'MataPelajaran not found.');
        }

        $dashboard['mata_pelajaran'] = [
            'id' => @$data->id,
            'name' => @$data->name,
        ];
        $dashboard['mapel_jenjang'] = [
            'id' => @$data->tingkat->jenjang->id,
            'name' => @$data->tingkat->jenjang->name,
        ];
        $dashboard['mapel_tingkat'] = [
            'id' => @$data->tingkat->id,
            'name' => @$data->tingkat->name,
        ];
        $kelas = (@$data->tingkat->kelas ?? []);
        $kelas = count($kelas)> 0 ? $kelas[0] : null;
        $dashboard['mapel_kelas'] = [
            'id' => @$kelas->id,
            'name' => @$kelas->name,
        ];

        $dashboard['summary'] = $this->summary($request->mata_pelajaran_id, $request->kelas_id);

        return $this->sendResponse(new DashboardResource($dashboard), 'Dashboard retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guruNgajar(Request $request)
    {
        // init var
        $datas = [];

        // get mapels object
        $mapels = MataPelajaran::search($request)->with('tingkat.kelas');
        // filter by guru
        $mapels = $mapels->whereHas('gurus', function($query){
            $query->where('guru_id', @Auth::user()->id);
        });
        $mapels = $mapels->get();

        foreach($mapels as $mapel){
            $tingkat = @$mapel->tingkat;
            $kelasList = @$tingkat->kelas;
            // loop kelas
            foreach($kelasList as $kelas){
                $datas[] = [
                    'mata_pelajaran' => [
                        'id' => @$mapel->id,
                        'name' => @$mapel->name,
                    ],
                    'tingkat' => [
                        'id' => @$tingkat->id,
                        'name' => @$tingkat->name,
                    ],
                    'kelas' => [
                        'id' => @$kelas->id,
                        'name' => @$kelas->name,
                    ],
                ];
            }
        }

        $datas = collect($datas)->sortBy('mata_pelajaran')->sortBy('tingkat')->sortBy('kelas');

        return $this->sendResponse(GuruMataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display summary the specified resource.
     *
     * @param  int  $mapelId
     * @param  int  $kelasId
     * @return \Illuminate\Http\Response
     */
    public function summary($mapelId, $kelasId)
    {
        // pluck ids siswa by kelas
        $idsSiswa = ExternalUser::where(['role' => 'SISWA', 'kelas_id'=> $kelasId])->get()->pluck('id');
        $totalSiswa = count($idsSiswa);

        // counting modul by mapel
        $moduls = Modul::where('mata_pelajaran_id', $mapelId)->get();
        $totalModul = count($moduls);
        // modul done by siswa
        $modulHistory = HistoryModul::whereIn('siswa_id', $idsSiswa);
        // modul history by mapel
        $modulHistory = $modulHistory->whereHas('modul', function($query) use ($mapelId) {
            $query->where('mata_pelajaran_id', $mapelId);
        });
        $modulHistory = $modulHistory->get();
        $doneModul = count($modulHistory);

        // counting video by mapel
        $videos = Video::where('mata_pelajaran_id', $mapelId)->get();
        $totalVideo = count($videos);
        // video watched by siswa
        $videoHistory = HistoryVideo::whereIn('siswa_id', $idsSiswa);
        // video history by mapel
        $videoHistory = $videoHistory->whereHas('video', function($query) use ($mapelId) {
            $query->where('mata_pelajaran_id', $mapelId);
        });
        $videoHistory = $videoHistory->get();
        $doneVideo = count($videoHistory);

        // counting simulasi by mapel
        $simulasis = Simulasi::where('mata_pelajaran_id', $mapelId)->get();
        $totalSimulasi = count($simulasis);
        // simulasi done by siswa
        $simulasiHistory = HistorySimulasi::whereIn('siswa_id', $idsSiswa);
        // simulasi history by mapel
        $simulasiHistory = $simulasiHistory->whereHas('simulasi', function($query) use ($mapelId) {
            $query->where('mata_pelajaran_id', $mapelId);
        });
        $simulasiHistory = $simulasiHistory->get();
        $doneSimulasi = count($simulasiHistory);

        $data = [
            'total_siswa' => $totalSiswa,
            'modul' => [
                'total' => $totalModul,
                'average' => 0,
                'max' => 0,
                'min' => 0,
                'average' => 0,
                'done' => $doneModul,
            ],
            'video' => [
                'total' => $totalVideo,
                'average' => 0,
                'max' => 0,
                'min' => 0,
                'average' => 0,
                'done' => $doneVideo,
            ],
            'simulasi' => [
                'total' => $totalSimulasi,
                'average' => 0,
                'max' => 0,
                'min' => 0,
                'average' => 0,
                'done' => $doneSimulasi,
            ],
        ];
   
        return $data;
    }

}