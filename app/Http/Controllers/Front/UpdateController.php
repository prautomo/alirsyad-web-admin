<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Update;
use Illuminate\Http\Request;
use Auth;

class UpdateController extends Controller
{
    /**
     * Show the list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = @Auth::user();

        // Update
        $updates = [];
        // pengunjung
        if(@$user->is_pengunjung){
            $updates = Update::with('triggerRel');
            // filter se jenjang
            $updates = $updates->whereHas('tingkat.jenjang', function($query) use ($user) {
                $jenjangId = @$user->jenjang_id;
                $query->where('id', $jenjangId);
            });
            // filter by active mapelnya
            // mapel pilihan admin
            $updates = $updates->whereHas('mataPelajaran.guests', function($query) use ($user) {
                $query->where('guest_id', @$user->id);
            });

            $updates = $updates->orderBy('created_at', 'desc')->limit(5)->get();
        }
        // siswa
        else{
            $updates = Update::with('triggerRel');
            // filter se jenjang
            $updates = $updates->whereHas('tingkat.jenjang', function($query) use ($user) {
                $jenjangId = @$user->kelas->tingkat->jenjang_id;
                $query->where('id', $jenjangId);
            });
            // // filter by tingkat bawahnya
            // $updates = $updates->whereHas('tingkat', function($query) use ($user) {
            //     $query->where('name', '<=', @$user->kelas->tingkat->name);
            // });
            // filter tingkat nya sendiri
            $updates = $updates->where('tingkat_id', @$user->kelas->tingkat_id);
            // sort, limit, and get data
            $updates = $updates->orderBy('created_at', 'desc')->limit(5)->get();
        }

        $parseData = [
            'updates' => $updates,
        ];

        return view('pages/frontoffice/update', $parseData);
    }

}
