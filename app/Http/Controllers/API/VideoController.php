<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Video;
use App\Models\HistoryVideo;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Video as VideoResource;
use App\Http\Resources\HistoryVideo as HistoryVideoResource;
   
class VideoController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Video::search($request);
        $datas = $datas->with('uploader', 'mataPelajaran');
        // handle hak akses mapel
        $datas = $datas->whereHas('mataPelajaran.tingkat', function($query){
            if(@Auth::user()->role==="SISWA"){
                $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
            }
        });
        // get list
        $datas = $datas->get();
        // sorting by urutan
        $datas = $datas->sortBy('urutan');

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
        $data = Video::with('mataPelajaran.tingkat.jenjang');
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran.tingkat', function($query){
            if(@Auth::user()->role==="SISWA"){
                $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
            }
        });

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
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran.tingkat', function($query) use ($user){
            $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        });

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