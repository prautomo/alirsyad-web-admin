<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SearchableTrait;

class Jenjang extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $fillable = [
        'name', 'description', 'status', 'logo', 'uploader_id', 
    ];

    /**
     * Holds the methods names of Eloquent Relations
     * to fall on delete cascade or on restoring
     * 
     * @var array
     */
    // protected static $relations_to_cascade = ['tingkat']; 
    protected static $relations_to_cascade = []; 

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
        return $this->belongsTo("App\Models\User",  "uploader_id", "id")->withTrashed();
    }

    public function tingkat()
    {
        return $this->hasMany("App\Models\Tingkat", "jenjang_id", "id")->withTrashed();
    }
}