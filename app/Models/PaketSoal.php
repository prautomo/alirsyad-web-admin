<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'mata_pelajaran_id', 'bab_id', 'tingkat_kesulitan', 'subbab', 'judul_subbab', 'jumlah_publish', 'nilai_kkm'
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id")->withTrashed();
    }

    public function bab()
    {
        return $this->belongsTo("App\Models\Modul",  "bab_id", "id")->withTrashed();
    }
}
