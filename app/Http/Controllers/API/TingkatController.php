<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Tingkat;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Tingkat as TingkatResource;
   
class TingkatController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Tingkat::search($request)->get();
    
        return $this->sendResponse(TingkatResource::collection($datas), 'Tingkat retrieved successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Tingkat::find($id);
  
        if (is_null($data)) {
            return $this->sendError('Tingkat not found.');
        }
   
        return $this->sendResponse(new TingkatResource($data), 'Tingkat retrieved successfully.');
    }
}