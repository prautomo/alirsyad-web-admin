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
use App\Models\Simulasi;
use App\Models\Video;

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
        $query = MataPelajaran::query();

        $content = $request->query('content');

        switch ($content) {
            case 'modul':
                $query = $query->with('tingkat.jenjang', 'modul');
                $datas = $query->select('*')->where('is_public_modul', 1);
                break;
            case 'video':
                $query = $query->with('tingkat.jenjang', 'video');
                $datas = $query->select('*')->where('is_public_video', 1);
                break;
            case 'simulasi':
                $query = $query->with('tingkat.jenjang', 'simulasi');
                $datas = $query->select('*')->where('is_public_simulasi', 1);
                break;
        }

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');

                        $query = $query->orWhereHas('tingkat.jenjang', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });

                        $query = $query->orWhereHas('tingkat', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });

                        $query = $query->orWhereHas('modul', function ($query2) use ($search) {
                            $query2->where('name', 'LIKE', '%' . $search . '%');
                        });
                    });
                }

                // query param mapel id
                if (@$request->mata_pelajaran_id) $query->where('mata_pelajaran_id', @$request->mata_pelajaran_id);
            })
            ->addIndexColumn()
            ->addColumn("jenjang", function ($data) {
                return @$data->tingkat->jenjang ? $data->tingkat->jenjang->name : '-';
            })
            ->addColumn("tingkat", function ($data) {
                return @$data->tingkat ? $data->tingkat->name : '-';
            })
            ->addColumn("mapel", function ($data) {
                $mapel = @$data->name ? $data->name : 'none';
                $mapelID = @$data->id ? $data->id : '';

                return view("components.datatable.link", [
                    "link" => route($this->routePath . ".index") . "?mata_pelajaran_id=" . $mapelID,
                    "text" => $mapel,
                ]);
                return $mapel;
            })
            ->addColumn("konten_aktif", function ($data) use ($request) {
                // return  @$data ? $data->name : '-';
                $content = $request->query('content');
                switch ($content) {
                    case 'modul':
                        $listContentActive = $data->modul;
                        break;
                    case 'video':
                        $listContentActive = $data->video;
                        break;
                    case 'simulasi':
                        $listContentActive = $data->simulasi;
                        break;
                }

                $m = [];
                foreach ($listContentActive as $contentActive) {
                    if ($contentActive->is_public == 1) {
                        $m[] = $contentActive->name;
                    }
                }

                return view("components.datatable.wrapTextBadge", [
                    "text" => $m,
                ]);
            })
            ->addColumn("action", function ($data) use ($request) {
                $content = $request->query('content');
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'modul',
                    "class" => $data->class,
                    "editRoute" => route($this->routePath . ".edit", $data->id) . "?content=" . $content,
                    "deleteRoute" => route($this->routePath . ".destroy", $data->id) . "?content=" . $content
                ]);
            })
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->toJson();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->datatable($request);
        }

        return view($this->prefix . '.index', ['title' => 'Akses ' . ucfirst($request->query('content')), 'content' => $request->query('content')]);
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

    public function create(Request $request)
    {
        $mapelList = $this->getMataPelajaran();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];
        $contentIDS = [];

        $listContent = [];
        switch ($request->query('content')) {
            case 'modul':
                $listContent = Modul::get();
                break;
            case 'video':
                $listContent = Video::get();
                break;
            case 'simulasi':
                $listContent = Simulasi::get();
                break;
        }

        $groupContentList = [];
        foreach ($listContent as $content) {
            $textMapel = @$content->mataPelajaran->name . " (Tingkat " .  @$content->mataPelajaran->tingkat->name . " " . @$content->mataPelajaran->tingkat->jenjang->name . ")";

            $idxSearch = array_search(@$textMapel, array_column($groupContentList, 'text'));

            // belum ada
            if ($idxSearch === false) {
                array_push($groupContentList, [
                    'id' => $content->mataPelajaran->tingkat_id,
                    'text' => $textMapel,
                    'children' => [[
                        'id' => $content->id,
                        'text' => @$content->name,
                    ]],
                ]);
            } else {
                // udah ada
                array_push($groupContentList[$idxSearch]['children'], [
                    'id' => $content->id,
                    'text' => @$content->name
                ]);
            }
        }

        return view($this->prefix . '.create', ['title' => 'Create Akses ' . ucfirst($request->query('content')), 'mapelList' => $mapelList, 'groupContentList' => $groupContentList, 'contentIDS' => $contentIDS, 'form_mode' => 'create', 'content' => $request->query('content')]);
    }

    public function store(Request $request)
    {
        $mataPelajaranId = $request->id;
        $contentList = $request->content;
        switch ($request->contentType) {
            case 'modul':
                $updateMapel = MataPelajaran::where('id', $mataPelajaranId)->update(['is_public_modul' => 1]);
                $updateContent = Modul::whereIn('id', $contentList)->update(['is_public' => 1]);
                break;
            case 'video':
                $updateMapel = MataPelajaran::where('id', $mataPelajaranId)->update(['is_public_video' => 1]);
                $updateContent = Video::whereIn('id', $contentList)->update(['is_public' => 1]);
                break;
            case 'simulasi':
                $updateMapel = MataPelajaran::where('id', $mataPelajaranId)->update(['is_public_simulasi' => 1]);
                $updateContent = Simulasi::whereIn('id', $contentList)->update(['is_public' => 1]);
                break;
        }

        if ($updateMapel) {
            if ($updateContent) {
                return redirect()->route($this->routePath . '.index', ['content' => $request->contentType])->with(
                    $this->success(__("Success to create Akses "  . ucfirst($request->contentType)), $updateContent)
                );
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $mapelList = $this->getMataPelajaran();
        $show = [
            1 => 'Ya',
            0 => 'Tidak',
        ];

        $listContent = [];
        $dtContent = [];
        switch ($request->query('content')) {
            case 'modul':
                $dt = MataPelajaran::with('tingkat.jenjang', 'modul')->findOrFail($id);
                $dtContent = $dt->modul;
                $listContent = Modul::get();
                break;
            case 'video':
                $dt = MataPelajaran::with('tingkat.jenjang', 'video')->findOrFail($id);
                $dtContent = $dt->video;
                $listContent = Video::get();
                break;
            case 'simulasi':
                $dt = MataPelajaran::with('tingkat.jenjang', 'simulasi')->findOrFail($id);
                $dtContent = $dt->simulasi;
                $listContent = Simulasi::get();
                break;
        }

        $contentIDS = [];
        foreach ($dtContent as $content) {
            if ($content->is_public == 1) {
                $contentIDS[] = $content->id;
            }
        }

        $groupContentList = [];
        foreach ($listContent as $content) {
            $textMapel = @$content->mataPelajaran->name . " (Tingkat " .  @$content->mataPelajaran->tingkat->name . " " . @$content->mataPelajaran->tingkat->jenjang->name . ")";

            $idxSearch = array_search(@$textMapel, array_column($groupContentList, 'text'));

            // belum ada
            if ($idxSearch === false) {
                array_push($groupContentList, [
                    'id' => $content->mataPelajaran->tingkat_id,
                    'text' => $textMapel,
                    'children' => [[
                        'id' => $content->id,
                        'text' => @$content->name,
                    ]],
                ]);
            } else {
                // udah ada
                array_push($groupContentList[$idxSearch]['children'], [
                    'id' => $content->id,
                    'text' => @$content->name
                ]);
            }
        }



        return view($this->prefix . '.edit', ['data' => $dt, 'mapelList' => $mapelList, 'groupContentList' => $groupContentList, 'contentIDS' => $contentIDS, 'form_mode' => 'edit', 'content' => $request->query('content')]);
    }

    public function update(Request $request, $id)
    {
        if ($request->content == null) {
            switch ($request->contentType) {
                case 'modul':
                    MataPelajaran::where('id', $id)->update(['is_public_modul' => 0]);
                    $modulList = Modul::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                    Modul::whereIn('id', $modulList)->update(['is_public' => 0]);
                    break;
                case 'video':
                    MataPelajaran::where('id', $id)->update(['is_public_video' => 0]);
                    $videoList = Video::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                    Video::whereIn('id', $videoList)->update(['is_public' => 0]);
                    break;
                case 'simulasi':
                    MataPelajaran::where('id', $id)->update(['is_public_simulasi' => 0]);
                    $simulasiList = Simulasi::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                    Simulasi::whereIn('id', $simulasiList)->update(['is_public' => 0]);
                    break;
            }
            return redirect()->route($this->routePath . '.index', ['content' => $request->contentType])->with(
                $this->success(__("Akses " . ucfirst($request->contentType) . " deleted because no content that assigned"))
            );
        } else {
            $activeContentList = [];
            $contentList = (array) $request->content;
            switch ($request->contentType) {
                case 'modul':
                    $activeContentList = Modul::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                    break;
                case 'video':
                    $activeContentList = Video::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                    break;
                case 'video':
                    $activeContentList = Simulasi::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                    break;
            }

            foreach ($activeContentList as $activeContent) {
                if (!in_array($activeContent, $contentList)) {
                    switch ($request->contentType) {
                        case 'modul':
                            $updateModul = Modul::where('id', $activeContent)->update(['is_public' => 0]);
                            break;
                        case 'video':
                            $updateModul = Video::where('id', $activeContent)->update(['is_public' => 0]);
                            break;
                        case 'simulasi':
                            $updateModul = Simulasi::where('id', $activeContent)->update(['is_public' => 0]);
                            break;
                    }
                }
            }

            switch ($request->contentType) {
                case 'modul':
                    $updateModul = Modul::whereIn('id', $contentList)->update(['is_public' => 1]);
                    break;
                case 'video':
                    $updateModul = Video::whereIn('id', $contentList)->update(['is_public' => 1]);
                    break;
                case 'simulasi':
                    $updateModul = Simulasi::whereIn('id', $contentList)->update(['is_public' => 1]);
                    break;
            }

            if ($updateModul) {
                return redirect()->route($this->routePath . '.index', ['content' => $request->contentType])->with(
                    $this->success(__("Akses " . ucfirst($request->contentType) . " updated successfully"))
                );
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        switch ($request->query('content')) {
            case 'modul':
                MataPelajaran::where('id', $id)->update(['is_public_modul' => 0]);
                $modulList = Modul::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                Modul::whereIn('id', $modulList)->update(['is_public' => 0]);
                break;
            case 'video':
                MataPelajaran::where('id', $id)->update(['is_public_video' => 0]);
                $videoList = Video::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                Video::whereIn('id', $videoList)->update(['is_public' => 0]);
                break;
            case 'simulasi':
                MataPelajaran::where('id', $id)->update(['is_public_simulasi' => 0]);
                $simulasiList = Simulasi::where(['is_public' => 1, 'mata_pelajaran_id' => $id])->pluck('id')->toArray();
                Simulasi::whereIn('id', $simulasiList)->update(['is_public' => 0]);
                break;
        }
    }
}
