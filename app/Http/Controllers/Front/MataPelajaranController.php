<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\HistoryModul;
use App\Models\Video;
use App\Models\HistoryVideo;
use App\Models\Simulasi;
use App\Models\HistorySimulasi;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class MataPelajaranController extends Controller
{
    /**
     * Show the mapel list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // sedang di pelajari
        $sedangDipelajari = MataPelajaran::search($request);
        $sedangDipelajari = $sedangDipelajari->with('tingkat');
        $sedangDipelajari = $sedangDipelajari->whereHas('tingkat.kelas', function($query) {
            $query->where('id', Auth::user()->kelas_id);
        });
        // sort by active mapel
        $sedangDipelajari = $sedangDipelajari->get();

        $parseData = [
            'sedangDipelajari' => $sedangDipelajari,
        ];

        return view('pages/frontoffice/mapel/list', $parseData);
    }

    /**
     * Show the mapel list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexUpcoming(Request $request)
    {
        // upcoming mapel
        $yangAkanDatang = MataPelajaran::search($request);
        $yangAkanDatang = $yangAkanDatang->with('tingkat');
        // filter by jenjang yg sama
        $yangAkanDatang = $yangAkanDatang->whereHas('tingkat.jenjang', function($query) {
            $query->where('id', Auth::user()->kelas->tingkat->jenjang_id);
        });
        // filter by tingkat atasnya
        $yangAkanDatang = $yangAkanDatang->whereHas('tingkat', function($query) {
            $query->where('name', '>', Auth::user()->kelas->tingkat->name);
        });
        // get
        $yangAkanDatang = $yangAkanDatang->get();

        // sorting by tingkat
        $yangAkanDatang = $yangAkanDatang->sortBy('tingkat.name');

        $parseData = [
            'yangAkanDatang' => $yangAkanDatang,
        ];

        return view('pages/frontoffice/mapel/list_upcoming', $parseData);
    }

    /**
     * Show the mapel list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, $id)
    {
        // mapel
        $mapel = MataPelajaran::with('tingkat');
        $mapel = $mapel->whereHas('tingkat.kelas', function($query) {
            $query->where('id', Auth::user()->kelas_id);
        });
        $mapel = $mapel->findOrFail($id);

        // percentage
        // counting modul by mapel
        $moduls = Modul::where('mata_pelajaran_id', $id)->get();
        $totalModul = count($moduls);
        // modul done by siswa
        $modulHistory = HistoryModul::where('siswa_id', Auth::user()->id);
        // modul history by mapel
        $modulHistory = $modulHistory->whereHas('modul', function($query) use ($id) {
            $query->where('mata_pelajaran_id', $id);
        });
        $modulHistory = $modulHistory->get();
        $doneModul = count($modulHistory);

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

        $parseData = [
            'mapel' => $mapel,
            'mapelId' => $id,
            'progress' => [
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
            ],
        ];

        // dd($parseData);

        return view('pages/frontoffice/mapel/detail', $parseData);
    }

    private function calculatePercentage($total, $done){
        return ($done === 0 || $total === 0) ? 0 : ($done/$total) * 100;
    }
}