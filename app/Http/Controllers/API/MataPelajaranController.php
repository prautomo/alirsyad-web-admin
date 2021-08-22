<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MataPelajaran as MataPelajaranResource;
   
class MataPelajaranController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = MataPelajaran::search($request);
        $datas = $datas->with('kelas.tingkat');
        // sort by active mapel
        $datas = $datas->get()->sortBy('disabled')->sortBy('kelas.tingkat_id')->sortBy('kelas_id');

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inprogress(Request $request)
    {
        $datas = MataPelajaran::search($request);
        $datas = $datas->with('kelas.tingkat');
        $datas = $datas->where('kelas_id', Auth::user()->kelas_id);
        // sort by active mapel
        $datas = $datas->get()->sortBy('name');

        return $this->sendResponse(MataPelajaranResource::collection($datas), 'Mata Pelajaran retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upcoming(Request $request)
    {
        $datas = MataPelajaran::search($request);
        $datas = $datas->with('kelas.tingkat');
        $datas = $datas->where('kelas_id', '!=', Auth::user()->kelas_id);
        // sort by active mapel
        $datas = $datas->get()->sortBy('kelas.tingkat_id')->sortBy('kelas_id')->sortBy('name');

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
        $data = MataPelajaran::with('kelas.tingkat')->find($id);
  
        if (is_null($data)) {
            return $this->sendError('MataPelajaran not found.');
        }
   
        return $this->sendResponse(new MataPelajaranResource($data), 'MataPelajaran retrieved successfully.');
    }
}