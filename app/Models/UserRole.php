<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class UserRole extends Model
{
    use HasFactory, SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "user_id" => "=",
            "role_id" => "=",
        ]);

        return $data;
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User",  "user_id", "id")->withTrashed();
    }

    public function role()
    {
        return $this->belongsTo("App\Models\Role",  "role_id", "id")->withTrashed();
    }
}
