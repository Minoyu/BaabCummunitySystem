<?php

namespace App\Policies;

use App\Model\User;
use App\Model\CommunityZone;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityZonePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create communityZones.
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
     * Determine whether the user can update the communityZone.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunityZone  $communityZone
     * @return mixed
     */
    public function update(User $user, CommunityZone $communityZone)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * Determine whether the user can delete the communityZone.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunityZone  $communityZone
     * @return mixed
     */
    public function delete(User $user, CommunityZone $communityZone)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * 是否有权限上传封面
     * @param User $user
     * @return bool
     */
    public function uploadCover(User $user){
        //
        return $user->hasPermissionTo('manage_contents');
    }
}
