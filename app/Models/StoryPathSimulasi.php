<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SearchableTrait;

class StoryPathSimulasi extends Model
{
    use HasFactory, SearchableTrait;

    protected $fillable = [
        "story_path_id",
        "simulasi_id",
        "order",
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "simulasi_id" => "=",
            "story_path_id" => "=",
        ]);

        return $data;
    }

    public function simulasi()
    {
        return $this->belongsTo("App\Models\Simulasi",  "simulasi_id", "id");
    }

    public function storyPath()
    {
        return $this->belongsTo("App\Models\StoryPath",  "story_path_id", "id");
    }
}