<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\User;
use BalajiDharma\LaravelReaction\Models\Reaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any reactions.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('reaction list');
    }

    /**
     * Determine whether the user can view a specific reaction.
     *
     * @return mixed
     */
    public function adminView(User $user, Reaction $reaction)
    {
        return $user->can('reaction list');
    }

    /**
     * Determine whether the user can create reactions.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('reaction create');
    }

    /**
     * Determine whether the user can update a specific reaction.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Reaction $reaction)
    {
        return $user->can('reaction edit');
    }

    /**
     * Determine whether the user can delete a specific reaction.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Reaction $reaction)
    {
        return $user->can('reaction delete');
    }
}
