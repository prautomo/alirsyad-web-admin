<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class Simulasi extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['played', 'rata_rata_score', 'bintang_score', 'simulasi_url', 'slug_url', 'cover_url', 'last_score', 'first_score', 'next', 'previous', 'disabled' ];

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
        return is_object(HistorySimulasi::where(['siswa_id' => \Auth::user()->id, 'simulasi_id' => $this->id])->first());
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
        $scores = $this->scores->where('siswa_id', \Auth::user()->id);
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

    private function avgScore()
    {
        $scores = $this->scores->where('siswa_id', \Auth::user()->id);
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

        return ($totalScore === 0 || $scores === 0) ? 0 : $totalScore/(count($scores) < 10 ? count($scores) : 10);
    }

    public function getRataRataScoreAttribute()
    {
        return $this->avgScore();
    }

    public function getLastScoreAttribute()
    {
        return $this->scores->where('siswa_id', \Auth::user()->id)->sortByDesc('created_at')->first();
    }

    public function getFirstScoreAttribute()
    {
        return $this->scores->where('siswa_id', \Auth::user()->id)->sortBy('created_at')->first();
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
        return $this->hasMany("App\Models\Score", "simulasi_id", "id")->withTrashed();
    }
}
