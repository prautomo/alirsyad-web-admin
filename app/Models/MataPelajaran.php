<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class MataPelajaran extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['disabled'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
        'slug',
        'tingkat_id',
        'urutan',
    ];

    protected static function boot(){
        parent::boot();

        // Order by urutan ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('urutan', 'asc');
        });
    }

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "slug" => "=",
            "tingkat_id" => "=",
            "urutan" => "=",
        ]);

        return $data;
    }

    public function tingkat()
    {
        return $this->belongsTo("App\Models\Tingkat",  "tingkat_id", "id")->withTrashed();
    }

    // /**
    //  * Guru Pengajar (Mata Pelajaran)
    //  */
    // public function guru()
    // {
    //     return $this->hasMany("App\Models\User", "mata_pelajaran_id", "id");
    // }

    /**
     * Modul
     */
    public function modul()
    {
        return $this->hasMany("App\Models\Modul", "mata_pelajaran_id", "id")->withTrashed();
    }

    /**
     * Simulasi
     */
    public function simulasi()
    {
        return $this->hasMany("App\Models\Simulasi", "mata_pelajaran_id", "id")->withTrashed();
    }

    /**
     * Video
     */
    public function video()
    {
        return $this->hasMany("App\Models\Video", "mata_pelajaran_id", "id")->withTrashed();
    }

    /**
     * The gurus that belong to the mapel.
     */
    public function gurus()
    {
        return $this->belongsToMany('App\Models\ExternalUser', 'guru_mata_pelajarans', 'mata_pelajaran_id' , 'guru_id');
    }

    /**
     * The guests that belong to the mapel.
     */
    public function guests()
    {
        return $this->belongsToMany('App\Models\ExternalUser', 'guest_mata_pelajarans', 'mata_pelajaran_id' , 'guest_id');
    }

    //
    public function getDisabledAttribute()
    {
        // $user = @\Auth::user();

        // if($user->is_pengunjung){
        //     $mapelGuest = GuestMataPelajaran::where(['guest_id'=> @$user->id, 'mata_pelajaran_id' => @$this->id])->first();
        //     return @$mapelGuest->mata_pelajaran_id ? false : true;
        // }

        // return @$this->tingkat->name > @$user->kelas->tingkat->name;

        return false;
    }
}
