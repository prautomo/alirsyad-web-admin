<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\GuestMataPelajaran;
use App\Models\Tingkat;
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

        // yg akan datang kalo tingkat akhir
        // 1. get tingkat akhir
        $getTingkatAkhir = Tingkat::where('jenjang_id', @Auth::user()->kelas->tingkat->jenjang_id)->orderBy('name', 'desc')->first();
        // 2. cek tingkat akhir
        if($getTingkatAkhir->name===@Auth::user()->kelas->tingkat->name){
            $yangAkanDatangNextJenjang = MataPelajaran::search($request);
            $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->with('tingkat');
            $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->whereHas('tingkat', function($query) {
                $tingkatnya = @Auth::user()->kelas->tingkat->name;
                // kalo tk b, assign aja akhirnya jadi tingkat 1
                $tingkatnya = $tingkatnya==="B" ? 1 : ((int) $tingkatnya)+1;
                
                $query->where('name', '=', $tingkatnya ?? '-');
            });
            $yangAkanDatangNextJenjang = $yangAkanDatangNextJenjang->get();
            $yangAkanDatang = $yangAkanDatang->merge($yangAkanDatangNextJenjang)->slice(0,2);
        }
        //end

        /**
         * Mapel Aktif buat Pengunjung
         */
        $aktif = MataPelajaran::search($request);
        $aktif = $aktif->with('tingkat');
        // mapel pilihan admin
        $aktif = $aktif->whereHas('guests', function($query) use ($user) {
            $query->where('guest_id', $user->id);
        });
        // sort by active mapel
        $aktif = $aktif->limit(2)->get()->sortBy('name');
        // kalo user belum aktif (kosongin aja list mapelna)
        if($user->status!=="AKTIF") $aktif = [];

        /**
         * Mapel Tidak Aktif buat Pengunjung
         */
        $tidakAktif = MataPelajaran::search($request);
        $tidakAktif = $tidakAktif->with('tingkat');
        // by tingkat
        $tidakAktif = $tidakAktif->whereHas('tingkat', function($q2) use ($user){
            $q2->where('jenjang_id', $user->jenjang_id);
        });
        // mapel bukan pilihan admin
        if($user->status==="AKTIF"){   
            $selectedMapel = GuestMataPelajaran::where('guest_id', $user->id)->get()->pluck('mata_pelajaran_id');
            $tidakAktif = $tidakAktif->whereNotIn('id', $selectedMapel);   
        }
        // sort by active mapel
        $tidakAktif = $tidakAktif->limit(2)->get()->sortBy('name');

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
