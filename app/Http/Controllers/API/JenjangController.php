<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Jenjang;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Jenjang as JenjangResource;
   
class JenjangController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas = Jenjang::all();
        $datas = Jenjang::where('show_for_guest', 1)->get();
    
        return $this->sendResponse(JenjangResource::collection($datas), 'Jenjang retrieved successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jenjang::find($id);
  
        if (is_null($data)) {
            return $this->sendError('Jenjang not found.');
        }
   
        return $this->sendResponse(new JenjangResource($data), 'Jenjang retrieved successfully.');
    }
}