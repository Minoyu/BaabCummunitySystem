<?php

namespace App\Policies;

use App\Model\User;
use App\Model\NewsCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsCategoryPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create newsCategories.
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
     * Determine whether the user can update the newsCategory.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\NewsCategory  $newsCategory
     * @return mixed
     */
    public function update(User $user, NewsCategory $newsCategory)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * Determine whether the user can delete the newsCategory.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\NewsCategory  $newsCategory
     * @return mixed
     */
    public function delete(User $user, NewsCategory $newsCategory)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }
}
