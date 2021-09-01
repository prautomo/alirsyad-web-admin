<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class Modul extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['read'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pdf_path',
        'description',
        'icon',
        'mata_pelajaran_id',
        'uploader_id',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "description" => "LIKE",
            "mata_pelajaran_id" => "=",
            "uploader_id" => "=",
        ]);

        return $data;
    }

    public function getReadAttribute()
    {
        return is_object(HistoryModul::where(['siswa_id' => \Auth::user()->id, 'modul_id' => $this->id])->first());
    }

    public function mataPelajaran()
    {
        return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id");
    }

    public function uploader()
    {
        return $this->belongsTo("App\Models\User",  "uploader_id", "id");
    }
}
