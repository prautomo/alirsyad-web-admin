<?php

namespace App\Traits;

use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;

trait LogActivityTrait
{
    /**
     * Write activity to log_activities table for specific roles.
     *
     * @param string $actionType
     * @param string $description
     * @param string|null $sourceName
     * @param string|int|null $sourceId
     * @param array|null $beforeChange
     * @param array|null $afterChange
     * @return void
     */
    protected function logActivity($actionType, $description, $sourceName = null, $sourceId = null, $beforeChange = null, $afterChange = null)
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();
        if (!($user->hasRole('Guru Mata Pelajaran') || $user->hasRole('Guru Uploader'))) {
            return;
        }

        LogActivity::create([
            'action_type'    => $actionType,
            'description'    => $description,
            'actor_user_id'  => $user->id,
            'actor_user_name'=> $user->name,
            'actor_user_role'=> $user->getRoleNames()->implode(','),
            'before_change'  => $beforeChange ? json_encode($beforeChange) : null,
            'after_change'   => $afterChange ? json_encode($afterChange) : null,
            'source_name'    => $sourceName,
            'source_id'      => $sourceId,
        ]);
    }
}
