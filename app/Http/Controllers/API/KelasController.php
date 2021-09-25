<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Kelas as KelasResource;
   
class KelasController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Kelas::search($request)->get();
    
        return $this->sendResponse(KelasResource::collection($datas), 'Kelas retrieved successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kelas::find($id);
  
        if (is_null($data)) {
            return $this->sendError('Kelas not found.');
        }
   
        return $this->sendResponse(new KelasResource($data), 'Kelas retrieved successfully.');
    }
}