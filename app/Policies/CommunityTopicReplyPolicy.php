<?php

namespace App\Policies;

use App\Model\User;
use App\Model\CommunityTopicReply;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityTopicReplyPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create communityTopicReplies.
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
     * Determine whether the user can update the communityTopicReply.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunityTopicReply  $communityTopicReply
     * @return mixed
     */
    public function update(User $user, CommunityTopicReply $communityTopicReply)
    {
        //
        if ($user->id === $communityTopicReply->user->id ||$user->hasPermissionTo('manage_contents')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the communityTopicReply.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunityTopicReply  $communityTopicReply
     * @return mixed
     */
    public function delete(User $user, CommunityTopicReply $communityTopicReply)
    {
        //
        if ($user->id === $communityTopicReply->user->id ||$user->hasPermissionTo('manage_contents')){
            return true;
        }else{
            return false;
        }
    }
}
