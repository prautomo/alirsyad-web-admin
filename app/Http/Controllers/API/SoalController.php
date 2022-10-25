<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Soal as ResourcesSoal;
use App\Models\PaketSoal;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends BaseController
{
    public function index(Request $request)
    {
        $paket_soal = PaketSoal::where([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'bab_id' => $request->bab_id, 
            'subbab' => $request->subbab,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
            'is_active' => 1,
        ])->first();

        if(!$paket_soal){
            return $this->sendError('Soal is not exist.');
        }

        $length_all_soal = Soal::where('paket_soal_id', $paket_soal['id'])->count();
        $list_soal_id = Soal::where('paket_soal_id', $paket_soal['id'])->pluck('id')->toArray();

        $length_soal_to_send = $paket_soal->jumlah_publish;
        $list_idx_soal_to_send = [];
        $list_soal_to_send = [];

        $idx = 1;
        do {
            $random_idx = rand(0, $length_all_soal - 1);
            if(!in_array($list_soal_id[$random_idx], $list_idx_soal_to_send )){
                $idx_soal = $list_soal_id[$random_idx];
                $get_soal = Soal::select(
                    'id', 'soal',
                    'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e',
                )->find($idx_soal);
                array_push($list_idx_soal_to_send, $idx_soal);
                array_push($list_soal_to_send, $get_soal);
            }
            $idx++;
        } while ($idx <= $length_soal_to_send);
    
        return $this->sendResponse($list_soal_to_send, 'Soal retrieved successfully.');
    }
}
