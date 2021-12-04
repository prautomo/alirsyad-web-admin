<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class UploaderMataPelajaran extends Model
{
    use HasFactory, SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guru_uploader_id',
        'mata_pelajaran_id',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "guru_uploader_id" => "=",
            "mata_pelajaran_id" => "=",
        ]);

        return $data;
    }

    public function guru()
    {
        return $this->belongsTo("App\Models\User",  "guru_uploader_id", "id")->withTrashed();
    }

    public function mataPelajaran()
    {
        return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id")->withTrashed();
    }
}