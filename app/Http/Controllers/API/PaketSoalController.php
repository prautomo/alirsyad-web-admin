<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\PaketSoal;
use App\Models\ERaport;
use Illuminate\Http\Request;

class PaketSoalController extends BaseController
{
    public function index(Request $request)
    {
        $result_list_bab = [];
        $list_bab = Modul::where(['is_visible' => 1, 'mata_pelajaran_id' => $request->mata_pelajaran_id])->has('paket_soals')->orderBy('urutan')->get();

        foreach($list_bab as $bab){
            $paket_soals = PaketSoal::where([
                'bab_id' => $bab->id,
                'tingkat_kesulitan' => 'mudah',
                'is_active' => 1,
                'is_visible' => 1
            ])->get();

            if(count($paket_soals) > 0){
                $obj_bab = [
                    "id" => $bab->id,
                    "name" => $bab->name,
                    "icon" => $bab->icon,
                    "paket_soal" => $paket_soals
                ];
                array_push($result_list_bab, $obj_bab);
            }
        }

        return $this->sendResponse($result_list_bab, 'Paket soal retrieved successfully.');
    }

    public function checkpoint(Request $request)
    {
        $paket_soal_mudah_id = $request->paket_soal_id;
        $siswa_id = $request->siswa_id;

        $paket_soal_mudah = PaketSoal::find($paket_soal_mudah_id);

        $result = [];
        $isNextLevelAvailable = [];
        $list_tingkat_kesulitan = ['mudah', 'sedang', 'sulit'];
        foreach($list_tingkat_kesulitan as $tingkat_kesulitan){
            $current_paket_soal = PaketSoal::where(['mata_pelajaran_id' => $paket_soal_mudah->mata_pelajaran_id, 'bab_id' => $paket_soal_mudah->bab_id, 'subbab' => $paket_soal_mudah->subbab])->where(['tingkat_kesulitan' => $tingkat_kesulitan])->first();
            
            if($current_paket_soal == null){
                $obj_paket_soal = [
                    "paket_soal_id" => 0,
                    "tingkat_kesulitan" => $tingkat_kesulitan,
                    "is_available" => false
                ];
                array_push($result, $obj_paket_soal);
                continue;
            }
            
            $e_raport = ERaport::where(['user_id' => $siswa_id])->where('paket_soal_id', $current_paket_soal->id)->where(['paket_soal_id' => $current_paket_soal->id])->orderBy('total_benar', 'desc')->first();

            if($e_raport != null){
                $obj_paket_soal = [
                    "paket_soal_id" => $current_paket_soal->id,
                    "tingkat_kesulitan" => $tingkat_kesulitan,
                    "is_available" => true
                ];
                array_push($result, $obj_paket_soal);
                
                if($e_raport->total_benar > $current_paket_soal->nilai_kkm){
                    $isNextLevelAvailable = true;
                }
            }else{
                if($isNextLevelAvailable){
                    $obj_paket_soal = [
                        "paket_soal_id" => $current_paket_soal->id,
                        "tingkat_kesulitan" => $tingkat_kesulitan,
                        "is_available" => true
                    ];
                    array_push($result, $obj_paket_soal);

                    $isNextLevelAvailable = false;
                }else{
                    $obj_paket_soal = [
                        "paket_soal_id" => $current_paket_soal->id,
                        "tingkat_kesulitan" => $tingkat_kesulitan,
                        "is_available" => false
                    ];
                    array_push($result, $obj_paket_soal);
                }
            }
        }

        return $this->sendResponse($result, 'Paket soal checkpoint retrieved successfully.');
    }

    public function all_paket_soal(Request $request)
    {
        $result_list_bab = PaketSoal::where(['is_visible' => 1, 'mata_pelajaran_id' => $request->mata_pelajaran_id])->get();
        return $this->sendResponse($result_list_bab, 'Paket soal retrieved successfully.');
    }
}
