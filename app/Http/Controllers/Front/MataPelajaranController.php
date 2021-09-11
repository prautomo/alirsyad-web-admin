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
        $sedangDipelajari = $sedangDipelajari->with('tingkat');
        $sedangDipelajari = $sedangDipelajari->whereHas('tingkat.kelas', function($query) {
            $query->where('id', Auth::user()->kelas_id);
        });
        // sort by active mapel
        $sedangDipelajari = $sedangDipelajari->get();

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
        $yangAkanDatang = $yangAkanDatang->with('tingkat');
        // filter by jenjang yg sama
        $yangAkanDatang = $yangAkanDatang->whereHas('tingkat.jenjang', function($query) {
            $query->where('id', Auth::user()->kelas->tingkat->jenjang_id);
        });
        // filter by tingkat atasnya
        $yangAkanDatang = $yangAkanDatang->whereHas('tingkat', function($query) {
            $query->where('name', '>', Auth::user()->kelas->tingkat->name);
        });
        // get
        $yangAkanDatang = $yangAkanDatang->get();

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
        $mapel = MataPelajaran::with('tingkat');
        $mapel = $mapel->whereHas('tingkat.kelas', function($query) {
            $query->where('id', Auth::user()->kelas_id);
        });
        $mapel = $mapel->findOrFail($id);

        $parseData = [
            'mapel' => $mapel,
            'mapelId' => $id,
        ];

        return view('pages/frontoffice/mapel/detail', $parseData);
    }
}