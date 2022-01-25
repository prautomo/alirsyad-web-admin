<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\GuestMataPelajaran;
use App\Models\Tingkat;
use App\Models\Banner;
use App\Models\Update;
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
        if(!@$user->is_pengunjung) $sedangDipelajari = $sedangDipelajari->where('tingkat_id', @$user->kelas->tingkat_id);

        // sorting by urutan
        $sedangDipelajari = $sedangDipelajari->orderBy('urutan', 'asc');

        // limit
        // $sedangDipelajari = $sedangDipelajari->limit(6);

        $sedangDipelajari = $sedangDipelajari->get();
        $sedangDipelajari = $sedangDipelajari->sortBy('urutan');
        $sedangDipelajari = $sedangDipelajari->take(6);

        // upcoming mapel
        $yangAkanDatang = MataPelajaran::search($request);
        $yangAkanDatang = $yangAkanDatang->with('tingkat');
        // filter by jenjang yg sama & siswa is not visitor
        if(!@$user->is_pengunjung) $yangAkanDatang = $yangAkanDatang->whereHas('tingkat.jenjang', function($query) use ($user) {
            $query->where('id', @$user->kelas->tingkat->jenjang_id);
        });
        // filter by tingkat atasnya & siswa is not visitor
        if(!@$user->is_pengunjung) $yangAkanDatang = $yangAkanDatang->whereHas('tingkat', function($query) use ($user) {
            $query->where('name', '>', @$user->kelas->tingkat->name);
        });
        // get
        $yangAkanDatang = $yangAkanDatang->limit(2)->get();

        // // sorting by tingkat
        // $yangAkanDatang = $yangAkanDatang->sortBy('tingkat.name');
        // sorting by created at descending
        $yangAkanDatang = $yangAkanDatang->sortByDesc('created_at');

        // yg akan datang kalo tingkat akhir & bukan pengunjung
        if(!@$user->is_pengunjung){
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
        }
        //end

        // pengunjung
        $aktif = [];
        $tidakAktif = [];
        if(@$user->is_pengunjung){
            /**
             * Mapel Aktif buat Pengunjung
             */
            if($user->status!=="AKTIF") {
                $aktif = MataPelajaran::with('tingkat');

                // mapel tingkat bawah di jenjang user pengunjung
                $lowTingkat = Tingkat::where('jenjang_id', @$user->jenjang_id)->orderBy('name', 'asc')->first();
                $aktif = $aktif->where('tingkat_id', @$lowTingkat->id ?? 0);

                $aktif = $aktif->limit(6)->get();
            }else{
                // $aktif = MataPelajaran::search($request);
                // $aktif = $aktif->with('tingkat');
                $aktif = MataPelajaran::with('tingkat');
                // mapel pilihan admin
                $aktif = $aktif->whereHas('guests', function($query) use ($user) {
                    $query->where('guest_id', $user->id);
                });
                // sort by urutan
                $aktif = $aktif->orderBy('urutan', 'asc');
                // sort by active mapel
                $aktif = $aktif->limit(6)->get();
            }

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
            $tidakAktif = $tidakAktif->limit(6)->get();
            // // sorting by name
            // $tidakAktif = $tidakAktif->sortBy('name')
            // sorting by created at descending
            $tidakAktif = $tidakAktif->sortByDesc('created_at');
        }

        // list kelas
        if(@$user->is_pengunjung){
            // // tingkat selected mapel list
            // $selectedTingkat = GuestMataPelajaran::where('guest_id', $user->id)->get()->pluck('mataPelajaran.tingkat_id');
            // $selectedUniqueTingkat = $selectedTingkat->unique();
            // $kelasList = Tingkat::whereIn('id', $selectedUniqueTingkat)->get();
            $kelasList = [];
        }else{
            $jenjangUser = @Auth::user()->kelas->tingkat->jenjang_id;
            $kelasList = Tingkat::where('jenjang_id', $jenjangUser)->get();
        }

        // Banner
        $banners = Banner::where(['activeStatus' => true])->orderBy('urutan', 'asc')->get();

        // Update
        $updates = [];
        $countUpdates = 0;
        // pengunjung
        if(@$user->is_pengunjung){
            $updates = Update::with('triggerRel');
            // filter se jenjang
            $updates = $updates->whereHas('tingkat.jenjang', function($query) use ($user) {
                $jenjangId = @$user->jenjang_id;
                $query->where('id', $jenjangId);
            });
            // filter by active mapelnya
            // mapel pilihan admin
            $updates = $updates->whereHas('mataPelajaran.guests', function($query) use ($user) {
                $query->where('guest_id', @$user->id);
            });

            $updates = $updates->orderBy('created_at', 'desc');
            $countUpdates = count($updates->get());

            $updates = $updates->limit(5)->get();
        }
        // siswa
        else{
            $updates = Update::with('triggerRel');
            // filter se jenjang
            $updates = $updates->whereHas('tingkat.jenjang', function($query) use ($user) {
                $jenjangId = @$user->kelas->tingkat->jenjang_id;
                $query->where('id', $jenjangId);
            });
            // // filter by tingkat bawahnya
            // $updates = $updates->whereHas('tingkat', function($query) use ($user) {
            //     $query->where('name', '<=', @$user->kelas->tingkat->name);
            // });
            // filter tingkat nya sendiri
            $updates = $updates->where('tingkat_id', @$user->kelas->tingkat_id);
            // sort, limit, and get data
            $updates = $updates->orderBy('created_at', 'desc');
            $countUpdates = count($updates->get());

            $updates = $updates->limit(5)->get();
        }

        $parseData = [
            'sedangDipelajari' => $sedangDipelajari,
            'yangAkanDatang' => $yangAkanDatang,
            'aktif' => $aktif,
            'tidakAktif' => $tidakAktif,
            'kelasList' => $kelasList,
            'banners' => $banners,
            'updates' => $updates,
            'countUpdates' => $countUpdates,
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
