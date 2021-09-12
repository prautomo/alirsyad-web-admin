<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class SubCategory extends Model
{
    use HasFactory, SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'class',
        'category_id',
        'slug',
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "name" => "LIKE",
            "category_id" => "=",
            "slug" => "=",
        ]);

        return $data;
    }

    public function category()
    {
        return $this->belongsTo("App\Models\Category", "category_id", "id")->withTrashed();
    }

    public static function getAllSubCategory()
    {
        return  self::get();
    }
}
