<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SearchableTrait;

class Tingkat extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $fillable = [
        'name', 'description', 'status', 'logo', 'jenjang_id', 'use_story_path', 
    ];

    /**
     * Holds the methods names of Eloquent Relations
     * to fall on delete cascade or on restoring
     * 
     * @var array
     */
    protected static $relations_to_cascade = ['kelas']; 

    /**
     * Cascade delete and restore
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function($resource) {
            foreach (static::$relations_to_cascade as $relation) {
                foreach ($resource->{$relation}()->get() as $item) {
                    $item->delete();
                }
            }
        });

        static::restoring(function($resource) {
            foreach (static::$relations_to_cascade as $relation) {
                foreach ($resource->{$relation}()->get() as $item) {
                    $item->withTrashed()->restore();
                }
            }
        });
    }

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "description" => "LIKE",
            "status" => "=",
            "jenjang_id" => "=",
            "use_story_path" => "=",
        ]);

        return $data;
    }

    public function jenjang()
    {
        return $this->belongsTo("App\Models\Jenjang",  "jenjang_id", "id")->withTrashed();
    }

    public function kelas()
    {
        return $this->hasMany("App\Models\Kelas", "tingkat_id", "id")->withTrashed();
    }

    public function mataPelajaran()
    {
        return $this->hasMany("App\Models\MataPelajaran", "tingkat_id", "id")->withTrashed();
    }
}