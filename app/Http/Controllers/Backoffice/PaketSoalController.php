<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\PaketSoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use DB;
use Auth;

class PaketSoalController extends Controller
{
    function __construct(){
        $this->middleware('permission:paket-soal-list|paket-soal-create|paket-soal-edit|paket-soal-delete', ['only' => ['index','show']]);
        $this->middleware('permission:paket-soal-create', ['only' => ['create','store']]);
        $this->middleware('permission:paket-soal-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:paket-soal-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.paket-soals';
        $this->routePath = 'backoffice::paket-soals';
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
                    "permissionName" => 'paket-soal',
                    "class" => $data->class,
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
                    "editRoute" => route($this->routePath.".edit", $data->id),
                    "soalRoute" => route($this->routePath.".index-soal", $data->id),
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
     * Get mata pelajaran
     */
    private function getLevel() {
        $levels = ["Mudah", "Sedang", "Sulit"];

        $levelList = [];
        $levelList[""] = "Pilih tingkat kesulitan";

        foreach($levels as $level){
            $levelList[strtolower($level)] = $level;
        }

        return $levelList;
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
            'levelList' => $this->getLevel(),
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
            return redirect()->route($this->routePath . '.index')->with(
                $this->success(__("Success to Create Paket Soal "), $storeLatihanSoal)
            );
        }
    }

    public function destroy(Request $request, $id){
        $d = PaketSoal::findOrFail($id);

        $d->delete();
    }

    public function edit(Request $request, $id){
        $dt = PaketSoal::with('mataPelajaran', 'bab')->findOrFail($id);

        $data = [
            'data' => $dt,
            'mapelList' => $this->getMataPelajaran(),
            'levelList' => $this->getLevel(),
            'groupBabList' => $this->getBab()
        ];

        return view($this->prefix.'.edit', $data);
    }

    public function update(Request $request, $id){

        $dataReq = $request->only(['mata_pelajaran_id', 'tingkat_kesulitan', 'subbab', 'judul_subbab', 'jumlah_publish', 'nilai_kkm']);

        $dt = PaketSoal::findOrFail($id);
        $dt->update($dataReq);

        return redirect()->route($this->routePath.'.index')->with(
            $this->success(__("Success to update Paket Soal"), $dt)
        );
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatableSoal(Request $request){
        $query = Soal::query();

        $datas = $query->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where(function($query) use ($search){
                        $query->where('soal', 'LIKE', '%'.$search.'%');

                        $query = $query->orWhereHas('mataPelajaran', function($query2) use ( $search ){
                            $query2->where('soal', 'LIKE', '%'.$search.'%');
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
                    "permissionName" => 'paket-soal',
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

    public function indexSoal(Request $request, $id) {
        if ($request->ajax()) {
            return $this->datatableSoal($request);
        }
        $paketSoal = PaketSoal::with('mataPelajaran', 'bab')->findOrFail($id);

        $data = [
            'paket_soal' => $paketSoal,
            'id' => $id,
        ];

        return view($this->prefix.'.index_soal', $data);
    }

    public function batchSoal(Request $request, $id) {

        $data = [
            'id' => $id,
        ];

        return view($this->prefix.'.batch_soal', $data);
    }

    /**
     * Bulk upload user from excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function importSoal(Request $request, $id)
    {
        try {
            return DB::transaction(function ()  use ($request, $id) {

                // loop every row
                foreach ((@$request->data ? @$request->data : []) as $key => $row) {
                    // assign init data
                    $no = $row["A"];
                    $soal = $row["B"];
                    $pilihanA = $row["C"];
                    $pilihanB = $row["D"];
                    $pilihanC = @$row["E"];
                    $pilihanD = @$row["F"];
                    $pilihanE = @$row["G"];
                    $jawaban = $row["H"];

                    // cek paket soal, if not exists -> skip
                    $paketSoal = PaketSoal::find($id);
                    if ($paketSoal === null) continue;

                    $input['soal'] = $soal;
                    $input['pilihan_a'] = $pilihanA;
                    $input['pilihan_b'] = $pilihanB;
                    $input['pilihan_c'] = $pilihanC;
                    $input['pilihan_d'] = $pilihanD;
                    if (@$pilihanE) {
                        $input['pilihan_e'] = $pilihanE;
                    }
                    $tempJawaban = "pilihan_a";
                    if (strtolower($jawaban) === "pilihan 2") {
                        $tempJawaban = "pilihan_b";
                    } else if (strtolower($jawaban) === "pilihan 3") {
                        $tempJawaban = "pilihan_c";
                    } else if (strtolower($jawaban) === "pilihan 4") {
                        $tempJawaban = "pilihan_d";
                    } else if (strtolower($jawaban) === "pilihan 5") {
                        $tempJawaban = "pilihan_e";
                    }
                    $input['jawaban'] = $tempJawaban;
                    $input['creator_id'] = @Auth::user()->id;
                    $input['created_at'] = now();

                    $user = Soal::create($input);
                }

                return $this->returnData([], "Data Berhasil Di Upload");
            });
        } catch (\Throwable $th) {
            return $this->returnError($th);
        }
    }
}
