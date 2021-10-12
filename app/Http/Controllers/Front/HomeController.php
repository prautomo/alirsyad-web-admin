<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = @Auth::user();

        // sedang di pelajari
        $sedangDipelajari = MataPelajaran::search($request);
        $sedangDipelajari = $sedangDipelajari->with('tingkat');
        // user is siswa and not visitor
        if(!@$user->is_pengunjung) $sedangDipelajari = $sedangDipelajari->whereHas('tingkat.kelas', function($query) use ($user) {
            $query->where('id', $user->kelas_id);
        });
        // sort by active mapel
        $sedangDipelajari = $sedangDipelajari->limit(2)->get()->sortBy('name');

        // upcoming mapel
        $yangAkanDatang = MataPelajaran::search($request);
        $yangAkanDatang = $yangAkanDatang->with('tingkat');
        // filter by jenjang yg sama & siswa is not visitor
        if(!@$user->is_pengunjung) $yangAkanDatang = $yangAkanDatang->whereHas('tingkat.jenjang', function($query) use ($user) {
            $query->where('id', $user->kelas->tingkat->jenjang_id);
        });
        // filter by tingkat atasnya & siswa is not visitor
        if(!@$user->is_pengunjung) $yangAkanDatang = $yangAkanDatang->whereHas('tingkat', function($query) use ($user) {
            $query->where('name', '>', $user->kelas->tingkat->name);
        });
        // get
        $yangAkanDatang = $yangAkanDatang->limit(2)->get();

        // sorting by tingkat
        $yangAkanDatang = $yangAkanDatang->sortBy('tingkat.name');

        /**
         * Mapel Aktif buat Pengunjung
         */
        $aktif = [];

        /**
         * Mapel Tidak Aktif buat Pengunjung
         */
        $tidakAktif = [];

        $parseData = [
            'sedangDipelajari' => $sedangDipelajari,
            'yangAkanDatang' => $yangAkanDatang,
            'aktif' => $aktif,
            'tidakAktif' => $tidakAktif,
        ];

        return view('pages/frontoffice/home', $parseData);
    }

    public function upload(Request $request)
    {
        $image_parts = explode(";base64,", $request->base_image);
        $image_type_aux = "image/png";
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $url = UploadService::uploadBaseImage($image_base64, 'images/materi');

        return [
            "image_url" => $url
        ];
    }
}
