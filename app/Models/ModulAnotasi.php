<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulAnotasi extends Model
{

    protected $table = "moduls_anotasi";
    protected $fillable = [
        'modul_id', 'user_id', 'pdf_path'
    ];
}
