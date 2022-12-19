<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ERaport;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\PaketSoal;
use Illuminate\Http\Request;

class ERaportController extends BaseController
{
    public function score(Request $request)
    {
        $user_id = $request->user_id;
        $mata_pelajaran_id = $request->mata_pelajaran_id;

        $list_bab_id = PaketSoal::where('mata_pelajaran_id', $mata_pelajaran_id)->distinct()->pluck('bab_id')->toArray();
        $list_tingkat_kesulitan = ['mudah', 'sedang', 'sulit'];

        $list_bab = [];
        foreach ($list_bab_id as $bab_id) {
            $get_bab = Modul::find($bab_id);
            $list_judul_subbab = PaketSoal::where(['mata_pelajaran_id' => $mata_pelajaran_id, 'bab_id' => $bab_id])->distinct()->pluck('judul_subbab')->toArray();
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

        return $this->sendResponse($list_bab, 'Score retrieved successfully.');
    }

    public function summary_of_level(Request $request)
    {
        $user_id = $request->user_id;
        $mata_pelajaran_id = $request->mata_pelajaran_id;

        $list_paket_soal = PaketSoal::where('mata_pelajaran_id', $mata_pelajaran_id)->get()->groupBy(function($data) {
            return $data->tingkat_kesulitan;
        });
        $list_tingkat_kesulitan = ['mudah', 'sedang', 'sulit'];
        $result = [];

        foreach($list_tingkat_kesulitan as $tingkat_kesulitan){

            $nilai_obj = [
                'tingkat_kesulitan' => $tingkat_kesulitan,
                'percentage' => 0,
                'total_benar' => 0,
                'total_terjawab' => 0,
            ];

            foreach($list_paket_soal[$tingkat_kesulitan] as $paket_soal){
                $get_e_raport = ERaport::where(['user_id' => $user_id, 'paket_soal_id' => $paket_soal->id])->first();

                if ($get_e_raport != null) {

                    $nilai_obj['total_benar'] += $get_e_raport->total_benar;
                    $nilai_obj['total_terjawab'] += $get_e_raport->total_terjawab;
                }
            }

            if($nilai_obj['total_benar'] > 0 && $nilai_obj['total_terjawab'] > 0){
                $nilai_obj['percentage'] = ($nilai_obj['total_benar'] / $nilai_obj['total_terjawab']) * 100;
            }

            array_push($result, $nilai_obj);
        }

        return $this->sendResponse($result, 'Summary of level retrieved successfully.');
    }

    public function subject_achievement(Request $request)
    {
        $user_id = $request->user_id;
        $tingkat_id = $request->tingkat_id;

        $list_mapel = MataPelajaran::where('tingkat_id', $tingkat_id)->get();
        $result = [];

        foreach($list_mapel as $mapel){
            $list_paket_soal = PaketSoal::where('mata_pelajaran_id', $mapel->id)->get();
            
            $mata_pelajaran = MataPelajaran::find($mapel->id);

            $nilai_obj = [
                'mata_pelajaran' => $mata_pelajaran->name,
                'percentage' => 0,
                'total_benar' => 0,
                'total_terjawab' => 0,
            ];

            foreach($list_paket_soal as $paket_soal){
                $get_e_raport = ERaport::where(['user_id' => $user_id, 'paket_soal_id' => $paket_soal->id])->first();

                if ($get_e_raport != null) {

                    $nilai_obj['total_benar'] += $get_e_raport->total_benar;
                    $nilai_obj['total_terjawab'] += $get_e_raport->total_terjawab;
                }
            }
            
            if($nilai_obj['total_benar'] > 0 && $nilai_obj['total_terjawab'] > 0){
                $nilai_obj['percentage'] = ($nilai_obj['total_benar'] / $nilai_obj['total_terjawab']) * 100;
            }

            array_push($result, $nilai_obj);
        }

        return $this->sendResponse($result, 'Subject achievement retrieved successfully.');
    
    }

    public function home_achievement(Request $request)
    {
        $user_id = $request->user_id;
        $tingkat_id = $request->tingkat_id;

        // $list_mapel = MataPelajaran::where('tingkat_id', $tingkat_id)->get();
        $list_paket_soal = PaketSoal::whereHas('mataPelajaran', function ($query) use ($tingkat_id) {
            return $query->where('tingkat_id', '=', $tingkat_id);
        })->get();

        $nilai_obj = [
            'percentage' => 0,
            'total_benar' => 0,
            'total_terjawab' => 0,
        ];

        foreach($list_paket_soal as $paket_soal){
            $get_e_raport = ERaport::where(['user_id' => $user_id, 'paket_soal_id' => $paket_soal->id])->first();

            if ($get_e_raport != null) {

                $nilai_obj['total_benar'] += $get_e_raport->total_benar;
                $nilai_obj['total_terjawab'] += $get_e_raport->total_terjawab;
            }
        }
        
        if($nilai_obj['total_benar'] > 0 && $nilai_obj['total_terjawab'] > 0){
            $nilai_obj['percentage'] = ($nilai_obj['total_benar'] / $nilai_obj['total_terjawab']) * 100;
        }

        return $this->sendResponse($nilai_obj, 'Home achievement retrieved successfully.');
    
    }
}
