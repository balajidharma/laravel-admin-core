<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\User;
use BalajiDharma\LaravelMenu\Models\MenuItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any menuItems.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('menu.item list');
    }

    /**
     * Determine whether the user can view a specific menuItem.
     *
     * @return mixed
     */
    public function adminView(User $user, MenuItem $menuItem)
    {
        return $user->can('menu.item list');
    }

    /**
     * Determine whether the user can create menuItems.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('menu.item create');
    }

    /**
     * Determine whether the user can update a specific menuItem.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, MenuItem $menuItem)
    {
        return $user->can('menu.item edit');
    }

    /**
     * Determine whether the user can delete a specific menuItem.
     *
     * @return mixed
     */
    public function adminDelete(User $user, MenuItem $menuItem)
    {
        return $user->can('menu.item delete');
    }
}
