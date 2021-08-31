<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\MataPelajaran;
use App\Models\Video;
use App\Models\HistoryVideo;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MataPelajaran as MataPelajaranResource;
use App\Http\Resources\Summary as SummaryResource;
   
class MataPelajaranController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = MataPelajaran::search($request);
        $datas = $datas->with('kelas.tingkat');
        // sort by active mapel
        $datas = $datas->get()->sortBy('disabled')->sortBy('kelas.tingkat_id')->sortBy('kelas_id');

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inprogress(Request $request)
    {
        $datas = MataPelajaran::search($request);
        $datas = $datas->with('kelas.tingkat');
        $datas = $datas->where('kelas_id', Auth::user()->kelas_id);
        // sort by active mapel
        $datas = $datas->get()->sortBy('name');

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upcoming(Request $request)
    {
        $datas = MataPelajaran::search($request);
        $datas = $datas->with('kelas.tingkat');
        $datas = $datas->where('kelas_id', '!=', Auth::user()->kelas_id);
        // sort by active mapel
        $datas = $datas->get()->sortBy('kelas.tingkat_id')->sortBy('kelas_id')->sortBy('name');

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MataPelajaran::with('kelas.tingkat')->find($id);
  
        if (is_null($data)) {
            return $this->sendError('MataPelajaran not found.');
        }
   
        return $this->sendResponse(new MataPelajaranResource($data), 'MataPelajaran retrieved successfully.');
    }

    /**
     * Display summary the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function summary($id)
    {
        $mapel = MataPelajaran::with('kelas.tingkat')->find($id);
  
        if (is_null($mapel)) {
            return $this->sendError('MataPelajaran not found.');
        }

        // init var
        $totalModul = 0;
        $doneModul = 0;
        $totalSimulasi = 0;
        $doneSimulasi = 0;

        // counting video by mapel
        $videos = Video::where('mata_pelajaran_id', $id)->get();
        $totalVideo = count($videos);
        // video watched by siswa
        $videoHistory = HistoryVideo::where('siswa_id', Auth::user()->id);
        // video history by mapel
        $videoHistory = $videoHistory->whereHas('video', function($query) use ($id) {
            $query->where('mata_pelajaran_id', $id);
        });
        $videoHistory = $videoHistory->get();
        $doneVideo = count($videoHistory);

        $data = [
            'progress_modul' => [
                'percentage' => $this->calculatePercentage($totalModul, $doneModul),
                'total' => $totalModul,
                'done' => $doneModul,
            ],
            'progress_video' => [
                'percentage' => $this->calculatePercentage($totalVideo, $doneVideo),
                'total' => $totalVideo,
                'done' => $doneVideo,
            ],
            'progress_simulasi' => [
                'percentage' => $this->calculatePercentage($totalSimulasi, $doneSimulasi),
                'total' => $totalSimulasi,
                'done' => $doneSimulasi,
            ],
        ];
   
        return $this->sendResponse(new SummaryResource($data), 'Summary retrieved successfully.');
    }

    private function calculatePercentage($total, $done){
        return ($done === 0 || $total === 0) ? 0 : ($done/$total) * 100;
    }
}