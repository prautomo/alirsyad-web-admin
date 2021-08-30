<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Video as VideoResource;
   
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
        $datas = $datas->whereHas('mataPelajaran', function($query){
            $query->where('kelas_id', Auth::user()->kelas_id);
        });
        $datas = $datas->get();

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
        $data = Video::with('mataPelajaran.kelas.tingkat');
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran', function($query){
            $query->where('kelas_id', Auth::user()->kelas_id);
        });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Video not found.');
        }
   
        return $this->sendResponse(new VideoResource($data), 'Video retrieved successfully.');
    }
}