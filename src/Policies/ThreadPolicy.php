<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use BalajiDharma\LaravelForum\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any threads.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('thread list');
    }

    /**
     * Determine whether the user can view a specific thread.
     *
     * @return mixed
     */
    public function adminView(User $user, Thread $thread)
    {
        return $user->can('thread list');
    }

    /**
     * Determine whether the user can create threads.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('thread create');
    }

    /**
     * Determine whether the user can update a specific thread.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Thread $thread)
    {
        return $user->can('thread edit');
    }

    /**
     * Determine whether the user can delete a specific thread.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Thread $thread)
    {
        return $user->can('thread delete');
    }
}
