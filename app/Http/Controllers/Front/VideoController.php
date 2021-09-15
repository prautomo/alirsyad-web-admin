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
        // mapel data
        $mapel = MataPelajaran::with('tingkat');
        $mapel = $mapel->whereHas('tingkat.kelas', function($query) {
            $query->where('id', Auth::user()->kelas_id);
        });
        $mapel = $mapel->findOrFail($idMapel);

        // videos
        $videos = Video::with('uploader', 'mataPelajaran');
        // handle hak akses mapel
        $user = Auth::user();
        if($user->role !== "GURU"){
            $videos = $videos->whereHas('mataPelajaran', function($query) use($user) {
                $query->where('tingkat_id', $user->kelas->tingkat_id);
            });
        }
        
        $videos = $videos->where('mata_pelajaran_id', $idMapel)->get();

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

        dd($video);

        $parseData = [
            'video' => $video,
            'videoId' => $id,
        ];

        return view('pages/frontoffice/video/detail', $parseData);
    }

}