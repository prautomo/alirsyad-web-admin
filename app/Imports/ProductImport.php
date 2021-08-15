<?php

namespace App\Imports;

use App\Models\ExternalUser;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Helpers\GenerateCode;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Helpers\GenerateSlug;

class ProductImport implements ToModel
{
    protected $mitraId;

    function __construct($mitraId) {
        $this->mitraId = $mitraId;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row[1])) {
            return null;
        }
        if (!is_numeric($row[2])) {
            return null;
        }
        if (!is_numeric($row[3])) {
            return null;
        }

        $currentCategory = Category::updateOrCreate(
            ['name' => $row[1]],
            [
                "name" => $row[1],
                "icon" => 'https://res.cloudinary.com/dika/image/upload/v1603262288/ikanlogo_nrn7qn.png'
            ]
        );

        $currentCategory->slug = GenerateSlug::generateSlug($currentCategory->id, $currentCategory->name);
        $currentCategory->save();

        $currentSubCategory = SubCategory::updateOrCreate(
            ['name' => "Uncategorized", "category_id" => $currentCategory->id],
            [
                "name" => "Uncategorized",
                "category_id" => $currentCategory->id
            ]
        );

        $currentSubCategory->slug = GenerateSlug::generateSlug($currentSubCategory->id, $currentSubCategory->name);
        $currentSubCategory->save();

        $currentBrand = Brand::updateOrCreate(
            ['name' => "Unknown"],
            [
                "name" => "Unknown",
                "description" => "Unknown",
                "images" => "https://res.cloudinary.com/dika/image/upload/v1603262545/placehoder_aebuys.png"
            ]
        );

        $currentUnit = Unit::updateOrCreate(
            ['name' => $row[4]],
            [
                "name" => $row[4],
                "description" => $row[4]
            ]
        );

        $harga_beli = $row[2];
        $harga_jual = $row[3];

        try {
            $mitraId = $this->mitraId;

            $userna = ExternalUser::where('id', $mitraId)->first();
            if(empty($userna)){
                return null;
            }

            $prdct = Product::where("mitra_id", $mitraId)->where("name", $row[0])->where("unit_id", $currentUnit->id)->first();

            if ($prdct){
                return null;
            }

            $p = Product::create([
                "sku_id" => GenerateCode::generateProductSKU(),
                "mitra_id" => $mitraId, //hardcoded
                "name" => $row[0],
                "description" => isset($row[0]) ? $row[0] : "",
                "price" => $harga_beli,
                "selling_price" => $harga_jual,
                "sub_category_id" => $currentSubCategory->id,
                "brand_id" => $currentBrand->id,
                "cover_id" => 0,
                "unit_id" =>   $currentUnit->id,
                "stock" => 0,
                "available" => 1,
                "mitra_commission"  => 0,
                "rating" => 0,
                "total_rating " => 0
            ]);
            
            $p->slug = GenerateSlug::generateSlug($p->id, $p->name);
            $p->save();

            if (isset($row['default_image'])) {
                $cover = ProductGalery::where("image_url",  $row['default_image'])->first();

                if (!$cover) {
                    $cover = ProductGalery::create([
                        "product_id" => $p->id,
                        "image_url" =>  $row['default_image']
                    ]);
                }
            }else {
                $cover = ProductGalery::create([
                    "product_id" => $p->id,
                    "image_url" => "https://res.cloudinary.com/dika/image/upload/v1603262545/placehoder_aebuys.png"
                ]);
            }

            $p->cover_id = $cover->id;
            $p->save();

            return $p;

        } catch (\Throwable $th) {
        }
    }
}
