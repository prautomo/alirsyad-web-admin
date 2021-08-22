<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SearchableTrait;

class Kelas extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $fillable = [
        "tingkat_id", 'name', 'description', 'status', 'logo', 'wali_kelas_id'
    ];

    /**
     * Holds the methods names of Eloquent Relations
     * to fall on delete cascade or on restoring
     * 
     * @var array
     */
    protected static $relations_to_cascade = ['mataPelajaran', 'externalUser']; 

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
            "id" => "=",
            "tingkat_id" => "=",
            "status" => "=",
        ]);

        return $data;
    }

    public function tingkat()
    {
        return $this->belongsTo("App\Models\Tingkat",  "tingkat_id", "id");
    }

    public function waliKelas()
    {
        return $this->belongsTo("App\Models\User",  "wali_kelas_id", "id");
    }

    public function mataPelajaran()
    {
        return $this->hasMany("App\Models\MataPelajaran", "kelas_id", "id");
    }

    public function externalUser()
    {
        return $this->hasMany("App\Models\ExternalUser", "kelas_id", "id");
    }

    // Get all Mata Pelajaran
    public static function getAllMataPelajaran()
    {
        return  self::with(['mataPelajaran'])->limit(10)->get();
    }
}