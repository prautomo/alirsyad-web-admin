<?php
namespace App\Traits;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;

trait SearchableTrait
{
    public static function appendSearchQuery($currentQuery, $request, $condition)
    {
        // $currentRequest = $request->only(array_keys($condition));
        // dump($condition->key);
        // echo(json_encode($currentRequest));
        if ($condition) {
            foreach ($condition as $key => $value) {

                $requestKey = "q_" . $key;
                if (isset($request[$requestKey]) && $request[$requestKey] != "") {

                    $qrequest = $request[$requestKey];
                    if ($value == "LIKE_FIRST") {
                        $qrequest = "%" . $qrequest;
                    } else if ($value == "LIKE_LAST") {
                        $qrequest = $qrequest . "%";
                    } else if ($value == "LIKE") {
                        $qrequest = "%" . $qrequest . "%";
                    }
                    $currentQuery = $currentQuery->where($key, $value, $qrequest);
                }
            }
        }

        if($request->sort) {
            $currentQuery->orderBy($request->sort, $request->order);
        }else{
            // default
            $currentQuery->orderBy('created_at', 'desc');
        }

        return $currentQuery;
    }
}