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
        "tingkat_id", 'name', 'description', 'status', 'logo'
    ];

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

    public function mataPelajaran()
    {
        return $this->hasMany("App\Models\MataPelajaran", "kelas_id", "id");
    }

    // Get all Mata Pelajaran
    public static function getAllMataPelajaran()
    {
        return  self::with(['mataPelajaran'])->limit(10)->get();
    }
}