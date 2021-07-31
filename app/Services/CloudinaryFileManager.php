<?php
namespace App\Services;

use JD\Cloudder\Facades\Cloudder;
use Exception;

class CloudinaryFileManager
{
    static function saveFile($image, $folder="")
    {
        try{
            // $image = $request->file('image');
            $cUrl = Cloudder::upload($image->getPathName(), null, array(
                "folder" => $folder,
                "use_filename" => TRUE, 
                "unique_filename" => FALSE
            ));

            return $cUrl->getResult()['url'];
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
        return "";
    }
    
    static function saveImageBase64($image, $folder="")
    {
        try{
            // $image = $request->file('image');
            $cUrl = Cloudder::upload($image, null, array(
                "folder" => $folder,
                "use_filename" => TRUE, 
                "unique_filename" => FALSE
            ));

            return $cUrl->getResult()['url'];
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
        return "";
    }
}