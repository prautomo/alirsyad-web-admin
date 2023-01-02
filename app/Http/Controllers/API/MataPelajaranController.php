<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\GuruMataPelajaran;
use App\Models\GuestMataPelajaran;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\Tingkat;
use App\Models\HistoryModul;
use App\Models\Simulasi;
use App\Models\HistorySimulasi;
use App\Models\Video;
use App\Models\HistoryVideo;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MataPelajaran as MataPelajaranResource;
use App\Http\Resources\Summary as SummaryResource;
use Illuminate\Database\Eloquent\Collection;

class MataPelajaranController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $datas = MataPelajaran::search($request);
        // $datas = $datas->with('tingkat.jenjang');
        $datas = MataPelajaran::with('tingkat.jenjang');
        // limit data
        if (@$request->limit) $datas = $datas->limit($request->limit);

        if (@$request->q_kelas_id) {
            $datas = $datas->where('kelas_id', $request->q_kelas_id);
        }

        if (@$request->q_tingkat_id) {
            $datas = $datas->where('tingkat_id', $request->q_tingkat_id);
        }

        // sort by urutan
        $datas = $datas->orderBy('urutan', 'asc');

        // sort by active mapel
        $datas = $datas->get();
        // // sort by name
        // $datas = $datas->sortBy('name');
        // sort by created at descending
        // $datas = $datas->sortByDesc('created_at');
        // ->sortBy('disabled')->sortBy('kelas.tingkat_id')->sortBy('kelas_id');
        foreach ($datas as $mapel) {
            $get_simulation = Simulasi::with('uploader', 'mataPelajaran');
            $get_simulation = $get_simulation->where('mata_pelajaran_id', $mapel->id);
            $get_simulation = $get_simulation->get();

            if (count($get_simulation) == 0) {
                $mapel['is_has_simulation'] = 0;
            } else {
                $mapel['is_has_simulation'] = 1;
            }
        }

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inprogress(Request $request)
    {
        // $datas = MataPelajaran::search($request);
        // $datas = $datas->with('tingkat.jenjang');
        $datas = MataPelajaran::with('tingkat.jenjang');
        $datas = $datas->whereHas('tingkat.kelas', function ($query) {
            $query->where('id', @Auth::user()->kelas_id);
        });
        // limit data
        if (@$request->limit) $datas = $datas->limit($request->limit);
        // sort by urutan
        $datas = $datas->orderBy('urutan', 'asc');
        // sort by active mapel
        $datas = $datas->get();
        // // sort by name
        // $aktif = $aktif->sortBy('name');
        // sort by created at descending
        // $datas = $datas->sortByDesc('created_at');

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upcoming(Request $request)
    {
        $user = @Auth::user();

        // upcoming mapel
        $datas = MataPelajaran::search($request);
        $datas = $datas->with('tingkat.jenjang');
        // filter by jenjang yg sama
        $datas = $datas->whereHas('tingkat.jenjang', function ($query) use ($user) {
            $jenjangId = $user->is_pengunjung ? $user->jenjang_id : $user->kelas->tingkat->jenjang_id;
            $query->where('id', $jenjangId);
        });
        // filter by tingkat atasnya
        $datas = $datas->whereHas('tingkat', function ($query) use ($user) {
            if (!$user->is_pengunjung) $query->where('name', '>', @Auth::user()->kelas->tingkat->name);
        });
        // get
        $datas = $user->is_pengunjung ? [] : $datas->get();

        // yg akan datang kalo tingkat akhir & bukan pengunjung
        if (!@$user->is_pengunjung) {
            // 1. get tingkat akhir
            $getTingkatAkhir = Tingkat::where('jenjang_id', @Auth::user()->kelas->tingkat->jenjang_id)->orderBy('name', 'desc')->first();
            // 2. cek tingkat akhir
            if ($getTingkatAkhir->name === @Auth::user()->kelas->tingkat->name && !$user->is_pengunjung) {
                $yangAkanDatangNextJenjang = MataPelajaran::search($request);
                $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->with('tingkat');
                $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->whereHas('tingkat', function ($query) {
                    $tingkatnya = @Auth::user()->kelas->tingkat->name;
                    // kalo tk b, assign aja akhirnya jadi tingkat 1
                    $tingkatnya = $tingkatnya === "B" ? 1 : ((int) $tingkatnya) + 1;

                    $query->where('name', '=', $tingkatnya ?? '-');
                });
                $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->get();
                $datas = $datas->merge($yangAkanDatangNextJenjang)->all();
            }
        }
        // sort by created at descending
        $datas = collect($datas)->sortByDesc('created_at');
        //end

        // limit data
        if (@$request->limit) $datas = $datas->take($request->limit);

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function passed(Request $request)
    {
        $user = @Auth::user();

        // passed mapel
        $datas = MataPelajaran::search($request);
        $datas = $datas->with('tingkat.jenjang');
        // filter by jenjang yg sama
        $datas = $datas->whereHas('tingkat.jenjang', function ($query) use ($user) {
            $jenjangId = $user->is_pengunjung ? $user->jenjang_id : $user->kelas->tingkat->jenjang_id;
            $query->where('id', $jenjangId);
        });
        // filter by tingkat bawahnya
        $datas = $datas->whereHas('tingkat', function ($query) use ($user) {
            if (!$user->is_pengunjung) $query->where('name', '<', @Auth::user()->kelas->tingkat->name);
        });
        // limit data
        if (@$request->limit) $datas = $datas->limit($request->limit);
        // get
        $datas = $user->is_pengunjung ? collect([]) : $datas->get();
        // sort by tingkat
        $datas = $datas->sortBy('tingkat');

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        $user = @Auth::user();

        // // active mapel by admin
        // kalo user belum aktif (kosongin aja list mapelna)
        if ($user->status !== "AKTIF") {
            $get_mapel = MataPelajaran::with('tingkat');

            // mapel jenjang
            $get_mapel = $get_mapel->whereHas('tingkat', function ($query) use ($user) {
                $query->where('jenjang_id', @$user->jenjang_id);
            });

            if ($request->limit) $get_mapel = $get_mapel->limit($request->limit);

            // $get_mapel = $get_mapel->orderBy('urutan', 'asc');

            // $aktif = $aktif->get()->sortBy('tingkat.name');

            $get_mapel = $get_mapel->get()->groupBy('tingkat.name');

            $aktif = new Collection();
            foreach ($get_mapel as $key => $value) {
                $get_mapel[$key] = $value->sortBy('urutan');
                $aktif = $aktif->merge($value->sortBy('urutan'));
            }
        } else {
            // $aktif = MataPelajaran::search($request);
            // $aktif = $aktif->with('tingkat.jenjang');
            $aktif = MataPelajaran::with('tingkat.jenjang');
            // mapel pilihan admin
            $aktif = $aktif->whereHas('guests', function ($query) use ($user) {
                $query->where('guest_id', $user->id);
            });
            // limit data
            if (@$request->limit) $aktif = $aktif->limit($request->limit);
            // sort by urutan
            $aktif = $aktif->orderBy('urutan', 'asc');
            // sort by active mapel
            $aktif = $aktif->get();
            // // sort by active mapel
            // $aktif = $aktif->sortBy('name');
            // sort by created at descending
            // $aktif = $aktif->sortByDesc('created_at');
        }

        return $this->sendResponse(MataPelajaranResource::collection($aktif), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notActive(Request $request)
    {
        $user = @Auth::user();

        $tidakAktif = MataPelajaran::search($request);
        $tidakAktif = $tidakAktif->with('tingkat.jenjang');
        // by tingkat
        $tidakAktif = $tidakAktif->whereHas('tingkat', function ($q2) use ($user) {
            $q2->where('jenjang_id', $user->jenjang_id);
        });
        // mapel bukan pilihan admin
        if ($user->status === "AKTIF") {
            $selectedMapel = GuestMataPelajaran::where('guest_id', $user->id)->get()->pluck('mata_pelajaran_id');
            $tidakAktif = $tidakAktif->whereNotIn('id', $selectedMapel);
        }
        // limit data
        if (@$request->limit) $tidakAktif = $tidakAktif->limit($request->limit);
        // sort by active mapel
        $datas = $tidakAktif->get()->sortBy('tingkat');
        // sort by created at descending
        $datas = $datas->sortByDesc('created_at');

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
        $data = MataPelajaran::with('tingkat.jenjang')->find($id);

        $get_simulation = Simulasi::with('uploader', 'mataPelajaran');
        $get_simulation = $get_simulation->where('mata_pelajaran_id', $id);
        $get_simulation = $get_simulation->get();

        if (count($get_simulation) == 0) {
            $data['is_has_simulation'] = 0;
        } else {
            $data['is_has_simulation'] = 1;
        }

        if (is_null($data)) {
            return $this->sendError('MataPelajaran not found.');
        }

        return $this->sendResponse(new MataPelajaranResource($data), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByTingkat($tingkatId)
    {
        $userInfo = Auth::user();
        $tingkatInfo = Tingkat::findOrFail($tingkatId);
        $mapels = [];

        $jenjangUser = @$userInfo->kelas->tingkat->jenjang_id;

        // cek jenjang user sama jenjang tingkatna harus sama
        if (@$tingkatInfo->jenjang_id === $jenjangUser) {
            $mapels = MataPelajaran::where('tingkat_id', $tingkatId);
            $mapels = $mapels->with('tingkat');
            $mapels = $mapels->orderBy('urutan', 'asc');
            $mapels = $mapels->get();
        } else {
            // jangan kasih info tingkat
            abort(404);
        }

        return $this->sendResponse(MataPelajaranResource::collection($mapels), 'MataPelajaran retrieved successfully.');
    }

    /**
     * Display summary the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function summary($id)
    {
        $mapel = MataPelajaran::with('tingkat.jenjang')->find($id);

        if (is_null($mapel)) {
            return $this->sendError('MataPelajaran not found.');
        }

        // counting modul by mapel
        $moduls = Modul::where('mata_pelajaran_id', $id)->get();
        $totalModul = count($moduls);
        // modul done by siswa
        $modulHistory = HistoryModul::where('siswa_id', Auth::user()->id);
        // modul history by mapel
        $modulHistory = $modulHistory->whereHas('modul', function ($query) use ($id) {
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
        $videoHistory = $videoHistory->whereHas('video', function ($query) use ($id) {
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
        $simulasiHistory = $simulasiHistory->whereHas('simulasi', function ($query) use ($id) {
            $query->where('mata_pelajaran_id', $id);
        });
        $simulasiHistory = $simulasiHistory->get();
        $doneSimulasi = count($simulasiHistory);

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

    private function calculatePercentage($total, $done)
    {
        return ($done === 0 || $total === 0) ? 0 : round(($done / $total) * 100, 2);
    }

    public function simulasi(Request $request)
    {
        // $datas = MataPelajaran::search($request);
        // $datas = $datas->with('tingkat.jenjang');
        // $datas = MataPelajaran::with('tingkat.jenjang');
        // // limit data
        // if (@$request->limit) $datas = $datas->limit($request->limit);

        // if (@$request->q_tingkat_id) {
        //     $datas = $datas->where('tingkat_id', $request->q_tingkat_id);
        // }

        // // sort by urutan
        // $datas = $datas->orderBy('urutan', 'asc');

        // // sort by active mapel
        // $datas = $datas->get();

        // $list_mapel_simulation = [];

        // foreach ($datas as $mapel) {
        //     $get_simulation = Simulasi::with('uploader', 'mataPelajaran');
        //     $get_simulation = $get_simulation->where('mata_pelajaran_id', $mapel->id)->get();

        //     if (count($get_simulation) > 0) {
        //         array_push($list_mapel_simulation, $mapel);
        //     }
        // }

        $list_mapel_simulation = [];
        $tingkat = Tingkat::find($request->q_tingkat_id);
        $list_mapel = [];
        if ($tingkat->name >= 1 && $tingkat->name < 4) {
            $list_mapel = ['Tematik'];
        } else if ($tingkat->name >= 4) {
            $list_mapel = ['Matematika', 'IPA'];
        }

        foreach ($list_mapel as $mapel_name) {
            $mapel = MataPelajaran::where(['tingkat_id' => $tingkat->id, 'name' => $mapel_name])->first();
            array_push($list_mapel_simulation, $mapel);
        }

        return $this->sendResponse(MataPelajaranResource::collection($list_mapel_simulation), 'Mata Pelajaran retrieved successfully.');
    }
}
