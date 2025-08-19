<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\LogActivity;

class LogActivityController extends Controller{

    function __construct(){
        $this->middleware('permission:log-activity-list|log-activity-create|log-activity-edit|log-activity-delete', ['only' => ['index']]);

        $this->prefix = 'pages.backoffice.log-activities';
        $this->routePath = 'backoffice::log-activities';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = LogActivity::query();

        return datatables()
            ->of($query)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where('description', 'LIKE', '%'.$search.'%');
                }
            })
            ->addIndexColumn()
            ->addColumn('action_type', function($data) {
                return @$data->action_type;
            })
            ->addColumn('actor_user_name', function($data) {
                return @$data->actor_user_name;
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "name" => $data->name,
                    "permissionName" => 'log-activity',
                ]);
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
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
}
