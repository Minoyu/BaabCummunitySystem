<?php

namespace App\Policies;

use App\Model\User;
use App\Model\IndexCarousel;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndexCarouselPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create indexCarousels.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * Determine whether the user can update the indexCarousel.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\IndexCarousel  $indexCarousel
     * @return mixed
     */
    public function update(User $user, IndexCarousel $indexCarousel)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * Determine whether the user can delete the indexCarousel.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\IndexCarousel  $indexCarousel
     * @return mixed
     */
    public function delete(User $user, IndexCarousel $indexCarousel)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }
}
