<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Models\PasswordResetStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetStudentController extends Controller
{
    function __construct(){
        $this->middleware('permission:password-reset-student-list|password-reset-student-create|password-reset-student-edit|password-reset-student-delete', ['only' => ['index','show']]);
        $this->middleware('permission:password-reset-student-create', ['only' => ['create','store']]);
        $this->middleware('permission:password-reset-student-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:password-reset-student-delete', ['only' => ['destroy']]);

        $this->prefix = 'pages.backoffice.password-reset-students';
        $this->routePath = 'backoffice::password-reset-students';
    }

    /**
     * Display data in datatable
     *
     * @return void
     */
    public function datatable(Request $request){
        $query = PasswordResetStudent::query();
        
        $query = $query->with('externalUser');

        $datas = $query->select('*');

        return datatables()
            ->of($datas)
            ->filter(function ($query) use ($request) {

                $search = @$request->search['value'];

                if($search){
                    $query->where(function($query) use ($search){
                        $query->where('nis', 'LIKE', '%'.$search.'%');
                    });
                }

            })
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                return view("components.datatable.status_password_reset", [
                    "route" => route($this->routePath . ".update-status", $data->id),
                    "text" => $data->status,
                    "id" => $data->id,
                    "role" => $data->role
                ]);
            })
            ->addColumn("created_at", function ($data) {
                $createdAt = new Carbon($data->created_at);

                return $createdAt->format("d-m-Y H:i:s");
            })
            ->addColumn("name", function ($data) {
                return $data->externalUser->name;
            })
            ->addColumn("action", function ($data) {
                return view("components.datatable.actions", [
                    "nis" => $data->nis,
                    "permissionName" => 'password-reset-student',
                    "class" => $data->class,
                    "deleteRoute" => route($this->routePath.".destroy", $data->id),
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

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $input = $request->only(['status']);
        $passwordReset = PasswordResetStudent::find($id);
        $passwordReset->update($input);

        if($input['status'] == 'RESET_PASSWORD_SELESAI'){
            $updatePassword = ExternalUser::where('id', $passwordReset->external_user_id);
            $updatePassword->update(['password' => Hash::make('123456')]);
        }

        return redirect()->route($this->routePath . '.index', ['role' => $request->role])->with(
            $this->success(__("Status updated successfully"), $passwordReset)
        );
    }

    public function destroy($id){
        $d = PasswordResetStudent::findOrFail($id);

        $d->delete();
    }

}
