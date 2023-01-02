<?php

namespace App\Http\Controllers\Backoffice;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CloudinaryFileManager;
use App\Services\UploadService;

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

    public function uploadImageCKEditor(Request $request)
    {
        if($request->hasFile('upload')) {

            $image = $request->file('upload');
            $extension = $image->extension();
            $url = asset( UploadService::uploadImage($image, 'soal') );

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
