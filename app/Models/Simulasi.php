<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class Simulasi extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['played'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path_simulasi',
        'description',
        'icon',
        'mata_pelajaran_id',
        'uploader_id',
        'slug',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "description" => "LIKE",
            "mata_pelajaran_id" => "=",
            "uploader_id" => "=",
            "slug" => "=",
        ]);

        return $data;
    }

    public function getPlayedAttribute()
    {
        return is_object(HistorySimulasi::where(['siswa_id' => \Auth::user()->id, 'simulasi_id' => $this->id])->first());
    }

    public function mataPelajaran()
    {
        return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id");
    }

    public function uploader()
    {
        return $this->belongsTo("App\Models\User",  "uploader_id", "id");
    }

    public function history()
    {
        return $this->hasMany("App\Models\HistorySimulasi", "simulasi_id", "id");
    }
}
