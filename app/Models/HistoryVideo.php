<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class HistoryVideo extends Model
{
    use HasFactory, SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'siswa_id',
        'video_id',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "video_id" => "=",
            "siswa_id" => "=",
        ]);

        return $data;
    }

    public function video()
    {
        return $this->belongsTo("App\Models\Video",  "video_id", "id");
    }

    public function siswa()
    {
        return $this->belongsTo("App\Models\ExternalUser",  "siswa_id", "id");
    }
}
