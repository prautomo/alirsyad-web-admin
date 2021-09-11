<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Modul;
use App\Models\HistoryModul;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Modul as ModulResource;
use App\Http\Resources\HistoryModul as HistoryModulResource;
   
class ModulController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Modul::search($request);
        $datas = $datas->with('mataPelajaran');
        // handle hak akses mapel
        $datas = $datas->whereHas('mataPelajaran', function($query){
            $query->where('tingkat_id', @Auth::user()->kelas->tingkat_id ?? 0);
        });
        $datas = $datas->get();

        return $this->sendResponse(ModulResource::collection($datas), 'Modul retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Modul::with('mataPelajaran.tingkat.jenjang');
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran', function($query){
            $query->where('tingkat_id', @Auth::user()->kelas->tingkat_id ?? 0);
        });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Modul not found.');
        }
   
        return $this->sendResponse(new ModulResource($data), 'Modul retrieved successfully.');
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
        $data = Modul::with('mataPelajaran');
        $user = Auth::user();
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran', function($query) use ($user){
            $query->where('tingkat_id', @$user->kelas->tingkat_id ?? 0);
        });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Modul not found.');
        }

        $historyModul = HistoryModul::firstOrCreate(
            ['modul_id' => $id, 'siswa_id' => $user->id]
        );

        return $this->sendResponse(new HistoryModulResource($historyModul), 'History Modul created successfully.');
    }
}