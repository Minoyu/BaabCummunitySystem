<?php

namespace App\Policies;

use App\Model\User;
use App\Model\NewsCarousel;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsCarouselPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create newsCarousels.
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
     * Determine whether the user can update the newsCarousel.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\NewsCarousel  $newsCarousel
     * @return mixed
     */
    public function update(User $user, NewsCarousel $newsCarousel)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * Determine whether the user can delete the newsCarousel.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\NewsCarousel  $newsCarousel
     * @return mixed
     */
    public function delete(User $user, NewsCarousel $newsCarousel)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }
}
