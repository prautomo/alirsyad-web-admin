<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class Simulasi extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['played', 'rata_rata_score', 'bintang_score', 'simulasi_url', 'slug_url', 'cover_url', 'last_score', 'first_score', 'next', 'previous', 'next_level', 'previous_level', 'disabled', 'total_percobaan', '10_percobaan_terakhir_berhasil', '10_percobaan_terakhir_gagal'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path_simulasi',
        'description',
        'icon',
        'mata_pelajaran_id',
        'uploader_id',
        'slug',
        'semester',
        'urutan',
        'modul_id',
        'level',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "description" => "LIKE",
            "mata_pelajaran_id" => "=",
            "uploader_id" => "=",
            "slug" => "=",
            "semester" => "=",
            "urutan" => "=",
            "modul_id" => "=",
            "level" => "=",
        ]);

        return $data;
    }

    public function getDisabledAttribute(){
        $statusDisabled = true;
        $name = $this->name;
        $level = $this->level;

        if($level===1){
            $statusDisabled = false;
        }elseif($level > 1){
            // mundur satu level
            $level -= 1;
            // cek level sebelumnya
            $simulasiSebelumnya = $this->with('scores')->whereHas('scores', function($q){
                $q->where('siswa_id', @\Auth::user()->id ?? 0);
            })->where(["name"=>$name, "level"=>$level])->first();
            // cek punya score di level sebelumnya
            $scores = @$simulasiSebelumnya->scores ?? [];
            if(count($scores) > 1){
                $statusDisabled = false;
            }
        }

        return $statusDisabled;
    }

    public function getPlayedAttribute()
    {
        $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;
        return is_object(HistorySimulasi::where(['siswa_id' => $paramSiswaId, 'simulasi_id' => $this->id])->first());
    }

    public function getTotalPercobaanAttribute()
    {
        $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;
        return count(Score::where(['siswa_id' => $paramSiswaId, 'simulasi_id' => $this->id])->get());
    }

    public function getSimulasiUrlAttribute()
    {
        return asset($this->path_simulasi)."/index.html";
    }

    public function getSlugUrlAttribute()
    {
        return route('app.simulasi.detail', $this->slug).".html";
    }

    public function getCoverUrlAttribute()
    {
        return asset($this->icon);
    }

    public function getNextLevelAttribute(){
        // get next simulasi
        $nextSimulasi = $this
            ->where('urutan', '=', $this->urutan)
            ->where('level', '>', $this->level)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('urutan','asc')->first();

        $returnNext = null;

        if($nextSimulasi){
            $returnNext = [
                'id' => @$nextSimulasi->id,
                'name' => @$nextSimulasi->name,
                'url' => route('app.simulasi.detail', @$nextSimulasi->id),
                'endpoint' => route('api.simulasi.detail', @$nextSimulasi->id),
            ];
        }
        
        return $returnNext;
    }

    public function getPreviousLevelAttribute(){
        // get previous simulasi
        $previousSimulasi =  $this
            ->where('urutan', '=', $this->urutan)
            ->where('level', '<', $this->level)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('urutan','desc')->first();
        
        $returnPrevious = null;

        if($previousSimulasi){
            $returnPrevious = [
                'id' => @$previousSimulasi->id,
                'name' => @$previousSimulasi->name,
                'url' => route('app.simulasi.detail', @$previousSimulasi->id),
                'endpoint' => route('api.simulasi.detail', @$previousSimulasi->id),
            ];
        }
        
        return $returnPrevious;
    }

    public function getNextAttribute(){
        // get next simulasi
        $nextSimulasi = $this
            ->where('urutan', '>', $this->urutan)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('urutan','asc')->first();

        $returnNext = null;

        if($nextSimulasi){
            $returnNext = [
                'id' => @$nextSimulasi->id,
                'name' => @$nextSimulasi->name,
                'url' => route('app.simulasi.detail', @$nextSimulasi->id),
                'endpoint' => route('api.simulasi.detail', @$nextSimulasi->id),
            ];
        }
        
        return $returnNext;
    }

    public function getPreviousAttribute(){
        // get previous simulasi
        $previousSimulasi =  $this
            ->where('urutan', '<', $this->urutan)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('urutan','desc')->first();
        
        $returnPrevious = null;

        if($previousSimulasi){
            $returnPrevious = [
                'id' => @$previousSimulasi->id,
                'name' => @$previousSimulasi->name,
                'url' => route('app.simulasi.detail', @$previousSimulasi->id),
                'endpoint' => route('api.simulasi.detail', @$previousSimulasi->id),
            ];
        }
        
        return $returnPrevious;
    }

    private function avgScoreOld()
    {
        $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;
        $scores = $this->scores->where('siswa_id', $paramSiswaId);
        $bintang = 0;
        $totalScore = 0;
        // calculate average score
        $jumlahPercobaan = 0;
        foreach($scores as $score){
            $jumlahPercobaan += 1;
            // handle max percobaan sampe 10, yg ke 11 mh ga di itung
            if($jumlahPercobaan <= 10){
                $totalScore += @$score->score;
            }
        }

        return ($totalScore === 0 || $scores === 0) ? 0 : $totalScore/count($scores);
    }

    private function getAllPercobaan(){
        $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;
        $scores = $this->scores->where('siswa_id', $paramSiswaId);

        // data semua percobaan
        $percobaans = [];
        foreach($scores as $score){
            $percobaans[] = [
                'percobaan_ke' => @$score->percobaan_ke,
                'status' => (@$score->score ?? 0) < 50 ? 'salah' : 'benar',
            ];
        }

        return $percobaans;
    }

    public function get10PercobaanTerakhirBerhasilAttribute()
    {
        // get all percobaan
        $percobaans = $this->getAllPercobaan();

        // sort by percobaan ke ascending
        $percobaans = collect($percobaans)->sortBy('percobaan_ke');
        
        $percobaansBenar = $percobaans->where('status', 'benar')->all();
        
        // 10 percobaan terakhir
        $percobaanTerakhirs = $percobaans->take(-10);
        $percobaanTerakhirsBenar = $percobaanTerakhirs->where('status', 'benar')->all();
    
        return count(@$percobaanTerakhirsBenar ?? []);
    }

    public function get10PercobaanTerakhirGagalAttribute()
    {
        // get all percobaan
        $percobaans = $this->getAllPercobaan();

        // sort by percobaan ke ascending
        $percobaans = collect($percobaans)->sortBy('percobaan_ke');
        
        $percobaansBenar = $percobaans->where('status', 'salah')->all();
        
        // 10 percobaan terakhir
        $percobaanTerakhirs = $percobaans->take(-10);
        $percobaanTerakhirsBenar = $percobaanTerakhirs->where('status', 'salah')->all();
    
        return count(@$percobaanTerakhirsBenar ?? []);
    }

    private function avgScore()
    {
        $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;
        $scores = $this->scores->where('siswa_id', $paramSiswaId);
        $bintang = 0;
        $totalScore = 0;
        // sort percobaan yg baru
        $scores = $scores->sortByDesc('percobaan_ke');
        // calculate average score
        $jumlahPercobaan = 0;
        foreach($scores as $score){
            $jumlahPercobaan += 1;
            // ambil 10 percobaan terakhir
            if($jumlahPercobaan <= 10){
                $totalScore += @$score->score;
            }
        }

        return ($totalScore === 0 || $scores === 0) ? 0 : number_format($totalScore/(count($scores) < 10 ? count($scores) : 10), 2);
    }

    public function getRataRataScoreAttribute()
    {
        return $this->avgScore();
    }

    public function getLastScoreAttribute()
    {
        $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;
        return $this->scores->where('siswa_id', $paramSiswaId)->sortByDesc('created_at')->first();
    }

    public function getFirstScoreAttribute()
    {
        $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;
        return $this->scores->where('siswa_id', $paramSiswaId)->sortBy('created_at')->first();
    }

    public function getBintangScoreAttribute()
    {
        $avgScore = $this->avgScore();
        $bintang = 0;
        if($avgScore>=99){
            $bintang = 3;
        }else if($avgScore>=66){
            $bintang = 2;
        }else if($avgScore>=33){
            $bintang = 1;
        }

        return $bintang;
    }

    public function mataPelajaran()
    {
        return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id")->withTrashed();
    }

    public function modul()
    {
        return $this->belongsTo("App\Models\Modul",  "modul_id", "id")->withTrashed();
    }

    public function uploader()
    {
        return $this->belongsTo("App\Models\User",  "uploader_id", "id");
    }

    public function history()
    {
        return $this->hasMany("App\Models\HistorySimulasi", "simulasi_id", "id")->withTrashed();
    }

    public function scores()
    {
        if(@\Auth::user()->role==="SISWA" || (@\Auth::user()->is_pengunjung) ){
            $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;
        }else {
            $paramSiswaId = @\Request::get('q_siswa_id');
        }
        
        if($paramSiswaId){
            return $this->hasMany("App\Models\Score", "simulasi_id", "id")->withTrashed()->where(['siswa_id' => $paramSiswaId]);
        }
        return $this->hasMany("App\Models\Score", "simulasi_id", "id")->withTrashed();
    }
}
