<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ExternalUser;
use App\Models\JasaDetail;
use App\Models\MitraDetail;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ArticleController extends Controller
{
    public function read(Request $request , $slug)
    {
        $article = Article::where("slug" ,  $slug)->firstOrFail();
        # code...

        return view("app.Screen.article.read", [
            "article" => $article,
            "articles" => Article::getActiveArticle()
        ]);
    }
    

}
