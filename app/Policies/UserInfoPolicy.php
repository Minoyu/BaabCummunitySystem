<?php

namespace App\Policies;

use App\Model\User;
use App\Model\UserInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserInfoPolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can update the userInfo.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\UserInfo  $userInfo
     * @return mixed
     */
    public function update(User $user, UserInfo $userInfo)
    {
        //
        if ($user->id === $userInfo->user->id ||$user->hasPermissionTo('manage_users')){
            return true;
        }else{
            return false;
        }
    }
}
