<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class Score extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "siswa_id",
        "simulasi_id",
        "score",
        "jenjang",
        "tingkat",
        "kelas",
        "semester",
        "pengajar_id",
        "nama_pengajar",
        "percobaan_ke",
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "nama_pengajar" => "LIKE",
            "jenjang" => "LIKE",
            "tingkat" => "LIKE",
            "kelas" => "LIKE",
            "siswa_id" => "=",
            "simulasi_id" => "=",
            "score" => "=",
            "pengajar_id" => "=",
        ]);

        return $data;
    }

    public function simulasi()
    {
        return $this->belongsTo("App\Models\Simulasi",  "simulasi_id", "id")->withTrashed();
    }

    public function siswa()
    {
        return $this->belongsTo("App\Models\ExternalUser",  "siswa_id", "id")->withTrashed();
    }

    public function pengajar()
    {
        return $this->hasOne("App\Models\ExternalUser", "pengajar_id", "id")->withTrashed();
    }
}