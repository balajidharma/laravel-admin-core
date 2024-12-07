<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\User;
use BalajiDharma\LaravelComment\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any comments.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('comment list');
    }

    /**
     * Determine whether the user can view a specific comment.
     *
     * @return mixed
     */
    public function adminView(User $user, Comment $comment)
    {
        return $user->can('comment list');
    }

    /**
     * Determine whether the user can create comments.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('comment create');
    }

    /**
     * Determine whether the user can update a specific comment.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Comment $comment)
    {
        return $user->can('comment edit');
    }

    /**
     * Determine whether the user can delete a specific comment.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Comment $comment)
    {
        return $user->can('comment delete');
    }
}
