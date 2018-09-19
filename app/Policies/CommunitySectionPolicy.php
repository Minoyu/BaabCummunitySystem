<?php

namespace App\Policies;

use App\Model\User;
use App\Model\CommunitySection;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunitySectionPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create communitySections.
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
     * Determine whether the user can update the communitySection.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunitySection  $communitySection
     * @return mixed
     */
    public function update(User $user, CommunitySection $communitySection)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * Determine whether the user can delete the communitySection.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunitySection  $communitySection
     * @return mixed
     */
    public function delete(User $user, CommunitySection $communitySection)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }
}
