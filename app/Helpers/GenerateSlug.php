<?php
namespace App\Helpers;

class GenerateSlug {

    public static function generateSlug($id, $str, $separator="-") {
        $res = $id.$separator;

        $res .= str_replace(' ', $separator, strtolower($str));

        return $res;
    }
}
