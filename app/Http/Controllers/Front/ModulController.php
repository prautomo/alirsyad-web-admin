<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\GuestMataPelajaran;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class ModulController extends Controller
{
    /**
     * Show the list video by mapel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexByMapel(Request $request, $idMapel)
    {
        $user = Auth::user();

        // mapel data
        $mapel = MataPelajaran::with('tingkat');
        // filter by jenjang yg sama
        $mapel = $mapel->whereHas('tingkat.jenjang', function ($query) use ($user) {
            $jenjangId = $user->is_pengunjung ? $user->jenjang_id : $user->kelas->tingkat->jenjang_id;
            $query->where('id', $jenjangId);
        });
        // // filter by tingkat bawahnya
        // if (!$user->is_pengunjung) $mapel = $mapel->whereHas('tingkat', function($query) {
        //     $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        // });
        $mapel = $mapel->findOrFail($idMapel);
        //for check if mapel is assigned
        $selectedMapel = GuestMataPelajaran::where('guest_id', $user->id)->get()->pluck('mata_pelajaran_id')->toArray();
        if (in_array($mapel->id, $selectedMapel)) {
            $mapel->mapel_assigned = 1;
        } else {
            $mapel->mapel_assigned = 0;
        }

        // moduls
        $moduls = Modul::with('uploader', 'mataPelajaran');
        // // handle hak akses mapel
        // $user = Auth::user();
        // if($user->role !== "GURU"){
        //     if (!$user->is_pengunjung) $moduls = $moduls->whereHas('mataPelajaran.tingkat', function($query) use($user) {
        //         $query->where('name', '<=', $user->kelas->tingkat->name);
        //     });
        // }

        // if ($user->status === "AKTIF" && $mapel->mapel_assigned) {
        //     $moduls = $moduls->where('mata_pelajaran_id', $idMapel);
        // } else {
        //     // untuk pengunjung yang belum dikonfirmasi
        //     $moduls = $moduls->where(['is_public' => 1, 'mata_pelajaran_id' => $idMapel]);
        // }
        $moduls = $moduls->where('mata_pelajaran_id', $idMapel);
        // sorting by urutan
        $moduls = $moduls->orderBy('urutan', 'asc');
        // get list
        $moduls = $moduls->get();

        $parseData = [
            'idMapel' => $idMapel,
            'mapel' => $mapel,
            'moduls' => $moduls,
        ];

        return view('pages/frontoffice/modul/list_modul', $parseData);
    }

    /**
     * Show the video.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, $id)
    {
        $id = @$id ? explode('-', $id)[0] : 0;
        // modul
        $modul = Modul::with('mataPelajaran');
        // $modul = $modul->where('kelas_id', Auth::user()->kelas_id);
        $modul = $modul->findOrFail($id);

        $parseData = [
            'modul' => $modul,
            'modulId' => $id,
            'mapelId' => $modul->mata_pelajaran_id,
        ];

        return view('pages/frontoffice/modul/detail', $parseData);
    }
}
