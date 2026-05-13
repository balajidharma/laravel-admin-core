<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any permissions.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('permission list');
    }

    /**
     * Determine whether the user can view a specific permission.
     *
     * @return mixed
     */
    public function adminView(User $user, Permission $permission)
    {
        return $user->can('permission list');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('permission create');
    }

    /**
     * Determine whether the user can update a specific permission.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Permission $permission)
    {
        return $user->can('permission edit');
    }

    /**
     * Determine whether the user can delete a specific permission.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Permission $permission)
    {
        return $user->can('permission delete');
    }
}
