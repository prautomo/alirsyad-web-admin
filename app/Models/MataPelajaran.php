<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class MataPelajaran extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['disabled'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
        'slug',
        'kelas_id',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "slug" => "=",
            "kelas_id" => "=",
        ]);

        return $data;
    }

    public function kelas()
    {
        return $this->belongsTo("App\Models\Kelas",  "kelas_id", "id");
    }

    /**
     * Guru Pengajar (Mata Pelajaran)
     */
    public function guru()
    {
        return $this->hasMany("App\Models\User", "mata_pelajaran_id", "id");
    }

    /**
     * Modul
     */
    public function modul()
    {
        return $this->hasMany("App\Models\Modul", "mata_pelajaran_id", "id");
    }

    /**
     * Simulasi
     */
    public function simulasi()
    {
        return $this->hasMany("App\Models\Simulasi", "mata_pelajaran_id", "id");
    }

    /**
     * Video
     */
    public function video()
    {
        return $this->hasMany("App\Models\Video", "mata_pelajaran_id", "id");
    }

    // 
    public function getDisabledAttribute()
    {
        return $this->kelas_id !== \Auth::user()->kelas_id;
    }
}
