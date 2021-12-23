<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SearchableTrait;

class Update extends Model
{
    use HasFactory, SearchableTrait;

    protected $fillable = [
        'trigger_event', 'trigger', 'trigger_id', 'trigger_name', 'mata_pelajaran', 
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
}