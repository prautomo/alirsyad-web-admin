<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use App\Models\LogActivity;
use App\Constants\LogActivityConst;

class LogSuccessfulLogout
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if (!($event->user && ($event->user->hasRole('Guru Mata Pelajaran') || $event->user->hasRole('Guru Uploader')))) {
            return;
        }

        $activity = [
            'user_id'    => $event->user->id,
            'user_name'  => $event->user->name,
            'activity'   => 'User logged out',
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->header('User-Agent'),
            'logout_at'  => now(),
        ];

        LogActivity::create([
            'action_type'    => LogActivityConst::ACTION_TYPE_READ,
            'description'    => 'User '. $event->user->name .' logged out.',
            'actor_user_id'  => $event->user->id,
            'actor_user_name'=> $event->user->name,
            'actor_user_role'=> $event->user->getRoleNames()->implode(','),
            'source_name'    => LogActivityConst::MODULE_AUTH,
            'source_id'      => $event->user->id,
            'change_fields'  => json_encode($activity),
        ]);
    }
}
