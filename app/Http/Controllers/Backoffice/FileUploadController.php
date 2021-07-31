<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Services\CloudinaryFileManager;

class FileUploadController extends Controller
{
    public function uploadImageBase64(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'base64_image' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->returnStatus(400, $validator->errors());  
        }

        return $this->returnData([
            "image" =>  CloudinaryFileManager::saveImageBase64($request->base64_image, 'images')
        ], "Berhasil Upload gambar");
    }

    public function uploadImageFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xlsx,xls|max:2048'
        ]);

        return $this->returnData([
            "image" =>  CloudinaryFileManager::saveFile($request->file('image'), 'images')
        ], "Berhasil Upload gambar");
    }
}