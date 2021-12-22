<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SearchableTrait;

class Banner extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $fillable = [
        'title', 'description', 'image', 'file', 'urutan', 'activeStatus', 
    ];

    public static function search($request)
    {
        $data =  self::where("id", "!=", null);
        $data = self::appendSearchQuery($data, $request, [
            "title" => "LIKE",
            "description" => "LIKE",
            "urutan" => "=",
            "activeStatus" => "=",
        ]);

        return $data;
    }
}