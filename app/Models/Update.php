<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SearchableTrait;

class Update extends Model
{
    use HasFactory, SearchableTrait;

    protected $fillable = [
        'trigger_event', 'trigger', 'trigger_id', 'trigger_name', 'mata_pelajaran', 'tingkat_id', 'mata_pelajaran_id',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "trigger_event" => "=",
            "trigger" => "LIKE",
            "trigger_id" => "=",
            "trigger_name" => "LIKE",
            "mata_pelajaran" => "LIKE",
            "tingkat_id" => "=",
        ]);

        return $data;
    }

    public function triggerRel()
    {
        if($this->trigger == 'video'){
            return $this->belongsTo("App\Models\Video",  "trigger_id", "id")->withTrashed();
        }else{
            return $this->belongsTo("App\Models\Modul",  "trigger_id", "id")->withTrashed();
        }
    }

    public function tingkat()
    {
        return $this->belongsTo("App\Models\Tingkat",  "tingkat_id", "id")->withTrashed();
    }

    public function mataPelajaran()
    {
        return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id")->withTrashed();
    }

    public function video()
    {
        return $this->belongsTo("App\Models\Video",  "trigger_id", "id")->withTrashed();
    }

    public function modul()
    {
        return $this->belongsTo("App\Models\Modul",  "trigger_id", "id")->withTrashed();
    }
}
