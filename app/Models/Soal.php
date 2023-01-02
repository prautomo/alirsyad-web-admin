<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'paket_soal_id', 'soal', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'jawaban', 'sumber', 'link_pembahasan', 'pembahasan', 'creator_id', 'is_active'
    ];

    public function paket()
    {
        return $this->belongsTo("App\Models\PaketSoal",  "paket_soal_id", "id")->withTrashed();
    }
}
