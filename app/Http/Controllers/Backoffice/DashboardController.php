<?php
namespace App\Http\Controllers\Backoffice;

/*
 * @Author      : Ferdhika Yudira
 * @Date        : 2020-07-18 14:17:32
 * @Web         : http://dika.web.id
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ERaport;
use App\Models\ExternalUser;
use App\Models\GuruMataPelajaran;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\PaketSoal;
use App\Models\Tingkat;
use App\Models\KelasSiswa;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        // dd(Auth::user()->roles->pluck('name'));

        $authUserRole = Auth::user()->roles->pluck('name')->toArray();
        $activeRole = Session::get('activeRole');
        $viewDashboard = "";

        if($activeRole != null){
            if ($activeRole == "Guru Mata Pelajaran") {
                $viewDashboard = 'guru_mapel';
            }else if($activeRole == "Wali Kelas"){
                $viewDashboard = 'wali_kelas';
            }else if($activeRole == "Kepala Sekolah"){
                $viewDashboard = 'kepala_sekolah';
            }else{
                $viewDashboard = 'superadmin';
            }
        }else{
            if (in_array("Guru Mata Pelajaran", $authUserRole)) {
                $viewDashboard = 'guru_mapel';
            }else if(in_array("Wali Kelas", $authUserRole)){
                $viewDashboard = 'wali_kelas';
            }else if(in_array("Kepala Sekolah", $authUserRole)){
                $viewDashboard = 'kepala_sekolah';
            }else{
                $viewDashboard = 'superadmin';
            }
        }

        return view('pages.backoffice.dashboard.'. $viewDashboard, $data);

    }

    public function getDataJenjang(Request $request)
    {
        $result = [];
        $result_ids = [];

        $query_filter_tahun_ajaran = '';
        $tahun_ajaran = Session::get('dshTahunAjaran');
        if ($tahun_ajaran != ''){
            $query_filter_tahun_ajaran = " and ks.tahun_ajaran = '" . $tahun_ajaran . "' ";
        }

        $jenjangs = Jenjang::where(['deleted_at' => NULL, 'show_for_guest' => 1])->get();

        $result_from_db = DB::select("select jenjang_id, jenjang_name, tingkat_kesulitan, sum(total_benar) as total_benar from (select j.id as jenjang_id, j.name as jenjang_name, e.paket_soal_id as paket_soal_id, ps.tingkat_kesulitan, e.total_benar from jenjangs j
        join tingkats t on j.id = t.jenjang_id
        join mata_pelajarans mp on t.id = mp.tingkat_id
        join paket_soals ps on mp.id = ps.mata_pelajaran_id
        join e_raport e on ps.id = e.paket_soal_id
        join external_users eu on e.user_id = eu.id
        join kelas_siswas ks on eu.id = ks.siswa_id ". $query_filter_tahun_ajaran . "
        join kelas k on ks.kelas_id = k.id and k.tingkat_id = t.id
        where eu.deleted_at is null and j.deleted_at is null and ps.deleted_at is null) grouped
        group by jenjang_id, tingkat_kesulitan");

        $count_scores = [];
        foreach($result_from_db as $item){
            if(!array_key_exists($item->jenjang_id, $count_scores)){
                $count_scores[$item->jenjang_id] = 0;
            }

            $count_scores[$item->jenjang_id] += $this->getScoreFinal($item->total_benar, $item->tingkat_kesulitan);
        }

        foreach($jenjangs as $jenjang){
            $score = 0;
            if(array_key_exists($jenjang->id, $count_scores)){
                $score = $count_scores[$jenjang->id];
            }
            array_push($result, [
                "label" => $jenjang->name,
                "score" => $score
            ]);
            array_push($result_ids, $jenjang->id);
        }

        $next_api = [
            "name" => "tingkat",
            "param" => "jenjang_id",
        ];

        $data = [
            "level" => "jenjang",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "graphic_title" => "Ringkasan Grafik"
        ];

        Session::put('dshLevel', $data['level']);
        Session::put('dshParam', null);
        Session::put('dshValue', null);

        return response()->json(['message' => 'success', 'data' => $data, 'tahun_ajaran' => $tahun_ajaran, 'query_filter_tahun_ajaran' => $query_filter_tahun_ajaran]);
    }

    public function getScoreFinal($total_benar, $tingkat_kesulitan){
        $score = 0;
        switch ($tingkat_kesulitan) {
            case "mudah":
                $score = $total_benar * 1;
                break;
            case "sedang":
                $score = $total_benar * 2;
                break;
            case "sulit":
                $score = $total_benar * 3;
                break;
            default:
              //code block
        }
        return $score;
    }

    public function getDataTingkat(Request $request)
    {
        $jenjang_id = 0;
        if($request->jenjang_id){
            $jenjang_id = $request->jenjang_id;
        }

        $activeRole = Session::get('activeRole');
        if($activeRole == "Kepala Sekolah"){
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $jenjang_kepsek = Jenjang::where(['kepala_sekolah_id' => $guru->id])->first();

            if($jenjang_kepsek){
                $jenjang_id = $jenjang_kepsek->id;
            }
        }

        $result = [];
        $result_ids = [];

        $query_filter_tahun_ajaran = '';
        $tahun_ajaran = Session::get('dshTahunAjaran');
        if ($tahun_ajaran != ''){
            $query_filter_tahun_ajaran = " and ks.tahun_ajaran = '" . $tahun_ajaran . "' ";
        }   

        $tingkats = Tingkat::where(['deleted_at' => NULL, 'jenjang_id' => $jenjang_id])->get();

        $result_from_db = DB::select("select tingkat_id, tingkat_name, tingkat_kesulitan, sum(total_benar) as total_benar from (
        select t.id as tingkat_id, t.name as tingkat_name, e.paket_soal_id as paket_soal_id, ps.tingkat_kesulitan, e.total_benar from tingkats t
        join mata_pelajarans mp on t.id = mp.tingkat_id
        join paket_soals ps on mp.id = ps.mata_pelajaran_id
        join e_raport e on ps.id = e.paket_soal_id
        join external_users eu on e.user_id = eu.id
        join kelas_siswas ks on eu.id = ks.siswa_id ". $query_filter_tahun_ajaran . "
        join kelas k on ks.kelas_id = k.id and k.tingkat_id = t.id
        where eu.deleted_at is null and t.deleted_at is null and ps.deleted_at is null and t.jenjang_id = ?) grouped
        group by tingkat_id, tingkat_kesulitan", array($jenjang_id));

        $count_scores = [];
        foreach($result_from_db as $item){
            if(!array_key_exists($item->tingkat_id, $count_scores)){
                $count_scores[$item->tingkat_id] = 0;
            }

            $count_scores[$item->tingkat_id] += $this->getScoreFinal($item->total_benar, $item->tingkat_kesulitan);
        }

        foreach($tingkats as $tingkat){
            $score = 0;
            if(array_key_exists($tingkat->id, $count_scores)){
                $score = $count_scores[$tingkat->id];
            }
            array_push($result, [
                "label" => $tingkat->jenjang->name . " " . $tingkat->name,
                "score" => $score
            ]);
            array_push($result_ids, $tingkat->id);
        }

        $next_api = [
            "name" => "kelas",
            "param" => "tingkat_id",
        ];

        $jenjang = Jenjang::find($jenjang_id);
        $data = [
            "level" => "tingkat",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "graphic_title" => $jenjang->name
        ];

        $this->setCurrentDashboard($data['level'], 'jenjang_id', $jenjang_id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getDataKelas(Request $request)
    {
        $tingkat_id = 0;
        if($request->tingkat_id){
            $tingkat_id = $request->tingkat_id;
        }

        $result = [];
        $result_ids = [];

        $query_filter_tahun_ajaran = '';
        $tahun_ajaran = Session::get('dshTahunAjaran');
        if ($tahun_ajaran != ''){
            $query_filter_tahun_ajaran = " and ks.tahun_ajaran = '" . $tahun_ajaran . "' ";
        }   

        $classes = Kelas::where(['deleted_at' => NULL, 'tingkat_id' => $tingkat_id])->get();

        $result_from_db = DB::select("select kelas_id, kelas_name, tingkat_kesulitan, sum(total_benar) as total_benar from (
        select k.id as kelas_id, k.name as kelas_name, e.paket_soal_id as paket_soal_id, ps.tingkat_kesulitan, e.total_benar from kelas k
        join tingkats t on k.tingkat_id = t.id
        join mata_pelajarans mp on t.id = mp.tingkat_id
        join paket_soals ps on mp.id = ps.mata_pelajaran_id
        join e_raport e on ps.id = e.paket_soal_id
        join external_users eu on e.user_id = eu.id
        join kelas_siswas ks on eu.id = ks.siswa_id and ks.kelas_id = k.id ". $query_filter_tahun_ajaran . "
        where eu.deleted_at is null and k.deleted_at is null and ps.deleted_at is null and k.tingkat_id = ?) grouped
        group by kelas_id, tingkat_kesulitan", array($tingkat_id));

        $count_scores = [];
        foreach($result_from_db as $item){
            if(!array_key_exists($item->kelas_id, $count_scores)){
                $count_scores[$item->kelas_id] = 0;
            }

            $count_scores[$item->kelas_id] += $this->getScoreFinal($item->total_benar, $item->tingkat_kesulitan);
        }

        foreach($classes as $class){
            $score = 0;
            if(array_key_exists($class->id, $count_scores)){
                $score = $count_scores[$class->id];
            }
            array_push($result, [
                "label" => $class->tingkat->jenjang->name . " " . $class->tingkat->name . $class->name,
                "score" => $score
            ]);
            array_push($result_ids, $class->id);
        }

        $next_api = [
            "name" => "mapel",
            "param" => "kelas_id",
        ];

        $tingkat = Tingkat::find($tingkat_id);
        $data = [
            "level" => "kelas",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "graphic_title" => $tingkat->jenjang->name . " " . $tingkat->name
        ];

        $this->setCurrentDashboard($data['level'], 'tingkat_id', $tingkat_id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getDataMapel(Request $request)
    {
        $kelas_id = 0;
        if($request->kelas_id){
            $kelas_id = $request->kelas_id;
        }

        $activeRole = Session::get('activeRole');
        if($activeRole == "Wali Kelas"){
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $kelas_guru = Kelas::where(['wali_kelas_id' => $guru->id])->first();

            if($kelas_guru){
                $kelas_id = $kelas_guru->id;
            }
        }

        $result = [];
        $result_ids = [];

        $query_filter_tahun_ajaran = '';
        $tahun_ajaran = Session::get('dshTahunAjaran');
        if ($tahun_ajaran != ''){
            $query_filter_tahun_ajaran = " and ks.tahun_ajaran = '" . $tahun_ajaran . "' ";
        }       

        $tingkat_id = Kelas::find($kelas_id)->tingkat_id;
        $mata_pelajarans = MataPelajaran::where(['deleted_at' => NULL, 'tingkat_id' => $tingkat_id])->orderBy('urutan')->get();

        $result_from_db = DB::select("select mata_pelajaran_id, mata_pelajaran_name, tingkat_kesulitan, sum(total_benar) as total_benar from (
        select mp.id as mata_pelajaran_id, mp.name as mata_pelajaran_name, e.paket_soal_id as paket_soal_id, ps.tingkat_kesulitan, e.total_benar from mata_pelajarans mp
        join paket_soals ps on mp.id = ps.mata_pelajaran_id
        join e_raport e on ps.id = e.paket_soal_id
        join external_users eu on e.user_id = eu.id
        join kelas_siswas ks on eu.id = ks.siswa_id and ks.kelas_id = ? ". $query_filter_tahun_ajaran . "
        where eu.deleted_at is null and mp.deleted_at is null and ps.deleted_at is null) grouped
        group by mata_pelajaran_id, tingkat_kesulitan", array($kelas_id));

        $count_scores = [];
        foreach($result_from_db as $item){
            if(!array_key_exists($item->mata_pelajaran_id, $count_scores)){
                $count_scores[$item->mata_pelajaran_id] = 0;
            }

            $count_scores[$item->mata_pelajaran_id] += $this->getScoreFinal($item->total_benar, $item->tingkat_kesulitan);
        }

        foreach($mata_pelajarans as $mata_pelajaran){
            $score = 0;
            if(array_key_exists($mata_pelajaran->id, $count_scores)){
                $score = $count_scores[$mata_pelajaran->id];
            }
            array_push($result, [
                "label" => $mata_pelajaran->name,
                "score" => $score
            ]);
            array_push($result_ids, $mata_pelajaran->id);
        }

        $next_api = [
            "name" => "bab",
            "param" => "mapel_id",
        ];

        $kelas = Kelas::find($kelas_id);
        $data = [
            "level" => "mapel",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "kelas_id" => $kelas_id,
            "graphic_title" => $kelas->tingkat->jenjang->name . " " . $kelas->tingkat->name . $kelas->name
        ];

        $this->setCurrentDashboard($data['level'], 'kelas_id', $kelas_id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getDataBab(Request $request)
    {
        $mapel_id = 0;
        $kelas_id = 0;

        if($request->mapel_id){
            $mapel_id = $request->mapel_id;
        }

        if($request->kelas_id){
            $kelas_id = $request->kelas_id;
        }

        if($request->mapel_id_kelas_id){
            $params = explode("/", $request->mapel_id_kelas_id);
            $mapel_id = $params[0];
            $kelas_id = $params[1];
        }

        $activeRole = Session::get('activeRole');
        if($activeRole == "Guru Mata Pelajaran" && !$request->mapel_id_kelas_id){
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $guru_mapels = GuruMataPelajaran::where([
                'guru_id' => $guru->id
            ])->first();

            if($guru_mapels){
                $mapel_id = $guru_mapels->mata_pelajaran_id;
                $kelas_id = $guru_mapels->kelas_id;
            }
        }

        $result = [];
        $result_ids = [];

        $query_filter_tahun_ajaran = '';
        $tahun_ajaran = Session::get('dshTahunAjaran');
        if ($tahun_ajaran != ''){
            $query_filter_tahun_ajaran = " and ks.tahun_ajaran = '" . $tahun_ajaran . "' ";
        }

        $babs = Modul::where(['deleted_at' => NULL, 'mata_pelajaran_id' => $mapel_id, 'is_subbab' => false])->orderBy('urutan')->get();

        $result_from_db = DB::select("select bab_id, bab_name, tingkat_kesulitan, sum(total_benar) as total_benar from (
        select b.id as bab_id, b.name as bab_name, e.paket_soal_id as paket_soal_id, ps.tingkat_kesulitan, e.total_benar from moduls b
        join mata_pelajarans mp on b.mata_pelajaran_id = mp.id
        join paket_soals ps on mp.id = ps.mata_pelajaran_id and ps.bab_id = b.id
        join e_raport e on ps.id = e.paket_soal_id
        join external_users eu on e.user_id = eu.id
        join kelas_siswas ks on eu.id = ks.siswa_id and ks.kelas_id = ? ". $query_filter_tahun_ajaran . "
        where eu.deleted_at is null and b.deleted_at is null and ps.deleted_at is null and mp.id = ?) grouped
        group by bab_id, tingkat_kesulitan", array($kelas_id, $mapel_id));

        $count_scores = [];
        foreach($result_from_db as $item){
            if(!array_key_exists($item->bab_id, $count_scores)){
                $count_scores[$item->bab_id] = 0;
            }

            $count_scores[$item->bab_id] += $this->getScoreFinal($item->total_benar, $item->tingkat_kesulitan);
        }

        foreach($babs as $bab){
            $score = 0;
            if(array_key_exists($bab->id, $count_scores)){
                $score = $count_scores[$bab->id];
            }
            array_push($result, [
                "label" => $bab->name,
                "score" => $score
            ]);
            array_push($result_ids, $bab->id);
        }

        $next_api = [
            "name" => "subbab",
            "param" => "bab_id",
        ];

        $kelas = Kelas::find($kelas_id);
        $mapel = MataPelajaran::find($mapel_id);
        $data = [
            "level" => "bab",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "kelas_id" => $kelas->id,
            "mapel_id" => $mapel->id,
            "graphic_title" => $kelas->tingkat->jenjang->name . " " . $kelas->tingkat->name . $kelas->name . " / " . $mapel->name
        ];

        $this->setCurrentDashboard($data['level'], 'mapel_id', $mapel_id, 'kelas_id', $kelas_id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getDataSubbab(Request $request)
    {
        $bab_id = 0;
        $kelas_id = 0;

        if($request->bab_id){
            $bab_id = $request->bab_id;
        }

        if($request->kelas_id){
            $kelas_id = $request->kelas_id;
        }

        $result = [];
        $result_ids = [];
        
        $query_filter_tahun_ajaran = '';
        $tahun_ajaran = Session::get('dshTahunAjaran');
        if ($tahun_ajaran != ''){
            $query_filter_tahun_ajaran = " and ks.tahun_ajaran = '" . $tahun_ajaran . "' ";
        }

        $subbab_ids = PaketSoal::where(['deleted_at' => NULL, 'bab_id' => $bab_id])->distinct()->pluck('subbab')->toArray();

        $result_from_db = DB::select("select subbab_id, subbab_name, tingkat_kesulitan, sum(total_benar) as total_benar from (
        select ps.subbab subbab_id, ps.judul_subbab as subbab_name, e.paket_soal_id as paket_soal_id, ps.tingkat_kesulitan, e.total_benar from paket_soals ps
        join e_raport e on ps.id = e.paket_soal_id
        join external_users eu on e.user_id = eu.id
        join kelas_siswas ks on eu.id = ks.siswa_id and ks.kelas_id = ? ". $query_filter_tahun_ajaran . "
        where eu.deleted_at is null and ps.deleted_at is null and ps.deleted_at is null and ps.bab_id = ?) grouped
        group by subbab_id, tingkat_kesulitan", array($kelas_id, $bab_id));

        $count_scores = [];
        foreach($result_from_db as $item){
            if(!array_key_exists($item->subbab_id, $count_scores)){
                $count_scores[$item->subbab_id] = 0;
            }

            $count_scores[$item->subbab_id] += $this->getScoreFinal($item->total_benar, $item->tingkat_kesulitan);
        }

        foreach($subbab_ids as $subbab_id){
            $score = 0;
            if(array_key_exists($subbab_id, $count_scores)){
                $score = $count_scores[$subbab_id];
            }

            $subbab = PaketSoal::where(['subbab' => $subbab_id, 'bab_id' => $bab_id, 'deleted_at' => NULL])->first();
            array_push($result, [
                "label" => $subbab->judul_subbab,
                "score" => $score
            ]);
            array_push($result_ids, $subbab_id);
        }

        $next_api = [
            "name" => "siswa",
            "param" => "subbab_number",
        ];

        $kelas = Kelas::find($kelas_id);
        $bab = Modul::find($bab_id);
        $data = [
            "level" => "subbab",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "kelas_id" => $kelas_id,
            "bab_id" => $bab_id,
            "graphic_title" => $kelas->tingkat->jenjang->name . " " . $kelas->tingkat->name . $kelas->name . " / " . $bab->mataPelajaran->name . " " . $bab->name
        ];

        $this->setCurrentDashboard($data['level'], 'bab_id', $bab_id, 'kelas_id', $kelas_id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getDataSiswa(Request $request)
    {
        $bab_id = 0;
        $subbab_number = 0;
        $kelas_id = 0;

        if($request->bab_id){
            $bab_id = $request->bab_id;
        }

        if($request->subbab_number){
            $subbab_number = $request->subbab_number;
        }

        if($request->kelas_id){
            $kelas_id = $request->kelas_id;
        }

        $result = [];
        $result_ids = [];
        
        $query_filter_tahun_ajaran = '';
        $tahun_ajaran = Session::get('dshTahunAjaran');
        if ($tahun_ajaran != ''){
            $query_filter_tahun_ajaran = " and ks.tahun_ajaran = '" . $tahun_ajaran . "' ";
        }
        
        $siswas = ExternalUser::where(['deleted_at' => NULL])
            ->whereHas('classHistory', function($query2) use ($kelas_id, $tahun_ajaran){
                $query2->where('kelas_id', $kelas_id)->where('tahun_ajaran', 'LIKE', '%'. $tahun_ajaran. '%');
            })->get();

        $result_from_db = DB::select("select user_id, user_name, tingkat_kesulitan, sum(total_benar) as total_benar, sum(total_terjawab) as total_terjawab from (
        select eu.id user_id, eu.name as user_name, e.paket_soal_id as paket_soal_id, ps.tingkat_kesulitan, e.total_benar, e.total_terjawab from paket_soals ps
        join e_raport e on ps.id = e.paket_soal_id
        join external_users eu on e.user_id = eu.id
        join kelas_siswas ks on eu.id = ks.siswa_id and ks.kelas_id = ? ". $query_filter_tahun_ajaran . "
        where eu.deleted_at is null and ps.deleted_at is null and ps.deleted_at is null and ps.bab_id = ? and ps.subbab = ?) grouped
        group by user_id, tingkat_kesulitan", array($kelas_id, $bab_id, $subbab_number));

        // dd($result_from_db);
        $count_scores = [];
        $count_score_splits = [];
        $count_terjawab_splits = [];
        foreach($result_from_db as $item){
            if(!array_key_exists($item->user_id, $count_scores)){
                $count_scores[$item->user_id] = 0;
                $count_score_splits[$item->user_id] = [
                    "mudah" => 0,
                    "sedang" => 0,
                    "sulit" => 0,
                ];
                $count_terjawab_splits[$item->user_id] = [
                    "mudah" => 0,
                    "sedang" => 0,
                    "sulit" => 0,
                ];
            }

            // $count_scores[$item->user_id] += $this->getScoreFinal($item->total_benar, $item->tingkat_kesulitan);
            $count_scores[$item->user_id] += $item->total_benar;
            // $count_score_splits[$item->user_id][$item->tingkat_kesulitan] += $this->getScoreFinal($item->total_benar, $item->tingkat_kesulitan);
            $count_score_splits[$item->user_id][$item->tingkat_kesulitan] += $item->total_benar;
            $count_terjawab_splits[$item->user_id][$item->tingkat_kesulitan] += $item->total_terjawab;
        }

        foreach($siswas as $siswa){
            $score = 0;
            $score_split = [
                "mudah" => 0,
                "sedang" => 0,
                "sulit" => 0,
            ];
            $percentage_split = [
                "mudah" => 0,
                "sedang" => 0,
                "sulit" => 0,
            ];
            $terjawab_split = [
                "mudah" => 0,
                "sedang" => 0,
                "sulit" => 0,
            ];
            if(array_key_exists($siswa->id, $count_scores)){
                $score = $count_scores[$siswa->id];

                if(array_key_exists($siswa->id, $count_score_splits)){
                    $score_split = $count_score_splits[$siswa->id];
                    $terjawab_split = $count_terjawab_splits[$siswa->id];

                    $percentage_split = [
                        "mudah" => $score_split["mudah"] === 0 ? 0 : number_format(($score_split["mudah"] / $terjawab_split["mudah"]) * 100, 0),
                        "sedang" => $score_split["sedang"] === 0 ? 0 : number_format(($score_split["sedang"] / $terjawab_split["sedang"]) * 100, 0),
                        "sulit" => $score_split["sulit"] === 0 ? 0 : number_format(($score_split["sulit"] / $terjawab_split["sulit"]) * 100, 0),
                    ];
                }
            }

            array_push($result, [
                "label" => $siswa->name,
                "score" => $score,
                "score_split" => $score_split,
                "terjawab_split" => $terjawab_split,
                "percentage_split" => $percentage_split,
            ]);
            array_push($result_ids, $siswa->id);
        }

        $next_api = [
            "name" => "",
            "param" => "",
        ];

        $kelas = Kelas::find($kelas_id);
        $bab = Modul::find($bab_id);
        $subbab = PaketSoal::where(['subbab' => $subbab_number, 'bab_id' => $bab_id, 'deleted_at' => NULL])->first();

        $data = [
            "level" => "siswa",
            "data" => [$result],
            "data_id" => $result_ids,
            "next_api" => $next_api,
            "kelas_id" => $kelas_id,
            "mapel_id" => $bab->mata_pelajaran_id,
            "graphic_title" => $kelas->tingkat->jenjang->name . " " . $kelas->tingkat->name . $kelas->name . " / " . $bab->mataPelajaran->name . " " . $bab->name . " " . @$subbab->judul_subbab
        ];

        $this->setCurrentDashboard($data['level'], 'bab_id', $bab_id, 'kelas_id', $kelas_id, 'subbab_number', $subbab_number);

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function getCurrentDashboard(Request $request)
    {
        $data = [
            'level' => Session::get('dshLevel'),
            'param' => Session::get('dshParam'),
            'value' => Session::get('dshValue'),
            'param2nd' => Session::get('dsh2ndParam'),
            'value2nd' => Session::get('dsh2ndValue'),
            'param3rd' => Session::get('dsh3rdParam'),
            'value3rd' => Session::get('dsh3rdValue'),
        ];

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function setCurrentDashboard($level, $param, $value, $param2nd = null, $value2nd = null, $param3rd = null, $value3rd = null)
    {
        Session::put('dshLevel', $level);
        Session::put('dshParam', $param);
        Session::put('dshValue', $value);
        Session::put('dsh2ndParam', $param2nd);
        Session::put('dsh2ndValue', $value2nd);
        Session::put('dsh3rdParam', $param3rd);
        Session::put('dsh3rdValue', $value3rd);
    }

    public function filterLevel(Request $request)
    {
        $data = [
            [
                'option' => 'jenjang',
                'next_api' => [
                    'name' => 'tingkat',
                    'param' => 'jenjang_id'
                ]
            ],
            [
                'option' => 'tingkat',
                'next_api' => [
                    'name' => 'kelas',
                    'param' => 'tingkat_id'
                ]
            ],
            [
                'option' => 'kelas',
                'next_api' => [
                    'name' => 'mapel',
                    'param' => 'kelas_id'
                ]
            ],
            [
                'option' => 'mapel',
                'next_api' => [
                    'name' => 'bab',
                    'param' => 'mapel_id'
                ]
            ],
            [
                'option' => 'bab',
                'next_api' => [
                    'name' => 'subbab',
                    'param' => 'bab_id'
                ]
            ],
            [
                'option' => 'subbab',
                'next_api' => [
                    'name' => 'siswa',
                    'param' => 'subbab_number'
                ]
            ]
        ];

        $activeRole = Session::get('activeRole');
        if($activeRole == "Guru Mata Pelajaran"){
            $data = [
                [
                    'option' => 'mengajar',
                    'next_api' => [
                        'name' => 'bab',
                        'param' => 'mapel_id_kelas_id'
                    ]
                ],
                [
                    'option' => 'bab',
                    'next_api' => [
                        'name' => 'subbab',
                        'param' => 'bab_id'
                    ]
                ],
                [
                    'option' => 'subbab',
                    'next_api' => [
                        'name' => 'siswa',
                        'param' => 'subbab_number'
                    ]
                ]
            ];
        }

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function filterTingkat(Request $request)
    {
        $tingkats = Tingkat::query();

        if($request->jenjang_id){
            $tingkats = $tingkats->where(['jenjang_id' => $request->jenjang_id]);
        }

        $activeRole = Session::get('activeRole');
        if($activeRole == "Kepala Sekolah"){
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $jenjang_kepsek = Jenjang::where(['kepala_sekolah_id' => $guru->id])->first();

            if($jenjang_kepsek){
                $tingkats = $tingkats->where(['jenjang_id' => $jenjang_kepsek->id]);
            }
        }

        $data = $tingkats->where(['deleted_at' => NULL])->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function filterKelas(Request $request)
    {
        $classes = Kelas::query();

        if($request->tingkat_id){
            $classes = $classes->where(['tingkat_id' => $request->tingkat_id]);
        }

        $data = $classes->where(['deleted_at' => NULL])->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function filterMapel(Request $request)
    {
        $mapel = MataPelajaran::query();

        if($request->kelas_id){
            $kelas = Kelas::find($request->kelas_id);
            $mapel = $mapel->where(['tingkat_id' => $kelas->tingkat_id]);
        }

        $activeRole = Session::get('activeRole');
        if($activeRole == "Wali Kelas"){
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            $kelas_guru = Kelas::where(['wali_kelas_id' => $guru->id])->first();

            if($kelas_guru){
                $mapel = $mapel->where(['tingkat_id' => $kelas_guru->tingkat_id]);
            }
        }

        $data = $mapel->where(['deleted_at' => NULL])->orderBy('urutan')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function filterBab(Request $request)
    {
        $bab = Modul::query();

        if($request->mapel_id){
            $bab = $bab->where(['mata_pelajaran_id' => $request->mapel_id]);
        }

        if($request->mapel_id_kelas_id){
            $params = explode("/", $request->mapel_id_kelas_id);
            $bab = $bab->where(['mata_pelajaran_id' => $params[0]]);
        }

        $data = $bab->where(['deleted_at' => NULL])->orderBy('urutan')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function filterSubbab(Request $request)
    {
        $subbab = PaketSoal::query();

        if($request->bab_id){
            $subbab = $subbab->where(['bab_id' => $request->bab_id]);
        }

        $data = $subbab->where(['deleted_at' => NULL])->select(['subbab AS id', 'judul_subbab AS name'])->distinct()->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function filterMengajar(Request $request)
    {
        $data = [];
        $guru_mapels = GuruMataPelajaran::query();

        $activeRole = Session::get('activeRole');
        if($activeRole == "Guru Mata Pelajaran"){
            $guru = ExternalUser::where(['email' => Auth::user()->email])->first();
            if($guru){
                $guru_mapels = $guru_mapels->where([
                    'guru_id' => $guru->id
                ]);
            }
        }

        $list_data = $guru_mapels->get();
        $first_data = $guru_mapels->first();
        foreach($list_data as $item){
            array_push($data, [
                'id' => $item->mataPelajaran->id . "/" . $item->kelas->id,
                'name' => $item->mataPelajaran->name . " (" . $item->mataPelajaran->tingkat->name . $item->kelas->name . ")",
            ]);
        }

        return response()->json(['message' => 'success', 'data' => $data, 'kelas_id' => $first_data->kelas_id, 'mapel_id' => $first_data->mata_pelajaran_id]);
    }

    public function filterTahunAjaran(Request $request)
    {
        $data = KelasSiswa::where('tahun_ajaran', 'LIKE', '%-%')->distinct()->orderBy('tahun_ajaran')->get(['tahun_ajaran AS val', 'tahun_ajaran AS name'])->unique('name');

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function setTahunAjaran(Request $request)
    {
        $tahun_ajaran = '';
        if($request->tahun_ajaran){
            $tahun_ajaran = $request->tahun_ajaran;
        }

        Session::put('dshTahunAjaran', $tahun_ajaran);

        return response()->json(['message' => 'success', 'data' => $tahun_ajaran]);
    }
}
