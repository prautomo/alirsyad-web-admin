<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Modul;
use App\Models\HistoryModul;
use App\Models\ModulAnotasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Modul as ModulResource;
use App\Http\Resources\HistoryModul as HistoryModulResource;
use App\Models\GuestMataPelajaran;
use App\Services\UploadService;

class ModulController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = @Auth::user();

        // $datas = Modul::search($request);
        // $datas = $datas->with('mataPelajaran');
        $datas = Modul::with('mataPelajaran');

        if (@$request->q_mata_pelajaran_id) {
            $datas = $datas->where('mata_pelajaran_id', $request->q_mata_pelajaran_id);
        }

        // get list
        $datas = $datas->orderBy('urutan', 'asc')->get();
        // // handle hak akses mapel
        // $datas = $datas->whereHas('mataPelajaran.tingkat', function($query) use ($user){
        //     if(@Auth::user()->role==="SISWA"){
        //         if (!$user->is_pengunjung) $query->where('name', '<=', @$user->kelas->tingkat->name);
        //     }
        // });
        $selectedMapel = GuestMataPelajaran::where('guest_id', $user->id)->get()->pluck('mata_pelajaran_id')->toArray();
        if (in_array(@$request->q_mata_pelajaran_id, $selectedMapel)) {
            foreach ($datas as $modul) {
                $modul->mapel_assigned = 1;
            }
        } else {
            foreach ($datas as $modul) {
                $modul->mapel_assigned = 0;
            }
        }



        // sorting by urutan
        // $datas = $datas->sortBy('urutan');

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

        $user = @Auth::user();

        // // handle hak akses mapel
        // $data = $data->whereHas('mataPelajaran.tingkat', function($query) use ($user){
        //     if(@Auth::user()->role==="SISWA"){
        //         if (!$user->is_pengunjung) $query->where('name', '<=', $user->kelas->tingkat->name);
        //     }
        //     // if(@Auth::user()->role==="GURU"){
        //     //     // filter by guru
        //     //     $query = $query->whereHas('gurus', function($queryGuru){
        //     //         $queryGuru->where('guru_id', @Auth::user()->id);
        //     //     });
        //     // }
        // });

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

        // // handle hak akses mapel
        // $data = $data->whereHas('mataPelajaran.tingkat', function($query) use ($user){
        //     // $query->where('id', @$user->kelas->tingkat_id ?? 0);
        //     if(!@$user->is_pengunjung) $query->where('name', '<=', @Auth::user()->kelas->tingkat->name);
        // });

        $data = $data->find($id);

        if (is_null($data)) {
            return $this->sendError('Modul not found.');
        }

        $historyModul = HistoryModul::updateOrCreate(
            ['modul_id' => $id, 'siswa_id' => $user->id],
            ['semester' => @$data->semester ?? 1]
        );

        return $this->sendResponse(new HistoryModulResource($historyModul), 'History Modul created successfully.');
    }

    public function upload(Request $request)
    {
        $fileAnotasi = $request->file('modul');
        $newName = UploadService::uploadPDF($fileAnotasi, 'uploads\modul', @$request->modul_id . '_' . @$request->user_id . '_DIGIBOOK_ANOTASI_FILE_' . gmdate('d_m_Y_h_i_s'));

        $modul = ModulAnotasi::create([
            'modul_id' => $request->modul_id,
            'user_id' => $request->user_id,
            'pdf_path' => $newName
        ]);

        return ["result" => $modul];
    }

    public function getModulAnotasi($id)
    {
        $data = ModulAnotasi::find($id);

        if (is_null($data)) {
            return $this->sendError('Modul not found.');
        }

        return $data;
    }
}
