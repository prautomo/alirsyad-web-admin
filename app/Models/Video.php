<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;
use App\Models\HistoryVideo;
use App\Observers\VideoObserver;

class Video extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['watched', 'youtubeId', 'next', 'previous'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'video_url',
        'description',
        'icon',
        'mata_pelajaran_id',
        'uploader_id',
        'semester',
        'urutan',
        'modul_id',
        'visible', // tampilkan video
        'is_visible', // visibilitas materi
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    protected static function boot(){
        parent::boot();

        // Video::observe(VideoObserver::class);
    }

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "description" => "LIKE",
            "mata_pelajaran_id" => "=",
            "uploader_id" => "=",
            "semester" => "=",
            "urutan" => "=",
            "modul_id" => "=",
        ]);

        return $data;
    }

    public function getNextAttribute(){
        // get next video
        $nextVideo = $this
            ->where('urutan', '>', $this->urutan)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('urutan','asc')->first();

        $returnNext = null;

        if($nextVideo){
            $returnNext = [
                'id' => @$nextVideo->id,
                'name' => @$nextVideo->name,
                'url' => route('app.video.detail', @$nextVideo->id),
                'endpoint' => route('api.video.detail', @$nextVideo->id),
            ];
        }

        return $returnNext;
    }

    public function getPreviousAttribute(){
        // get previous video
        $previousVideo =  $this
            ->where('urutan', '<', $this->urutan)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('urutan', 'desc')->first();

        $returnPrevious = null;

        if($previousVideo){
            $returnPrevious = [
                'id' => @$previousVideo->id,
                'name' => @$previousVideo->name,
                'url' => route('app.video.detail', @$previousVideo->id),
                'endpoint' => route('api.video.detail', @$previousVideo->id),
            ];
        }

        return $returnPrevious;
    }

    public function getWatchedAttribute()
    {
        $paramSiswaId = @\Request::get('q_siswa_id') ?? @\Auth::user()->id;

        return is_object(HistoryVideo::where(['siswa_id' => $paramSiswaId, 'video_id' => $this->id])->first());
    }

    public function getYoutubeIdAttribute()
    {
        $url = $this->video_url;

        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        return @$my_array_of_vars['v'];
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
        return $this->hasMany("App\Models\HistoryVideo", "video_id", "id")->withTrashed();
    }
}
