<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;
use App\Observers\ModulObserver;
use Illuminate\Support\Facades\Auth;

class Modul extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    protected $appends = ['read', 'pdf_url', 'next', 'previous', 'pdf_viewer'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pdf_path',
        'description',
        'icon',
        'mata_pelajaran_id',
        'uploader_id',
        'slug',
        'semester',
        'tahun_ajaran',
        'urutan',
        'is_visible',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "id" => "=",
            "name" => "LIKE",
            "description" => "LIKE",
            "mata_pelajaran_id" => "=",
            "uploader_id" => "=",
            "slug" => "=",
            "semester" => "=",
            "tahun_ajaran" => "=",
            "urutan" => "=",
        ]);

        return $data;
    }

    /**
     * Cascade update
     */
    protected static function boot() {
        parent::boot();

        // Modul::observe(ModulObserver::class);
    }

    public function getReadAttribute()
    {
        $paramSiswaId = @\Request::get('q_siswa_id') ?? \Auth::user()->id;
        return is_object(HistoryModul::where(['siswa_id' => $paramSiswaId, 'modul_id' => $this->id])->first());
    }

    public function getPDFUrlAttribute()
    {
        return asset($this->pdf_path);
    }

    public function getPDFViewerAttribute()
    {
        $modulAnotasi = ModulAnotasi::where(['user_id' => Auth::user()->id, 'modul_id' => $this->id])->orderBy('updated_at', 'desc')->first();
        $pdfPath = @$modulAnotasi->pdf_path ?? $this->pdf_path;

        return asset('pdf.html')."?url=".asset($pdfPath).
                "&user_id=".Auth::user()->id.
                "&modul_id=".$this->id.
                "&pdf_path=".$pdfPath;
    }

    public function getNextAttribute(){
        // get next modul
        $nextModul = $this
            ->where('urutan', '>', $this->urutan)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('urutan','asc')->first();

        $returnNext = null;

        if($nextModul){
            $returnNext = [
                'id' => @$nextModul->id,
                'name' => @$nextModul->name,
                'slug_url' => route('app.modul.detail', @$nextModul->slug).".html",
                'url' => route('app.modul.detail', @$nextModul->id),
                'endpoint' => route('api.modul.detail', @$nextModul->id),
            ];
        }

        return $returnNext;
    }

    public function getPreviousAttribute(){
        // get previous modul
        $previousModul =  $this
            ->where('urutan', '<', $this->urutan)
            ->where('mata_pelajaran_id', $this->mata_pelajaran_id)
            ->orderBy('urutan','desc')->first();

        $returnPrevious = null;

        if($previousModul){
            $returnPrevious = [
                'id' => @$previousModul->id,
                'name' => @$previousModul->name,
                'url' => route('app.modul.detail', @$previousModul->id),
                'slug_url' => route('app.modul.detail', @$previousModul->slug).".html",
                'endpoint' => route('api.modul.detail', @$previousModul->id),
            ];
        }

        return $returnPrevious;
    }

    public function mataPelajaran()
    {
        return $this->belongsTo("App\Models\MataPelajaran",  "mata_pelajaran_id", "id")->withTrashed();
    }

    public function uploader()
    {
        return $this->belongsTo("App\Models\User",  "uploader_id", "id");
    }

    public function storyPath()
    {
        return $this->hasOne("App\Models\StoryPath", "modul_id", "id")->withTrashed();
    }

    public function videos()
    {
        return $this->hasMany("App\Models\Video", "modul_id", "id")->withTrashed();
    }

    public function simulasis()
    {
        return $this->hasMany("App\Models\Simulasi", "modul_id", "id")->withTrashed();
    }
    
    public function paket_soals()
    {
        return $this->hasMany("App\Models\PaketSoal", "bab_id", "id")->withTrashed();
    }
}
