<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\PaketSoal;
use Illuminate\Http\Request;

class PaketSoalController extends BaseController
{
    public function index(Request $request)
    {
        $list_paket_soal = PaketSoal::where([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            // soon get from last position student
            'tingkat_kesulitan' => 'mudah',
            'is_active' => 1,
        ])->get();
    
        return $this->sendResponse($list_paket_soal, 'Paket soal retrieved successfully.');
    }
}
