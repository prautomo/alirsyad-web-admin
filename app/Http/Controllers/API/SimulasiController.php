<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Simulasi;
use App\Models\Score;
use App\Models\HistorySimulasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Simulasi as SimulasiResource;
use App\Http\Resources\HistorySimulasi as HistorySimulasiResource;
use App\Http\Resources\Score as ScoreResource;
use Validator;

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
            if(@Auth::user()->role==="SISWA"){
                $query->where('tingkat_id', @Auth::user()->kelas->tingkat_id ?? 0);
            }
        });
        // get list
        $datas = $datas->get();
        // sorting by urutan
        $datas = $datas->sortBy('urutan');

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
        $data = Simulasi::with('mataPelajaran.tingkat.jenjang');
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran', function($query){
            if(@Auth::user()->role==="SISWA"){
                $query->where('tingkat_id', @Auth::user()->kelas->tingkat_id ?? 0);
            }
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
            $query->where('tingkat_id', @$user->kelas->tingkat_id ?? 0);
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

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createScore(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'score' => 'required|numeric|max:100',
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());     
        }

        $data = Simulasi::with('mataPelajaran');
        $user = Auth::user();
  
        // handle hak akses mapel
        $data = $data->whereHas('mataPelajaran', function($query) use ($user){
            $query->where('tingkat_id', @$user->kelas->tingkat_id ?? 0);
        });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Simulasi not found.');
        }

        $pengajar = @$data->mataPelajaran->gurus;

        if($user->role!=='SISWA'){
            $sendResponse = $request->only(['score', 'semester']);

            return $this->sendResponse(new ScoreResource($sendResponse), 'Score not saved. You\'re not a student.');
        }

        if($user->is_pengunjung){
            $sendResponse = $request->only(['score', 'semester']);

            return $this->sendResponse(new ScoreResource($sendResponse), 'Score not saved. You\'re a visitor.');
        }

        // get data prev last score
        $lastScore = Score::where(['simulasi_id' => $id, 'siswa_id' => $user->id])
            ->latest('percobaan_ke')
            ->first();
        
        // from request/payload data
        $saveData = $request->only(['score', 'semester']);

        // if last score not empty, increment percobaan ke
        if($lastScore){
            $saveData['percobaan_ke'] = $lastScore->percobaan_ke + 1;
        }
        $saveData['simulasi_id'] = (int) $id;
        $saveData['siswa_id'] = (int) $user->id;
        $saveData['jenjang'] = @$user->kelas->tingkat->jenjang->name ?? "";
        $saveData['tingkat'] = @$user->kelas->tingkat->name ?? "";
        $saveData['kelas'] = @$user->kelas->name ?? "";
        $saveData['kelas_id'] = @$user->kelas_id ?? "";
        $saveData['pengajar_id'] = @$pengajar[0]->id ?? null;
        $saveData['nama_pengajar'] = @$pengajar[0]->name ?? "";

        if(@$lastScore->percobaan_ke <= 10){
            $createScore = Score::create($saveData);
        }else{
            // update score
            $createScore = $lastScore->update($saveData);;
        }

        $sendResponse = $request->only(['score', 'semester']);
        $sendResponse['percobaan_ke'] = @$saveData['percobaan_ke'] ?? 1;
        
        // create history simulasi
        $historySimulasi = HistorySimulasi::updateOrCreate(
            ['simulasi_id' => $id, 'siswa_id' => $user->id],
            ['semester' => @$data->semester ?? 1]
        );

        return $this->sendResponse(new ScoreResource($sendResponse), 'Score saved successfully.');
    }
}