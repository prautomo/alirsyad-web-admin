<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SearchableTrait;

class StoryPath extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $fillable = [
        "modul_id",
        "name",
        "template_path",
        "description",
        "uploader_id",
        'semester',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "description" => "LIKE",
            "id" => "=",
            "modul_id" => "=",
            "uploader_id" => "=",
            "semester" => "=",
        ]);

        return $data;
    }

    public function modul()
    {
        return $this->belongsTo("App\Models\Modul",  "modul_id", "id");
    }

    public function uploader()
    {
        return $this->belongsTo("App\Models\User",  "uploader_id", "id");
    }

    public function storyPathSimulasi()
    {
        return $this->hasMany("App\Models\StoryPathSimulasi", "story_path_id", "id");
    }
}