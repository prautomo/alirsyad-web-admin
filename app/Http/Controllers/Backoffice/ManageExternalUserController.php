<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Services\UploadService;
use App\Models\Modul;
use App\Models\MataPelajaran;
use App\Models\Tingkat;
use App\Models\Update;
use App\Models\UploaderMataPelajaran;
use App\Helpers\ExtractArchive;
use App\Helpers\GenerateSlug;
use App\Models\ExternalUser;
use App\Models\Jenjang;

class ManageExternalUserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:modul-list|modul-create|modul-edit|modul-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:modul-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:modul-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:modul-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.manage-external-user';
        $this->routePath = 'backoffice::manage-external-users';
    }

    public function datatable(Request $request)
    {
        $query = Modul::query();

        // kalo bukan superadmin, tambahin filter by mapel na
        // if (!@\Auth::user()->hasRole('Superadmin')) {
        //     $mapelIdsUser = $this->getMapelIdsUser();
        //     $query = $query->whereIn('mata_pelajaran_id', $mapelIdsUser);
        // }

        $query = $query->with('mataPelajaran.tingkat.jenjang');

        $datas = $query->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');

                        $query = $query->orWhereHas('mataPelajaran.tingkat.jenjang', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });

                        $query = $query->orWhereHas('mataPelajaran.tingkat', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });

                        $query = $query->orWhereHas('mataPelajaran', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });
                    });
                }

                // query param mapel id
                if (@$request->mata_pelajaran_id) $query->where('mata_pelajaran_id', @$request->mata_pelajaran_id);
            })
            ->addIndexColumn()
            ->addColumn('show-img', function ($data) {
                if (empty($data->icon)) {
                    return "not available";
                } else {
                    return view("components.datatable.image", [
                        "url" => asset($data->icon)
                    ]);
                }
            })
            ->addColumn("jenjang", function ($data) {
                return @$data->mataPelajaran->tingkat->jenjang ? $data->mataPelajaran->tingkat->jenjang->name : '-';
            })
            ->addColumn("tingkat", function ($data) {
                return @$data->mataPelajaran->tingkat ? $data->mataPelajaran->tingkat->name : '-';
            })
            ->addColumn("mapel", function ($data) {
                $mapel = @$data->mataPelajaran->name ? $data->mataPelajaran->name : 'none';
                $mapelID = @$data->mataPelajaran->id ? $data->mataPelajaran->id : '';

                return view("components.datatable.link", [
                    "link" => route($this->routePath . ".index") . "?mata_pelajaran_id=" . $mapelID,
                    "text" => $mapel,
                ]);
                return $mapel;
            })
            ->addColumn("konten_aktif", function ($data) {
                return '-';
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'modul',
                    "class" => $data->class,
                    "deleteRoute" => route($this->routePath . ".destroy", $data->id),
                    "editRoute" => route($this->routePath . ".edit", $data->id),
                    // "viewPdfRoute" => asset($data->pdf_path),
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->toJson();
    }

    public function index(Request $request)
    {
        // dd($request->query('content'));
        if ($request->ajax()) {
            return $this->datatable($request);
        }

        return view($this->prefix . '.index');
    }

    /**
     * Get mata pelajaran
     */
    private function getMataPelajaran()
    {
        // get list mapel
        $mapels = MataPelajaran::with('tingkat');

        // filter kalo rolenya guru uploader (khusus mapel aja)
        // kalo bukan superadmin, tambahin filter by mapel na
        if (!@\Auth::user()->hasRole('Superadmin')) {
            $mapelIdsUser = $this->getMapelIdsUser();
            $mapels = $mapels->whereIn('id', $mapelIdsUser);
        }

        $mapels = $mapels->get();

        $mapelList = [];
        $mapelList[""] = "Pilih mata pelajaran";

        foreach ($mapels as $mapel) {
            $mapelList[$mapel->id] = $mapel->name . " (Tingkat " . @$mapel->tingkat->name . " " . @$mapel->tingkat->jenjang->name . ")";
        }

        return $mapelList;
    }

    public function create()
    {
        $mapelList = $this->getMataPelajaran();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];
        $modulIDS = [];

        $moduls = Modul::get();
        $groupModulList = [];
        foreach ($moduls as $modul) {
            // dd($modul->mataPelajaran->tingkat);
            $textTingkat = @$modul->mataPelajaran->tingkat->name . " " . @$modul->mataPelajaran->tingkat->jenjang->name;

            $idxSearch = array_search(@$textTingkat, array_column($groupModulList, 'text'));

            // belum ada
            if ($idxSearch === false) {
                array_push($groupModulList, [
                    'id' => $modul->mataPelajaran->tingkat_id,
                    'text' => @$textTingkat,
                    'children' => [[
                        'id' => $modul->id,
                        'text' => @$modul->name,
                    ]],
                ]);
            } else {
                // udah ada
                array_push($groupModulList[$idxSearch]['children'], [
                    'id' => $modul->id,
                    'text' => @$modul->name
                ]);
            }
        }

        return view($this->prefix . '.create', ['mapelList' => $mapelList, 'groupModulList' => $groupModulList, 'modulIDS' => $modulIDS, 'showUpdate' => $show]);
    }

    public function store()
    {
        return 'hhel';
    }

    public function edit(Request $request, $id)
    {
        $dt = ExternalUser::with('kelas')->findOrFail($id);

        $jenjangId = @$dt->jenjang->id;

        // get list group mapel 
        $mapels = MataPelajaran::with('tingkat');

        if ($jenjangId) {
            $mapels = $mapels->whereHas('tingkat', function ($q2) use ($jenjangId) {
                $q2->where('jenjang_id', $jenjangId);
            });
        }

        $mapels = $mapels->get();

        $groupMapelList = [];
        foreach ($mapels as $mapel) {

            $textTingkat = "Tingkat " . @$mapel->tingkat->name . " " . @$mapel->tingkat->jenjang->name;
            $idxSearch = array_search("Semua " . @$textTingkat, array_column($groupMapelList, 'text'));

            // belum ada
            if ($idxSearch === false) {
                array_push($groupMapelList, [
                    'id' => $mapel->tingkat_id,
                    'text' => "Semua " . @$textTingkat,
                    'children' => [[
                        'id' => $mapel->id,
                        'text' => @$mapel->name . " (" . $textTingkat . ")",
                    ]],
                ]);
            } else {
                // udah ada
                array_push($groupMapelList[$idxSearch]['children'], [
                    'id' => $mapel->id,
                    'text' => @$mapel->name . " (" . $textTingkat . ")",
                ]);
            }
        }

        $mapelIDS = [];
        foreach ($dt->mataPelajaranGuests as $mapel) {
            $mapelIDS[] = $mapel->id;
        }

        return view($this->prefix . '.edit', ['data' => $dt, 'mapelList' => $groupMapelList, 'mapelIDS' => $mapelIDS]);
    }
}
