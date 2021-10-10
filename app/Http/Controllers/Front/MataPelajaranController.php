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
        $user = @Auth::user();

        // sedang di pelajari
        $sedangDipelajari = MataPelajaran::search($request);
        $sedangDipelajari = $sedangDipelajari->with('tingkat');
        $sedangDipelajari = $sedangDipelajari->whereHas('tingkat.kelas', function($query) {
            $query->where('id', Auth::user()->kelas_id);
        });
        // sort by active mapel
        $sedangDipelajari = $sedangDipelajari->get();

        // mapel yang akan datang
        $yangAkanDatang = $this->mapelByTingkat($request, '>');

        // mapel sebelumnya
        $sebelumnya = $this->mapelByTingkat($request, '<');

        /**
         * Mapel Aktif buat Pengunjung
         */
        $aktif = [];

        /**
         * Mapel Tidak Aktif buat Pengunjung
         */
        $tidakAktif = [];

        $parseData = [
            'sedangDipelajari' => $sedangDipelajari,
            'yangAkanDatang' => $yangAkanDatang,
            'sebelumnya' => $sebelumnya,

            'aktif' => $aktif,
            'tidakAktif' => $tidakAktif,
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
        $yangAkanDatang = $this->mapelByTingkat($request, '>');

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
    public function indexPassed(Request $request)
    {
        $sebelumnya = $this->mapelByTingkat($request, '<');

        $parseData = [
            'sebelumnya' => $sebelumnya,
        ];

        return view('pages/frontoffice/mapel/list_passed', $parseData);
    }

    private function mapelByTingkat($request, $condition='>'){
        $user = @Auth::user();

        // upcoming mapel
        $mapels = MataPelajaran::search($request);
        $mapels = $mapels->with('tingkat');
        // filter by jenjang yg sama
        $mapels = $mapels->whereHas('tingkat.jenjang', function($query) use ($user) {
            // disable, terus ganti ama yg bawah buat kelas 6 sd bsa liat mapel smp sma kalo $condition nya >
            $query->where('id', $user->kelas->tingkat->jenjang_id ?? 0);
            // $isTk = @$user->kelas->jenjang->name ?? false;
            // if($isTk) $query->where('name', '!=','TK');
        });
        // filter by tingkat condition
        $mapels = $mapels->whereHas('tingkat', function($query) use ($condition) {
            $query->where('name', $condition, @Auth::user()->kelas->tingkat->name ?? '-');
        });
        // get
        $mapels = $mapels->get();

        // sorting by tingkat
        $mapels = $mapels->sortBy('tingkat.name');

        return $mapels;
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
        // filter by jenjang yg sama
        $mapel = $mapel->whereHas('tingkat.jenjang', function($query) {
            $query->where('id', Auth::user()->kelas->tingkat->jenjang_id);
        });
        // $mapel = $mapel->whereHas('tingkat.kelas', function($query) {
        //     $query->where('id', Auth::user()->kelas_id);
        // });
        // filter by tingkat bawahnya
        $mapel = $mapel->whereHas('tingkat', function($query) {
            $query->where('name', '<=', Auth::user()->kelas->tingkat->name);
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