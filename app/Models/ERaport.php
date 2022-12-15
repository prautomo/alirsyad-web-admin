<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ERaport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'e_raport';
    protected $fillable = [
        'user_id', 'paket_soal_id', 'total_terjawab', 'total_benar', 'list_id_soal_terjawab', 'list_id_soal_benar', 'tipe'
    ];

    public function external_user()
    {
        return $this->belongsTo("App\Models\ExternalUser",  "user_id", "id")->withTrashed();
    }

    public function paket_soal()
    {
        return $this->belongsTo("App\Models\PaketSoal",  "paket_soal_id", "id")->withTrashed();
    }
}
