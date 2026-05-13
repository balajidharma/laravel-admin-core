<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any activitylogs.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('activitylog list');
    }

    /**
     * Determine whether the user can view a specific activitylog.
     *
     * @return mixed
     */
    public function adminView(User $user, Activity $activity)
    {
        return $user->can('activitylog list');
    }
}
