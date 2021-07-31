<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;

class UploadService
{
    public static function uploadImage($image, $storagePath)
    {

        if (!Storage::exists($storagePath)) {
            $storagePath;
        }
        $folder = "storage/{$storagePath}";
        $new_name = 'DIGIBOOK_IMG_' . gmdate('d_m_Y_h_i_s') . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($folder), $new_name);

        return $folder . "/" . $new_name;
    }
    public static function uploadBaseImage($image, $storagePath)
    {

        if (!Storage::exists($storagePath)) {
            $storagePath;
        }

        $folder = "/storage/{$storagePath}/";
        $new_name = 'DIGIBOOK_IMG_' . gmdate('d_m_Y_h_i_s') . '.png' ;

        $file = public_path($folder)  . $new_name;
        file_put_contents($file, $image);

        return $folder  . $new_name;
    }
}
