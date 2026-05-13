<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\User;
use BalajiDharma\LaravelAttributes\Models\Attribute;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttributePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any attributes.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('attribute list');
    }

    /**
     * Determine whether the user can view a specific attribute.
     *
     * @return mixed
     */
    public function adminView(User $user, Attribute $attribute)
    {
        return $user->can('attribute list');
    }

    /**
     * Determine whether the user can create attributes.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('attribute create');
    }

    /**
     * Determine whether the user can update a specific attribute.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Attribute $attribute)
    {
        return $user->can('attribute edit');
    }

    /**
     * Determine whether the user can delete a specific attribute.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Attribute $attribute)
    {
        return $user->can('attribute delete');
    }
}
