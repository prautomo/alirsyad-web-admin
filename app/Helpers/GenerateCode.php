<?php
namespace App\Helpers;

use Ramsey\Uuid\Uuid as Generator;
use App\Models\ExternalUser;
use App\Models\Product;

class GenerateCode {

    public static function generateReferalCode() {
        $number = "BRMN".substr(strtoupper(uniqid()), 8);
    
        // call the same function if the barcode exists already
        if (ExternalUser::where('referral_code',$number)->exists()) {
            return GenerateCode::generateReferalCode();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }

    public static function generateProductCode() {
        $code = Generator::uuid4()->toString();
    
        // call the same function if the barcode exists already
        if (Product::where('code', $code)->exists()) {
            return GenerateCode::generateProductCode();
        }
    
        // otherwise, it's valid and can be used
        return $code;
    }

    public static function generateProductSKU() {
        $code = Generator::uuid4()->toString();
    
        // call the same function if the barcode exists already
        if (Product::where('sku_id', $code)->exists()) {
            return GenerateCode::generateProductSKU();
        }
    
        // otherwise, it's valid and can be used
        return $code;
    }
}