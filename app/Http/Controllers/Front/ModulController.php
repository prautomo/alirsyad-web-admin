<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
        // mapel data
        $mapel = MataPelajaran::with('tingkat');
        // filter by jenjang yg sama
        $mapel = $mapel->whereHas('tingkat.jenjang', function($query) {
            $query->where('id', @Auth::user()->kelas->tingkat->jenjang_id);
        });
        // filter by tingkat bawahnya
        $mapel = $mapel->whereHas('tingkat', function($query) {
            $query->where('name', '<', @Auth::user()->kelas->tingkat->name);
        });
        $mapel = $mapel->findOrFail($idMapel);

        // moduls
        $moduls = Modul::with('uploader', 'mataPelajaran');
        // handle hak akses mapel
        $user = Auth::user();
        if($user->role !== "GURU"){
            $moduls = $moduls->whereHas('mataPelajaran', function($query) use($user) {
                $query->where('tingkat_id', $user->kelas->tingkat_id);
            });
        }
        
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