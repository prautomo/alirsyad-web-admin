<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Score;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\HistoryModul;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Score as ScoreResource;
   
class ScoreController extends BaseController
{

    /**
     * Display a mata pelajaran listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mapels(Request $request)
    {
        $user = Auth::user();
        $datas = [];

        // load mapel active kelas/tingkat
        $mapels = MataPelajaran::where('tingkat_id', @$user->kelas->tingkat_id)->get();
        $datas[] = [
            'jenjang' => @$user->kelas->tingkat->jenjang->name ?? "-",
            'tingkat' => @$user->kelas->tingkat->name ?? "-",
            'kelas' => @$user->kelas->name  ?? "-",
            'mata_pelajarans' => @$mapels,
        ];

        // load history kelas/tingkat

        return $this->sendResponse(ScoreResource::collection($datas), 'Mata Pelajaran retrieved.');
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
}