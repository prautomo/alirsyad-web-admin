<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\PaketSoal;
use Illuminate\Http\Request;

class PaketSoalController extends BaseController
{
    public function index(Request $request)
    {
        $result_list_bab = [];
        $list_bab = Modul::where('mata_pelajaran_id', $request->mata_pelajaran_id)->has('paket_soals')->get();

        foreach($list_bab as $bab){
            $obj_bab = [
                "id" => $bab->id,
                "name" => $bab->name,
                "icon" => $bab->icon,
                "paket_soal" => PaketSoal::where([
                    'bab_id' => $bab->id,
                    'tingkat_kesulitan' => 'mudah',
                    'is_active' => 1,
                ])->get()
            ];
            array_push($result_list_bab, $obj_bab);
        }

        return $this->sendResponse($result_list_bab, 'Paket soal retrieved successfully.');
    }

    public function all_paket_soal(Request $request)
    {
        $result_list_bab = PaketSoal::where('mata_pelajaran_id', $request->mata_pelajaran_id)->get();
        return $this->sendResponse($result_list_bab, 'Paket soal retrieved successfully.');
    }
}
