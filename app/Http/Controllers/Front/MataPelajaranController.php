<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class MataPelajaranController extends Controller
{
    /**
     * Show the mapel list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // sedang di pelajari
        $sedangDipelajari = MataPelajaran::search($request);
        $sedangDipelajari = $sedangDipelajari->with('kelas.tingkat');
        $sedangDipelajari = $sedangDipelajari->where('kelas_id', Auth::user()->kelas_id);
        // sort by active mapel
        $sedangDipelajari = $sedangDipelajari->get()->sortBy('name');

        $parseData = [
            'sedangDipelajari' => $sedangDipelajari,
        ];

        return view('pages/frontoffice/mapel/list', $parseData);
    }

    /**
     * Show the mapel list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexUpcoming(Request $request)
    {
        // upcoming mapel
        $yangAkanDatang = MataPelajaran::search($request);
        $yangAkanDatang = $yangAkanDatang->with('kelas.tingkat');
        $yangAkanDatang = $yangAkanDatang->where('kelas_id', '!=', Auth::user()->kelas_id);
        // sort by active mapel
        $yangAkanDatang = $yangAkanDatang->get()->sortBy('kelas.tingkat_id')->sortBy('kelas_id')->sortBy('name');

        $parseData = [
            'yangAkanDatang' => $yangAkanDatang,
        ];

        return view('pages/frontoffice/mapel/list_upcoming', $parseData);
    }

    /**
     * Show the mapel list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, $id)
    {
        // mapel
        $mapel = MataPelajaran::with('kelas.tingkat');
        $mapel = $mapel->where('kelas_id', Auth::user()->kelas_id);
        $mapel = $mapel->findOrFail($id);

        $parseData = [
            'mapel' => $mapel,
            'mapelId' => $id,
        ];

        return view('pages/frontoffice/mapel/detail', $parseData);
    }
}