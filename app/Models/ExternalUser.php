<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\SearchableTrait;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class ExternalUser extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SearchableTrait, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'username',
        'phone',
        'phone_verified_at',
        'photo',
        'role',
        'address',
        'status',
        'nis',
        'rombongan_belajar',
        'kelas_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "email" => "=",
            "nis" => "=",
            "name" => "LIKE",
            "username" => "LIKE",
            "phone" => "LIKE",
            "role" => "=",
            "kelas_id" => "=",
        ]);

        return $data;
    }

    public function kelas()
    {
        return $this->belongsTo("App\Models\Kelas",  "kelas_id", "id");
    }

    public function historyVideo()
    {
        return $this->hasMany("App\Models\HistoryVideo", "siswa_id", "id");
    }

    public function historySimulasi()
    {
        return $this->hasMany("App\Models\HistorySimulasi", "siswa_id", "id");
    }
}
