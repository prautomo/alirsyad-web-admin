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
        'name', 'description', 'status', 'logo', 'uploader_id', 'use_story_path', 'order',
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
            "uploader_id" => "=",
        ]);

        return $data;
    }

    public function uploader()
    {
        return $this->belongsTo("App\Models\User",  "uploader_id", "id");
    }

    public function kelas()
    {
        return $this->hasMany("App\Models\Kelas", "tingkat_id", "id");
    }
}