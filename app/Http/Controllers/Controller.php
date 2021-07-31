<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Create response data for success action
     *
     * @param string $message
     * @param mixed $data
     * @return array
     */
    public function success($message, $data = null)
    {
        return [
            'data' => $data,
            "message" => $message,
            "status" => "success"
        ];
    }

    /**
     * Create response data for failed action
     *
     * @param string $message
     * @param mixed $data
     * @return array
     */
    public function failed($message, $data = null)
    {
        return [
            'data' => $data,
            "message" => $message,
            "status" => "failed"
        ];
    }

    public function returnData($data, $message, $status = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public function returnError($er, $status = 400)
    {
        return response()->json([
            'message' => $er->getMessage(),
        ], $status);
    }

    public function returnStatus($status = 200, $message = "Data berhasil di ambil"){
        return response([
            "status" => $status == "200" ? true : false,
            "message" => $message,
        ], $status);
    }
}
