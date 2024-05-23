<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ERaport;
use App\Models\ExternalUser;
use App\Models\KelasSiswa;
use App\Models\MataPelajaran;
use App\Models\PaketSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ERaportController extends Controller
{
    function __construct(){
        $this->middleware('permission:e-raport-list', ['only' => ['index','show']]);

        $this->prefix = 'pages.backoffice.e-raport';
        $this->routePath = 'backoffice::e-raport';
    }
    
    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = ERaport::query();

        // filter if its guru uploader
        if (!@\Auth::user()->hasRole('Superadmin')) {
            // $mapelIdsUser = $this->getMapelIdsUser();
            // $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
        }

        $datas = $query->groupBy('user_id')->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where(function($query) use ($search){
                        $query = $query->orWhereHas('external_user', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%')->orWhere('nis', 'LIKE', '%'.$search.'%');
                        });
                    });
                }

            })
            ->addIndexColumn()
            ->addColumn('nis', function($data) {
                return @$data->external_user->nis;
            })
            ->addColumn('name', function($data) {
                return @$data->external_user->name;
            })
            ->addColumn('jenjang', function($data) {
                return @$data->external_user->kelas->tingkat->jenjang->name;
            })
            ->addColumn('tingkat', function($data) {
                return @$data->external_user->kelas->tingkat->name;
            })
            ->addColumn('kelas', function($data) {
                return @$data->external_user->kelas->name;
            })
            ->addColumn("tahun_ajaran", function ($data) {
                $current_class = KelasSiswa::where(['siswa_id' => $data->external_user->id, 'is_current' => 1])->first();

                if($current_class != null){
                    return $current_class->tahun_ajaran;
                }

                return "";
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "viewRoute" => route($this->routePath.".show", $data->external_user->id),
                    "viewBtnText" => "View"
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->toJson();
    }

    public function index(Request $request){
        if ($request->ajax()) {
            return $this->datatable($request);
        }

        return view($this->prefix.'.index');
    }

    public function datatableShow(Request $request, $id){
        $query = MataPelajaran::query();

        // filter if its guru uploader
        if (!@\Auth::user()->hasRole('Superadmin')) {
            // $mapelIdsUser = $this->getMapelIdsUser();
            // $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
        }

        $user = ExternalUser::find($id);
        $datas = $query->where(['tingkat_id' => $user->kelas->tingkat->id])->select('*');

        return datatables()
            ->of($datas)
            ->addIndexColumn()
            ->addColumn('jumlah_bab', function($data) {
                return count(@$data->modul);
            })
            ->addColumn('jumlah_subbab', function($data) {
                $total_subbab = 0;

                foreach($data->modul as $bab){
                    $count_subbab = PaketSoal::where(['bab_id' => $bab->id, 'deleted_at' => null])
                        ->select('subbab', DB::raw('count(subbab) as total'))
                        ->groupBy('subbab')
                        ->get()->count();
                        
                    $total_subbab += $count_subbab;
                }

                return $total_subbab;
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "viewRoute" => route($this->routePath.".show", $data->id),
                    "viewBtnText" => "Detail Mapel"
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('urutan', 'asc');
            })
            ->toJson();
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            return $this->datatableShow($request, $id);
        }
        // $paketSoal = PaketSoal::with('mataPelajaran', 'bab')->findOrFail($id);

        $data = [
            // 'paket_soal' => $paketSoal,
            // 'id' => $id,
        ];

        return view($this->prefix.'.show', $data);

    }
}
