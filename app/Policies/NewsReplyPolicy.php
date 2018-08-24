<?php

namespace App\Policies;

use App\Model\User;
use App\Model\NewsReply;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsReplyPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create newsReplies.
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
     * Determine whether the user can update the newsReply.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\NewsReply  $newsReply
     * @return mixed
     */
    public function update(User $user, NewsReply $newsReply)
    {
        //
        if ($user->id === $newsReply->user->id ||$user->hasPermissionTo('manage_contents')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the newsReply.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\NewsReply  $newsReply
     * @return mixed
     */
    public function delete(User $user, NewsReply $newsReply)
    {
        //
        if ($user->id === $newsReply->user->id ||$user->hasPermissionTo('manage_contents')){
            return true;
        }else{
            return false;
        }
    }
}
