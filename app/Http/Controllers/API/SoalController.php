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
        // $paket_soal = PaketSoal::where([
        //     'mata_pelajaran_id' => $request->mata_pelajaran_id,
        //     'bab_id' => $request->bab_id, 
        //     'subbab' => $request->subbab,
        //     'tingkat_kesulitan' => $request->tingkat_kesulitan,
        //     'is_active' => 1,
        // ])->first();

        $paket_soal = PaketSoal::find($request->paket_soal_id);

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
                    'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'
                )->find(252);

                $obj_soal = [
                    "id" => $get_soal->id,
                    "soal" => trim(strip_tags($get_soal->soal), " \t\n\r\0\x0B\xC2\xA0"),
                    "image" => ""
                ];
                
                $list_multiple_choice = [];
                $obj_soal['jawaban'] = [];
                $length_multiple_choice = 0;

                do {
                    $multiple_choice = chr(rand(97,101));
                    if(!in_array($multiple_choice, $list_multiple_choice )){
                        array_push($list_multiple_choice, $multiple_choice);
                        $choice = $get_soal['pilihan_' . $multiple_choice];
                        if(str_contains($choice, '<img')){
                            $jawaban_img = explode('src="', $choice)[1];
                            $jawaban_img = explode('"', $jawaban_img)[0];
                            $jawaban_contain_img =  $jawaban_img;
                            array_push($obj_soal['jawaban'], $jawaban_contain_img);
                        }else{
                            $temp_jawaban = utf8_decode(strip_tags($choice));
                            $temp_jawaban = str_replace("&nbsp;", "", $temp_jawaban);
                            $temp_jawaban = preg_replace('/\s+/', ' ',$temp_jawaban);
                            $temp_jawaban = trim($temp_jawaban);
                            array_push($obj_soal['jawaban'], $temp_jawaban);
                        }
                        $length_multiple_choice++;
                    }
                }while ($length_multiple_choice < 5);

                 // IF YOU WANT SOME CLEAN RESPONSE (WITH NO HTML)
                if(str_contains($get_soal->soal, '<img')){
                    $soal_img = explode('src="', $get_soal->soal)[1];
                    $soal_img = explode('"', $soal_img)[0];
                    $soal_contain_img =  $soal_img;
                    
                    $temp_soal_contain_img_text = utf8_decode(strip_tags($get_soal->soal));
                    $temp_soal_contain_img_text = str_replace("&nbsp;", "", $temp_soal_contain_img_text);
                    $temp_soal_contain_img_text = preg_replace('/\s+/', ' ',$temp_soal_contain_img_text);
                    $temp_soal_contain_img_text = trim($temp_soal_contain_img_text);

                    $obj_soal['soal'] = $temp_soal_contain_img_text;
                    $obj_soal['image'] = $soal_contain_img;
                }

                array_push($list_idx_soal_to_send, $idx_soal);
                array_push($list_soal_to_send, $obj_soal);
                $idx++;
            }
        } while ($idx <= $length_soal_to_send);

        $data = [
            "paket_soal_id" => $paket_soal->id,
            "tingkat_kesulitan" => $paket_soal->tingkat_kesulitan,
            "list_soal" => $list_soal_to_send
        ];
    
        return $this->sendResponse($data, 'Soal retrieved successfully.');
    }

    public function check_answers(Request $request)
    {
        $paket_soal = PaketSoal::find($request->paket_soal_id);
        $count_correct = 0;
        $next_paket_soal_id = null;
        $next_tingkat_kesulitan = null;

        foreach($request->list_soal as $soal){
            $get_soal = Soal::find($soal['id']);
            $get_jawaban_selection = $get_soal->jawaban;
            $get_jawaban = $get_soal->$get_jawaban_selection;

            // clean jawaban benar
            $temp_get_jawaban = utf8_decode(strip_tags($get_jawaban));
            $temp_get_jawaban = str_replace("&nbsp;", "", $temp_get_jawaban);
            $temp_get_jawaban = preg_replace('/\s+/', ' ',$temp_get_jawaban);
            $temp_get_jawaban = trim($temp_get_jawaban);

            if(str_contains($get_jawaban, '<img')){
                $jawaban_img = explode('src="', $get_jawaban)[1];
                $jawaban_img = explode('"', $jawaban_img)[0];
                $temp_get_jawaban =  $jawaban_img;
            }

            // clean jawaban from req
            $temp_req_jawaban = utf8_decode(strip_tags($soal['jawaban']));
            $temp_req_jawaban = str_replace("&nbsp;", "", $temp_req_jawaban);
            $temp_req_jawaban = preg_replace('/\s+/', ' ',$temp_req_jawaban);
            $temp_req_jawaban = trim($temp_req_jawaban);

            if($temp_get_jawaban == $temp_req_jawaban){
                $count_correct++;
            }
        }

        switch($paket_soal->tingkat_kesulitan){
            case 'mudah': 
                    $get_paket_soal = PaketSoal::where([
                            'mata_pelajaran_id' => $paket_soal->mata_pelajaran_id,
                            'bab_id' => $paket_soal->bab_id, 
                            'subbab' => $paket_soal->subbab,
                            'tingkat_kesulitan' => 'sedang',
                        ])->first();
                    if($get_paket_soal){
                        $next_paket_soal_id = $get_paket_soal->id;
                        $next_tingkat_kesulitan = 'sedang';
                    }
                    break;
            case 'sedang': 
                    $get_paket_soal = PaketSoal::where([
                        'mata_pelajaran_id' => $paket_soal->mata_pelajaran_id,
                        'bab_id' => $paket_soal->bab_id, 
                        'subbab' => $paket_soal->subbab,
                        'tingkat_kesulitan' => 'sulit',
                    ])->first();
                    if($get_paket_soal){
                        $next_paket_soal_id = $get_paket_soal->id;
                        $next_tingkat_kesulitan = 'sulit';
                    }
                    break;
            case 'sulit':
                    $next_paket_soal_id = $paket_soal->id;
                    $next_tingkat_kesulitan = 'sulit';
                    break;
        }

        $data = [
            "score" => $count_correct,
            "next_paket_soal_id" => $next_paket_soal_id,
            "next_tingkat_kesulitan" => $next_tingkat_kesulitan,
        ];

        if($count_correct >= $paket_soal->nilai_kkm){
            $data['status'] = 'pass';
            return $this->sendResponse($data, 'Passed the test.');
        }else{
            $data['status'] = 'fail';
            $data['next_paket_soal_id'] = $paket_soal->id;
            $data['next_tingkat_kesulitan'] = $paket_soal->tingkat_kesulitan;
            return $this->sendResponse($data, 'Failed the test.');
        }

    }
}
