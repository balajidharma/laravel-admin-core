<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\User;
use BalajiDharma\LaravelCategory\Models\CategoryType;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categoryTypes.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('category.type list');
    }

    /**
     * Determine whether the user can view a specific categoryType.
     *
     * @return mixed
     */
    public function adminView(User $user, CategoryType $categoryType)
    {
        return $user->can('category.type list');
    }

    /**
     * Determine whether the user can create categoryTypes.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('category.type create');
    }

    /**
     * Determine whether the user can update a specific categoryType.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, CategoryType $categoryType)
    {
        return $user->can('category.type edit');
    }

    /**
     * Determine whether the user can delete a specific categoryType.
     *
     * @return mixed
     */
    public function adminDelete(User $user, CategoryType $categoryType)
    {
        return $user->can('category.type delete');
    }
}
