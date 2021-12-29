<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Tingkat;
use App\Models\MataPelajaran;
use App\Models\GuestMataPelajaran;
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
        // sort by created at descending
        $sedangDipelajari = $sedangDipelajari->sortByDesc('created_at');

        // mapel yang akan datang
        $yangAkanDatang = $this->mapelByTingkat($request, '>');

        // yg akan datang kalo tingkat akhir & bukan pengunjung
        if(!@$user->is_pengunjung){
            // 1. get tingkat akhir
            $getTingkatAkhir = Tingkat::where('jenjang_id', @Auth::user()->kelas->tingkat->jenjang_id)->orderBy('name', 'desc')->first();
            // 2. cek tingkat akhir
            if($getTingkatAkhir->name===@Auth::user()->kelas->tingkat->name){
                $yangAkanDatangNextJenjang = MataPelajaran::search($request);
                $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->with('tingkat');
                $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->whereHas('tingkat', function($query) {
                    $tingkatnya = @Auth::user()->kelas->tingkat->name;
                    // kalo tk b, assign aja akhirnya jadi tingkat 1
                    $tingkatnya = $tingkatnya==="B" ? 1 : ((int) $tingkatnya)+1;

                    $query->where('name', '=', $tingkatnya ?? '-');
                });
                $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->get();
                $yangAkanDatang = $yangAkanDatang->merge($yangAkanDatangNextJenjang)->all();
            }
        }
        // sort by created at descending
        $yangAkanDatang = collect($yangAkanDatang)->sortByDesc('created_at');
        //end

        // mapel sebelumnya
        $sebelumnya = $this->mapelByTingkat($request, '<');
        $sebelumnya = $sebelumnya->sortBy('tingkat');
        // sort by created at descending
        // $sebelumnya = $sebelumnya->sortByDesc('created_at');

        /**
         * Mapel Aktif buat Pengunjung
         */
        $aktif = MataPelajaran::search($request);
        $aktif = $aktif->with('tingkat');
        // mapel pilihan admin
        $aktif = $aktif->whereHas('guests', function($query) use ($user) {
            $query->where('guest_id', $user->id);
        });
        $aktif = $aktif->get();
        // // sort by active mapel
        // $aktif = $aktif->sortBy('name');
        // sort by created at descending
        $aktif = $aktif->sortByDesc('created_at');
        // kalo user belum aktif (kosongin aja list mapelna)
        if($user->status!=="AKTIF") $aktif = [];

        // /**
        //  * Mapel Tidak Aktif buat Pengunjung
        //  */
        // $tidakAktif = MataPelajaran::search($request);
        // $tidakAktif = $tidakAktif->with('tingkat');
        // // by tingkat
        // $tidakAktif = $tidakAktif->whereHas('tingkat', function($q2) use ($user){
        //     $q2->where('jenjang_id', $user->jenjang_id);
        // });
        // // mapel bukan pilihan admin
        // if($user->status==="AKTIF"){
        //     $selectedMapel = GuestMataPelajaran::where('guest_id', $user->id)->get()->pluck('mata_pelajaran_id');
        //     $tidakAktif = $tidakAktif->whereNotIn('id', $selectedMapel);
        // }
        // // sort by active mapel
        // $tidakAktif = $tidakAktif->get()->sortBy('tingkat');
        // // sort by created at descending
        // $tidakAktif = $tidakAktif->sortByDesc('created_at');

        $parseData = [
            'sedangDipelajari' => $sedangDipelajari,
            'yangAkanDatang' => $yangAkanDatang,
            'sebelumnya' => $sebelumnya,

            'aktif' => $aktif,
            'tidakAktif' => @$tidakAktif ?? [],
        ];

        return view('pages/frontoffice/mapel/list', $parseData);
    }

    /**
     * Show the mapel list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexByTingkat(Request $request, $tingkatId)
    {
        $userInfo = Auth::user();
        $tingkatInfo = Tingkat::findOrFail($tingkatId);
        $mapels = [];

        if(@$userInfo->is_pengunjung){
            $jenjangUser = @$userInfo->jenjang_id;
        }else{
            $jenjangUser = @$userInfo->kelas->tingkat->jenjang_id;
        }

        // cek jenjang user sama jenjang tingkatna harus sama
        if($tingkatInfo->jenjang_id === $jenjangUser){
            $mapels = MataPelajaran::where('tingkat_id', $tingkatId);
            $mapels = $mapels->with('tingkat');
            $mapels = $mapels->orderBy('name');
            $mapels = $mapels->get();
        }else{
            // jangan kasih info tingkat
            abort(404);
        }

        $parseData = [
            'mapels' => $mapels,
            'tingkatInfo' => $tingkatInfo,
        ];

        return view('pages/frontoffice/mapel/list_by_tingkat', $parseData);
    }

    /**
     * Show the mapel list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexUpcoming(Request $request)
    {
        $yangAkanDatang = $this->mapelByTingkat($request, '>');

        // yg akan datang kalo tingkat akhir
        // 1. get tingkat akhir
        $getTingkatAkhir = Tingkat::where('jenjang_id', @Auth::user()->kelas->tingkat->jenjang_id)->orderBy('name', 'desc')->first();
        // 2. cek tingkat akhir
        if($getTingkatAkhir->name===@Auth::user()->kelas->tingkat->name){
            $yangAkanDatangNextJenjang = MataPelajaran::search($request);
            $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->with('tingkat');
            $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->whereHas('tingkat', function($query) {
                $tingkatnya = @Auth::user()->kelas->tingkat->name;
                // kalo tk b, assign aja akhirnya jadi tingkat 1
                $tingkatnya = $tingkatnya==="B" ? 1 : ((int) $tingkatnya)+1;

                $query->where('name', '=', $tingkatnya ?? '-');
            });
            $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->get();
            $yangAkanDatang = $yangAkanDatang->merge($yangAkanDatangNextJenjang)->all();
        }
        //end

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
            $query->where('id', @$user->kelas->tingkat->jenjang_id ?? 0);
            // $isTk = @$user->kelas->jenjang->name ?? false;
            // if($isTk) $query->where('name', '!=','TK');
            // cek tingkat terakhir di jenjang
            // 1. order by desc tngkat by jenjang
            // 2. bandingin sama tingkat user sekarang
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
        $user = Auth::user();
        // mapel
        $mapel = MataPelajaran::with('tingkat');
        // filter by jenjang yg sama
        $mapel = $mapel->whereHas('tingkat.jenjang', function($query) use ($user) {
            $jenjangId = $user->is_pengunjung ? $user->jenjang_id : $user->kelas->tingkat->jenjang_id;
            $query->where('id', $jenjangId);
        });
        // $mapel = $mapel->whereHas('tingkat.kelas', function($query) {
        //     $query->where('id', Auth::user()->kelas_id);
        // });
        // filter by tingkat bawahnya
        if (!$user->is_pengunjung) $mapel = $mapel->whereHas('tingkat', function($query) {
            $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        });
        // kalo pengunjung, filter by mapel aktif nya
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
