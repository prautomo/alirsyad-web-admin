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
use App\Models\GuestMataPelajaran;
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

        $user = @Auth::user();

        $datas = Simulasi::with('uploader', 'mataPelajaran')->where(['is_visible' => 1]);

        // // handle hak akses mapel
        // $user = Auth::user();
        // if($user->role !== "GURU"){
        //     if (!$user->is_pengunjung) $datas = $datas->whereHas('mataPelajaran.tingkat', function($query) use($user) {
        //         $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        //     });
        // }

        $idMapel = @$request->q_mata_pelajaran_id;

        if ($idMapel) {
            $datas = $datas->where('mata_pelajaran_id', $idMapel);
        }

        // sorting by urutan
        $datas = $datas->orderBy('urutan', 'asc')->orderBy('level', 'asc');

        // get list
        $datas = $datas->get();

        $selectedMapel = GuestMataPelajaran::where('guest_id', $user->id)->get()->pluck('mata_pelajaran_id')->toArray();
        if (in_array(@$request->q_mata_pelajaran_id, $selectedMapel)) {
            foreach ($datas as $simulasi) {
                $simulasi->mapel_assigned = 1;
            }
        } else {
            foreach ($datas as $simulasi) {
                $simulasi->mapel_assigned = 0;
            }
        }

        // sorting by urutan
        // $datas = $datas->sortBy('urutan')->sortBy('level');

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
        $user = @Auth::user();

        $data = Simulasi::with('mataPelajaran.tingkat.jenjang')->where(['is_visible' => 1]);

        // // handle hak akses mapel
        // $data = $data->whereHas('mataPelajaran.tingkat', function($query) use ($user){
        //     if(@Auth::user()->role==="SISWA"){
        //         if (!$user->is_pengunjung) $query->where('name', '<=', @$user->kelas->tingkat->name);
        //     }
        // });

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

        // // handle hak akses mapel
        // $data = $data->whereHas('mataPelajaran.tingkat', function($query) use ($user){
        //     if (!$user->is_pengunjung) $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        // });

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

        if ($user->is_pengunjung) {
            return $this->returnStatus(400, "Score not saved. You\'re not a student.");
        }

        // // handle hak akses mapel
        // $data = $data->whereHas('mataPelajaran', function($query) use ($user){
        //     if (!$user->is_pengunjung) $query->where('tingkat_id', @$user->kelas->tingkat_id ?? 0);
        // });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Simulasi not found.');
        }

        $pengajar = @$data->mataPelajaran->gurus;

        if ($user->role !== 'SISWA') {
            $sendResponse = $request->only(['score', 'semester']);

            return $this->sendResponse(new ScoreResource($sendResponse), 'Score not saved. You\'re not a student.');
        }

        if ($user->is_pengunjung) {
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
        if ($lastScore) {
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

        // kode lama
        // if(@$lastScore->percobaan_ke <= 10){
        //     $createScore = Score::create($saveData);
        // }else{
        //     // update score
        //     $createScore = $lastScore->update($saveData);;
        // }
        //kode baru
        $createScore = Score::create($saveData);

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
