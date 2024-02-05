<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketSoal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mata_pelajaran_id', 'bab_id', 'tingkat_kesulitan', 'subbab', 'judul_subbab', 'jumlah_publish', 'nilai_kkm', 'is_visible'
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id")->withTrashed();
    }

    public function bab()
    {
        return $this->belongsTo("App\Models\Modul",  "bab_id", "id")->withTrashed();
    }

    public function soals()
    {
        return $this->hasMany("App\Models\Soal",  "paket_soal_id", "id");
    }
}
