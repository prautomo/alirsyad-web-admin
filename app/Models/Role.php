<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'guard_name', 'created_at', 'updated_at', 'key'
    ];

    public function userRoles()
    {
        return $this->hasMany("App\Models\UserRole",  "role_id", "id")->withTrashed();
    }
}
