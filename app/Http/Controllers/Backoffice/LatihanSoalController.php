<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\PaketSoal;
use Illuminate\Http\Request;

class LatihanSoalController extends Controller
{
    function __construct(){
        $this->middleware('permission:latihan-soal-list|latihan-soal-create|latihan-soal-edit|latihan-soal-delete', ['only' => ['index','show']]);
        $this->middleware('permission:latihan-soal-create', ['only' => ['create','store']]);
        $this->middleware('permission:latihan-soal-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:latihan-soal-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.latihan-soal';
        $this->routePath = 'backoffice::latihan-soal';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = PaketSoal::query();
        
        $datas = $query->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where(function($query) use ($search){
                        $query->where('name', 'LIKE', '%'.$search.'%');

                        $query = $query->orWhereHas('mataPelajaran', function($query2) use ( $search ){
                            $query2->where('name', 'LIKE', '%'.$search.'%');
                        });
                    });
                }

            })
            ->addIndexColumn()
            ->addColumn('show-img', function($data) {
                if(empty($data->icon)){
                    return "not available";
                }else{
                    return view("components.datatable.image", [
                        "url" => asset($data->icon)
                    ]);
                }
            })
            ->addColumn("mapel", function ($data) {
                $mapel = @$data->mataPelajaran->name ? $data->mataPelajaran->name : 'none';
                $mapelID = @$data->mataPelajaran->id ? $data->mataPelajaran->id : '';

                return view("components.datatable.link", [
                    "link" => route($this->routePath.".index")."?mata_pelajaran_id=".$mapelID,
                    "text" => $mapel,
                ]);
                return $mapel;
            })
            ->addColumn("tingkat_kesulitan", function ($data) {
                $tingkatKesulitan = '';
                switch($data->tingkat_kesulitan){
                    case 'mudah':
                        $tingkatKesulitan = 'Mudah';
                        break;
                    case 'sedang':
                        $tingkatKesulitan = 'Sedang';
                        break;
                    case 'sulit':
                        $tingkatKesulitan = 'Sulit';
                        break;
                }
                return $tingkatKesulitan;
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "subbab" => $data->subbab,
                    "judul_subbab" => $data->judul_subbab,
                    "permissionName" => 'latihan-soal',
                    "class" => $data->class,
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
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

    /**
     * Get mata pelajaran
     */
    private function getMataPelajaran(){
        // get list mapel
        $mapels = MataPelajaran::with('tingkat');

        // filter kalo rolenya guru uploader (khusus mapel aja)
        // kalo bukan superadmin, tambahin filter by mapel na
        if(!@\Auth::user()->hasRole('Superadmin')){
            $mapelIdsUser = $this->getMapelIdsUser();
            $mapels = $mapels->whereIn('id', $mapelIdsUser);
        }

        $mapels = $mapels->get();

        $mapelList = [];
        $mapelList[""] = "Pilih mata pelajaran";

        foreach($mapels as $mapel){
            $mapelList[$mapel->id] = $mapel->name . " (Tingkat ".@$mapel->tingkat->name." ".@$mapel->tingkat->jenjang->name.")";
        }

        return $mapelList;
    }

    /**
     * Get bab from modul
     */
    private function getBab(){

        $listModul = Modul::get();
        $groupBabList = [];
        foreach ($listModul as $bab) {
            $textMapel = @$bab->mataPelajaran->name . " (Tingkat " .  @$bab->mataPelajaran->tingkat->name . " " . @$bab->mataPelajaran->tingkat->jenjang->name . ")";

            $idxSearch = array_search(@$textMapel, array_column($groupBabList, 'text'));

            // belum ada
            if ($idxSearch === false) {
                array_push($groupBabList, [
                    'id' => $bab->mataPelajaran->tingkat_id,
                    'text' => $textMapel,
                    'children' => [[
                        'id' => $bab->id,
                        'text' => @$bab->name,
                    ]],
                ]);
            } else {
                // udah ada
                array_push($groupBabList[$idxSearch]['children'], [
                    'id' => $bab->id,
                    'text' => @$bab->name
                ]);
            }
        }

        return $groupBabList;
    }

    public function create(){

        $data = [
            'mapelList' => $this->getMataPelajaran(),
            'groupBabList' => $this->getBab()
        ];

        return view($this->prefix.'.create', $data);
    }

    public function store(Request $request)
    {
        $newLatihanSoal = $request->only(['mata_pelajaran_id', 'tingkat_kesulitan', 'subbab', 'judul_subbab', 'jumlah_publish', 'nilai_kkm']);
        $newLatihanSoal['bab_id'] = $request->bab[0];

        $storeLatihanSoal = PaketSoal::create($newLatihanSoal);

        if ($storeLatihanSoal) {
            return redirect()->route($this->prefix . '.index')->with(
                $this->success(__("Success to Create Latihan Soal "), $storeLatihanSoal)
            );
        }
    }
}
