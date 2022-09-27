<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Banner as BannerResource;
   
class BannerController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas = Banner::all();
        $datas = Banner::where('activeStatus', 1)->get();
    
        return $this->sendResponse(BannerResource::collection($datas), 'Banner retrieved successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Banner::find($id);
  
        if (is_null($data)) {
            return $this->sendError('Banner not found.');
        }
   
        return $this->sendResponse(new BannerResource($data), 'Banner retrieved successfully.');
    }
}