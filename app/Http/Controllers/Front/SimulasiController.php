<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Simulasi;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class SimulasiController extends Controller
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
        $mapel = $mapel->whereHas('tingkat.kelas', function($query) {
            $query->where('id', Auth::user()->kelas_id);
        });
        $mapel = $mapel->findOrFail($idMapel);

        // simulasis
        $simulasis = Simulasi::with('uploader', 'mataPelajaran', 'scores');
        // handle hak akses mapel
        $user = Auth::user();
        if($user->role !== "GURU"){
            $simulasis = $simulasis->whereHas('mataPelajaran', function($query) use($user) {
                $query->where('tingkat_id', $user->kelas->tingkat_id);
            });
        }
        
        $simulasis = $simulasis->where('mata_pelajaran_id', $idMapel);

        // sorting by name
        $simulasis = $simulasis->orderBy('name', 'asc');
        // get list
        $simulasis = $simulasis->get();

        // dd($simulasis);

        $parseData = [
            'idMapel' => $idMapel,
            'mapel' => $mapel,
            'simulasis' => $simulasis,
        ];

        return view('pages/frontoffice/simulasi/list_simulasi', $parseData);
    }

    /**
     * Show the video.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, $id)
    {
        $id = @$id ? explode('-', $id)[0] : 0;
        // simulasi
        $simulasi = Simulasi::with('mataPelajaran');
        // $simulasi = $simulasi->where('kelas_id', Auth::user()->kelas_id);
        $simulasi = $simulasi->findOrFail($id);

        $parseData = [
            'simulasi' => $simulasi,
            'simulasiId' => $id,
        ];

        return view('pages/frontoffice/simulasi/detail', $parseData);
    }

}