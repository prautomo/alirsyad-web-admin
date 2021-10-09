<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class HistoryModul extends Model
{
    use HasFactory, SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'siswa_id',
        'modul_id',
        'semester',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "modul_id" => "=",
            "siswa_id" => "=",
            "semester" => "=",
        ]);

        return $data;
    }

    public function modul()
    {
        return $this->belongsTo("App\Models\Modul",  "modul_id", "id")->withTrashed();
    }

    public function siswa()
    {
        return $this->belongsTo("App\Models\ExternalUser",  "siswa_id", "id")->withTrashed();
    }
}
