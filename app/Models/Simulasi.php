<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class Simulasi extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['played', 'rata_rata_score', 'bintang_score', 'simulasi_url', 'slug_url', 'cover_url', 'last_score' ];

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
        ]);

        return $data;
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

    private function avgScore()
    {
        $scores = $this->scores->where('siswa_id', \Auth::user()->id);
        $bintang = 0;
        $totalScore = 0;
        // calculate average score
        foreach($scores as $score){
            $totalScore += @$score->score;
        }

        return ($totalScore === 0 || $scores === 0) ? 0 : $totalScore/count($scores);
    }

    public function getRataRataScoreAttribute()
    {
        return $this->avgScore();
    }

    public function getLastScoreAttribute()
    {
        return $this->scores->sortByDesc('created_at')->first();
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
