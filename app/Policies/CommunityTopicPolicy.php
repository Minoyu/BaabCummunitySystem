<?php

namespace App\Policies;

use App\Model\User;
use App\Model\CommunityTopic;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityTopicPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create communityTopics.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->hasPermissionTo('do_action');

    }

    /**
     * Determine whether the user can update the communityTopic.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunityTopic  $communityTopic
     * @return mixed
     */
    public function update(User $user, CommunityTopic $communityTopic)
    {
        //
        if ($user->id === $communityTopic->user->id ||$user->hasPermissionTo('manage_contents')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the communityTopic.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunityTopic  $communityTopic
     * @return mixed
     */
    public function delete(User $user, CommunityTopic $communityTopic)
    {
        //
        if ($user->id === $communityTopic->user->id ||$user->hasPermissionTo('manage_contents')){
            return true;
        }else{
            return false;
        }
    }


    /**
     * 判断是否有管理权限
     * @param User $user
     * @param CommunityTopic $communityTopic
     * @return bool
     */
    public function manage(User $user, CommunityTopic $communityTopic){
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * 判断是否有权限上传图片
     * @param User $user
     * @return bool
     */
    public function uploadImgs(User $user){
        return $user->hasPermissionTo('do_action');
    }
}
