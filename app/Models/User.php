<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\SearchableTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable, HasRoles, SearchableTrait;

    protected $guard_name = 'backoffice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'mata_pelajaran_id',
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
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "email" => "=",
            "name" => "LIKE",
            "username" => "LIKE",
            "mata_pelajaran_id" => "=",
        ]);

        return $data;
    }

    public function uploaderJenjang()
    {
        return $this->hasOne("App\Models\Jenjang", "uploader_id", "id")->withTrashed();
    }

    // public function mataPelajaran()
    // {
    //     return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id")->withTrashed();
    // }

    /**
     * The mapels that belong to the gurus.
     */
    public function mataPelajarans()
    {
        return $this->belongsToMany('App\Models\MataPelajaran', 'uploader_mata_pelajarans', 'guru_uploader_id', 'mata_pelajaran_id');
    }
}
