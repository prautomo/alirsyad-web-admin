<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Video;
use App\Models\HistoryVideo;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Video as VideoResource;
use App\Http\Resources\HistoryVideo as HistoryVideoResource;
use App\Models\GuestMataPelajaran;

class VideoController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = @Auth::user();

        // $datas = Video::search($request);
        // $datas = $datas->with('uploader', 'mataPelajaran');
        $datas = Video::with('uploader', 'mataPelajaran');
        // // handle hak akses mapel
        // $datas = $datas->whereHas('mataPelajaran.tingkat', function($query) use ($user){
        //     if(@Auth::user()->role==="SISWA"){
        //         if (!$user->is_pengunjung) $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        //     }
        // });
        // visible for siswa/guest
        if (@Auth::user()->role === "SISWA") {
            $datas = $datas->where('visible', 1);
        }

        if (@$request->q_mata_pelajaran_id) {
            $datas = $datas->where('mata_pelajaran_id', $request->q_mata_pelajaran_id);
        }

        // get list
        $datas = $datas->orderBy('urutan', 'asc')->get();

        $selectedMapel = GuestMataPelajaran::where('guest_id', $user->id)->get()->pluck('mata_pelajaran_id')->toArray();
        if (in_array(@$request->q_mata_pelajaran_id, $selectedMapel)) {
            foreach ($datas as $video) {
                $video->mapel_assigned = 1;
            }
        } else {
            foreach ($datas as $video) {
                $video->mapel_assigned = 0;
            }
        }
        // sorting by urutan
        // $datas = $datas->sortBy('urutan');

        return $this->sendResponse(VideoResource::collection($datas), 'Video retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = @Auth::user();

        $data = Video::with('mataPelajaran.tingkat.jenjang');

        // // handle hak akses mapel
        // $data = $data->whereHas('mataPelajaran.tingkat', function($query) use($user){
        //     if(@Auth::user()->role==="SISWA"){
        //         if (!$user->is_pengunjung) $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        //     }
        // });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Video not found.');
        }

        return $this->sendResponse(new VideoResource($data), 'Video retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createHistory(Request $request, $id)
    {
        $data = Video::with('mataPelajaran');
        $user = Auth::user();

        // // handle hak akses mapel
        // $data = $data->whereHas('mataPelajaran.tingkat', function($query) use ($user){
        //     if(!@$user->is_pengunjung) $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        // });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Video not found.');
        }

        $historyVideo = HistoryVideo::updateOrCreate(
            ['video_id' => $id, 'siswa_id' => $user->id],
            ['semester' => @$data->semester ?? 1]
        );

        return $this->sendResponse(new HistoryVideoResource($historyVideo), 'History Video created successfully.');
    }
}
