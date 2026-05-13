<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any users.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('user list');
    }

    /**
     * Determine whether the user can view a specific user.
     *
     * @return mixed
     */
    public function adminView(User $user, User $userData)
    {
        return $user->can('user list');
    }

    /**
     * Determine whether the user can create users.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('user create');
    }

    /**
     * Determine whether the user can update a specific user.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, User $userData)
    {
        return $user->can('user edit');
    }

    /**
     * Determine whether the user can delete a specific user.
     *
     * @return mixed
     */
    public function adminDelete(User $user, User $userData)
    {
        return $user->can('user delete');
    }
}
