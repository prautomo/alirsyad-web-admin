<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchableTrait;

class Category extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
        'slug',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "slug" => "=",
        ]);

        return $data;
    }

    public function sub()
    {
        return $this->hasMany("App\Models\SubCategory", "category_id", "id");
    }

    // Get all Cateogory
    public static function getAllCategory()
    {
        return  self::with(['sub'])->limit(10)->get();
    }
}
