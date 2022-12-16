<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ERaport;
use App\Models\Modul;
use App\Models\PaketSoal;
use Illuminate\Http\Request;

class ERaportController extends BaseController
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $mata_pelajaran_id = $request->mata_pelajaran_id;

        $list_bab_id = PaketSoal::where('mata_pelajaran_id', $mata_pelajaran_id)->pluck('bab_id')->toArray();
        $list_tingkat_kesulitan = ['mudah', 'sedang', 'sulit'];

        $list_bab = [];
        foreach ($list_bab_id as $bab_id) {
            $get_bab = Modul::find($bab_id);
            $list_judul_subbab = PaketSoal::where(['mata_pelajaran_id' => $mata_pelajaran_id, 'bab_id' => $bab_id])->pluck('judul_subbab')->toArray();
            $list_subbab = [];

            foreach ($list_judul_subbab as $judul_subbab) {
                $list_subbab_nilai = [];

                foreach ($list_tingkat_kesulitan as $tingkat_kesulitan) {
                    $get_paket_soal = PaketSoal::where([
                        'mata_pelajaran_id' => $mata_pelajaran_id,
                        'bab_id' => $bab_id,
                        'judul_subbab' => $judul_subbab,
                        'tingkat_kesulitan' => $tingkat_kesulitan,
                    ])->first();

                    $subbab_nilai_obj = [
                        'tingkat_kesulitan' => $tingkat_kesulitan,
                        'percentage' => 0,
                        'total_benar' => 0,
                        'total_terjawab' => 0,
                    ];

                    if ($get_paket_soal != null) {
                        $get_e_raport = ERaport::where(['user_id' => $user_id, 'paket_soal_id' => $get_paket_soal->id])->first();

                        if ($get_e_raport != null) {
                            $subbab_nilai_obj['percentage'] = ($get_e_raport->total_benar / $get_e_raport->total_terjawab) * 100;
                            $subbab_nilai_obj['total_benar'] = $get_e_raport->total_benar;
                            $subbab_nilai_obj['total_terjawab'] = $get_e_raport->total_terjawab;
                        }
                    }

                    array_push($list_subbab_nilai, $subbab_nilai_obj);
                }

                $subbab_obj = [
                    'nama' => $judul_subbab,
                    'nilai' => $list_subbab_nilai
                ];

                array_push($list_subbab, $subbab_obj);
            }

            $bab_obj = [
                'nama' => $get_bab->name,
                'icon' => $get_bab->icon,
                'subbab' => $list_subbab
            ];
            array_push($list_bab, $bab_obj);
        }

        return $this->sendResponse($list_bab, 'Paket soal retrieved successfully.');
    }
}
