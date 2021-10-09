<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Video;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class ScoreController extends Controller
{
    /**
     * Show the score.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $parseData = [
            
        ];

        return view('pages/frontoffice/score/list', $parseData);
    }

}