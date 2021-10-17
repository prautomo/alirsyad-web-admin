<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Video;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class VideoController extends Controller
{
    /**
     * Show the list video by mapel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexByMapel(Request $request, $idMapel)
    {
        $user = @Auth::user();

        // mapel data
        $mapel = MataPelajaran::with('tingkat');
        // filter by jenjang yg sama
        $mapel = $mapel->whereHas('tingkat.jenjang', function($query) use ($user){
            $jenjangId = $user->is_pengunjung ? $user->jenjang_id : $user->kelas->tingkat->jenjang_id;
            $query->where('id', $jenjangId);
        });
        // filter by tingkat bawahnya
        if (!$user->is_pengunjung) $mapel = $mapel->whereHas('tingkat', function($query) {
            $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        });
        $mapel = $mapel->findOrFail($idMapel);

        // videos
        $videos = Video::with('uploader', 'mataPelajaran');
        // handle hak akses mapel
        $user = Auth::user();
        if($user->role !== "GURU"){
            if (!$user->is_pengunjung) $videos = $videos->whereHas('mataPelajaran.tingkat', function($query) use($user) {
                $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
            });
        }
        
        $videos = $videos->where('mata_pelajaran_id', $idMapel);
        // sorting by urutan
        $videos = $videos->orderBy('urutan', 'asc');
        // get list
        $videos = $videos->get();

        $parseData = [
            'idMapel' => $idMapel,
            'mapel' => $mapel,
            'videos' => $videos,
        ];

        return view('pages/frontoffice/mapel/list_video', $parseData);
    }

    /**
     * Show the video.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, $id)
    {
        // video
        $video = Video::with('mataPelajaran');
        // $video = $video->where('kelas_id', Auth::user()->kelas_id);
        $video = $video->findOrFail($id);

        $parseData = [
            'video' => $video,
            'videoId' => $id,
        ];

        return view('pages/frontoffice/video/detail', $parseData);
    }

}