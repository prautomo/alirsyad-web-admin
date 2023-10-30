<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Update;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Update as UpdateResource;

class UpdateController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = @Auth::user();

        // Update
        $updates = [];
        // pengunjung
        if (@$user->is_pengunjung) {
            $updates = Update::with('triggerRel');

            // filter if show update is true
            $updates = $updates
                ->where(function ($query) {
                    $query->whereHas('video', function ($query) {
                        $query->where('show_update', '=', 1);
                    })
                        ->orWhereHas('modul', function ($query) {
                            $query->where('show_update', '=', 1);
                        });
                });
            // $updates = $updates->where('visible', '=', 1);

            // filter se jenjang
            $updates = $updates->whereHas('tingkat.jenjang', function ($query) use ($user) {
                $jenjangId = @$user->jenjang_id;
                $query->where('id', $jenjangId);
            });
            // filter by active mapelnya
            // mapel pilihan admin
            $updates = $updates->whereHas('mataPelajaran.guests', function ($query) use ($user) {
                $query->where('guest_id', @$user->id);
            });

            $updates = $updates->orderBy('created_at', 'desc');
            if (@$request->limit) $updates = $updates->limit(@$request->limit);
            
            //needs from ios, set modul_id as 0 if its null
            $updates = $updates->get()->map(function ($update, $key) {
                if($update->video != null){
                    if ($update->video->modul_id == null) {
                        $update->video->modul_id = 0;
                    }
                }
                return $update;
            });
        }
        // siswa
        else {
            $updates = Update::with('triggerRel');

            //filter if show update is true
            $updates = $updates->with(['video', 'modul'])
                ->where(function ($query) {
                    $query->whereHas('video', function ($query) {
                        $query->where('show_update', '=', 1);
                    })
                        ->orWhereHas('modul', function ($query) {
                            $query->where('show_update', '=', 1);
                        });
                });

            // $updates = $updates->where('visible', '=', 1);
            // filter se jenjang
            $updates = $updates->whereHas('tingkat.jenjang', function ($query) use ($user) {
                $jenjangId = @$user->kelas->tingkat->jenjang_id;
                $query->where('id', $jenjangId);
            });
            // // filter by tingkat bawahnya
            // $updates = $updates->whereHas('tingkat', function($query) use ($user) {
            //     $query->where('name', '<=', @$user->kelas->tingkat->name);
            // });
            // filter tingkat nya sendiri
            $updates = $updates->where('tingkat_id', @$user->kelas->tingkat_id);
            $updates = $updates->orderBy('created_at', 'desc');
            if (@$request->limit) $updates = $updates->limit(@$request->limit);
            
            //needs from ios, set modul_id as 0 if its null
            $updates = $updates->get()->map(function ($update, $key) {
                if($update->video != null){
                    if ($update->video->modul_id == null) {
                        $update->video->modul_id = 0;
                    }
                }
                return $update;
            });
        }

        return $this->sendResponse(UpdateResource::collection($updates), 'Update retrieved successfully.');
    }
}
