<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExternalUser;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('app/Screen/home');
    }

    public function getAllCategoryWithSubCategory(Request $request)
    {
        $mitras = Category::getAllCategory();
        return $mitras;
        # code...
    }
    public function getAllSubCategory()
    {
        $mitras = SubCategory::getAllSubCategory();
        return $mitras;
        # code...
    }

    public function getAllProducts(Request $request)
    {
        $data =  Product::getAllProducts($request);
        return $data;
        # code...
    }

    public function upload(Request $request)
    {
        $image_parts = explode(";base64,", $request->base_image);
        $image_type_aux = "image/png";
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $url = UploadService::uploadBaseImage($image_base64, 'images/materi');

        return [
            "image_url" => $url
        ];
        # code...
    }
}
