<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request; // Import Request
use App\Models\LogActivity; // Import model LogActivity
use App\Constants\LogActivityConst;

class LogSuccessfulLogin
{

    /**
        * @var Request
    */
    protected $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $activity = [
            'user_id'    => $event->user->id,
            'user_name'    => $event->user->name,
            'activity'   => 'User logged in',
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->header('User-Agent'),
            'login_at'   => now(), // Menggunakan helper now() untuk timestamp
        ];

        LogActivity::create([
            'action_type'=> LogActivityConst::ACTION_TYPE_READ,
            'description'   => 'User logged '. $event->user->name .' in. ',
            'actor_user_id' => $event->user->id,
            'actor_user_name' => $event->user->name,
            'source_name' => LogActivityConst::MODULE_AUTH,
            'source_id' => $event->user->id,
            'change_fields' => json_encode($activity)
        ]);
    }
}
