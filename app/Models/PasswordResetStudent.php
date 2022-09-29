<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_user_id', 'nis', 'status'
    ];


    public function externalUser()
    {
        return $this->belongsTo("App\Models\ExternalUser",  "external_user_id", "id")->withTrashed();
    }
}
