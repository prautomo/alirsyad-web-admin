<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;
use App\Models\HistoryVideo;

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
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "description" => "LIKE",
            "mata_pelajaran_id" => "=",
            "uploader_id" => "=",
            "semester" => "=",
        ]);

        return $data;
    }

    public function getNextAttribute(){
        // get next video
        $nextVideo = $this
            ->where('name', '>', $this->name)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('name','asc')->first();

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
            ->where('name', '<', $this->name)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('name', 'desc')->first();
        
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
        return is_object(HistoryVideo::where(['siswa_id' => \Auth::user()->id, 'video_id' => $this->id])->first());
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

    public function uploader()
    {
        return $this->belongsTo("App\Models\User",  "uploader_id", "id");
    }

    public function history()
    {
        return $this->hasMany("App\Models\HistoryVideo", "video_id", "id")->withTrashed();
    }
}
