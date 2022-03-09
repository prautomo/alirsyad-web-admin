<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\Modul as ModulResource;
use App\Http\Resources\Video as VideoResource;
use App\Http\Resources\Simulasi as SimulasiResource;
use App\Models\Modul;
use App\Models\Simulasi;
use App\Models\Video;

class ManageExternalUserController extends BaseController
{
    public function public_modul(Request $request)
    {
        $query = Modul::query();

        if (@$request->q_mata_pelajaran_id) {
            $datas = $query->select('*')->where(['is_public' => 1, 'mata_pelajaran_id' => $request->q_mata_pelajaran_id]);
        }

        // sort by urutan
        $datas = $datas->orderBy('urutan', 'asc');

        // sort by active mapel
        $datas = $datas->get();

        return $this->sendResponse(ModulResource::collection($datas), 'Public modul retrieved successfully.');
    }

    public function public_video(Request $request)
    {
        $query = Video::query();

        if (@$request->q_mata_pelajaran_id) {
            $datas = $query->select('*')->where(['is_public' => 1, 'mata_pelajaran_id' => $request->q_mata_pelajaran_id]);
        }

        // sort by urutan
        $datas = $datas->orderBy('urutan', 'asc');

        // sort by active mapel
        $datas = $datas->get();

        return $this->sendResponse(VideoResource::collection($datas), 'Public modul retrieved successfully.');
    }

    public function public_simulasi(Request $request)
    {
        $query = Simulasi::query();

        if (@$request->q_mata_pelajaran_id) {
            $datas = $query->select('*')->where(['is_public' => 1, 'mata_pelajaran_id' => $request->q_mata_pelajaran_id]);
        }

        // sort by urutan
        $datas = $datas->orderBy('urutan', 'asc');

        // sort by active mapel
        $datas = $datas->get();

        return $this->sendResponse(SimulasiResource::collection($datas), 'Public modul retrieved successfully.');
    }
}
