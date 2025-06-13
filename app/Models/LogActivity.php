<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $table = 'log_activities';

    protected $fillable = [
        'action_type',
        'description',
        'actor_user_id',
        'actor_user_name',
        'actor_user_role',
        'before_change',
        'after_change',
        'change_fields',
        'source_name',
        'source_id',
    ];
}
