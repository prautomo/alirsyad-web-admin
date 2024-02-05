<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;

    protected $table = 'kelas_siswas';
    protected $fillable = [
        'siswa_id', 'kelas_id', 'tahun_ajaran', 'is_current'
    ];

    public function siswa()
    {
        return $this->belongsTo("App\Models\ExternalUser", "siswa_id", "id")->withTrashed();
    }

    public function kelas()
    {
        return $this->belongsTo("App\Models\Kelas", "kelas_id", "id")->withTrashed();
    }
}
