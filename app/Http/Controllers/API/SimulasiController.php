<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Simulasi;
use App\Models\HistorySimulasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Simulasi as SimulasiResource;
use App\Http\Resources\HistorySimulasi as HistorySimulasiResource;
   
class SimulasiController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Simulasi::search($request);
        $datas = $datas->with('uploader', 'mataPelajaran');
        // handle hak akses mapel
        $datas = $datas->whereHas('mataPelajaran', function($query){
            $query->where('kelas_id', Auth::user()->kelas_id);
        });
        $datas = $datas->get();

        return $this->sendResponse(SimulasiResource::collection($datas), 'Simulasi retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Simulasi::with('mataPelajaran.kelas.tingkat');
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran', function($query){
            $query->where('kelas_id', Auth::user()->kelas_id);
        });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Simulasi not found.');
        }
   
        return $this->sendResponse(new SimulasiResource($data), 'Simulasi retrieved successfully.');
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
        $data = Simulasi::with('mataPelajaran');
        $user = Auth::user();
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran', function($query) use ($user){
            $query->where('kelas_id', $user->kelas_id);
        });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Simulasi not found.');
        }

        $historySimulasi = HistorySimulasi::firstOrCreate(
            ['simulasi_id' => $id, 'siswa_id' => $user->id]
        );

        return $this->sendResponse(new HistorySimulasiResource($historySimulasi), 'History Simulasi created successfully.');
    }
}