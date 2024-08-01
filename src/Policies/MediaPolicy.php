<?php

namespace BalajiDharma\LaravelAdminCore\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Plank\Mediable\Media;

class MediaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any medias.
     *
     * @return mixed
     */
    public function adminViewAny(User $user)
    {
        return $user->can('media list');
    }

    /**
     * Determine whether the user can view a specific media.
     *
     * @return mixed
     */
    public function adminView(User $user, Media $media)
    {
        return $user->can('media list');
    }

    /**
     * Determine whether the user can create medias.
     *
     * @return mixed
     */
    public function adminCreate(User $user)
    {
        return $user->can('media create');
    }

    /**
     * Determine whether the user can update a specific media.
     *
     * @return mixed
     */
    public function adminUpdate(User $user, Media $media)
    {
        return $user->can('media edit');
    }

    /**
     * Determine whether the user can delete a specific media.
     *
     * @return mixed
     */
    public function adminDelete(User $user, Media $media)
    {
        return $user->can('media delete');
    }
}
