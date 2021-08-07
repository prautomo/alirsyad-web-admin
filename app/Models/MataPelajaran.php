<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class MataPelajaran extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

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
        ]);

        return $data;
    }

    public function kelas()
    {
        return $this->belongsTo("App\Models\Kelas",  "kelas_id", "id");
    }
}
