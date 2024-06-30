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
use Illuminate\Database\Eloquent\SoftDeletes;

class ExternalUser extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable, SearchableTrait, HasRoles;

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
        'is_pengunjung',
        'jenjang_id',
        'is_uploader',
        'uuid'
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
            "jenjang_id" => "=",
            "is_uploader" => "=",
        ]);

        return $data;
    }

    public function kelas()
    {
        return $this->belongsTo("App\Models\Kelas",  "kelas_id", "id")->withTrashed();
    }

    public function jenjang()
    {
        return $this->belongsTo("App\Models\Jenjang",  "jenjang_id", "id")->withTrashed();
    }

    public function historyModul()
    {
        return $this->hasMany("App\Models\HistoryModul", "siswa_id", "id");
    }

    public function historyVideo()
    {
        return $this->hasMany("App\Models\HistoryVideo", "siswa_id", "id");
    }

    public function historySimulasi()
    {
        return $this->hasMany("App\Models\HistorySimulasi", "siswa_id", "id");
    }

    /**
     * The mapels that belong to the gurus.
     */
    public function mataPelajarans()
    {
        return $this->belongsToMany('App\Models\MataPelajaran', 'guru_mata_pelajarans', 'guru_id', 'mata_pelajaran_id');
    }
    
    /**
     * The mapels (with kelas) that belong to the gurus.
     */
    public function mataPelajaranKelas()
    {
        return $this->hasMany('App\Models\GuruMataPelajaran', 'guru_id', 'id');
    }

    /**
     * The mapels that belong to the guests.
     */
    public function mataPelajaranGuests()
    {
        return $this->belongsToMany('App\Models\MataPelajaran', 'guest_mata_pelajarans', 'guest_id', 'mata_pelajaran_id');
    }

    /**
     * The kelas history that has siswa
     */
    public function classHistory()
    {
        return $this->hasMany('App\Models\KelasSiswa', "siswa_id", "id");
    }

    public function AauthAcessToken(){
        return $this->hasMany('App\Models\OauthAccessToken', "user_id", "id");
    }
}
