<?php

namespace App\Policies;

use App\Model\User;
use App\Model\CommunityTopic;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityTopicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the communityTopic.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\CommunityTopic  $communityTopic
     * @return mixed
     */
    public function view(User $user, CommunityTopic $communityTopic)
    {
        //
    }

    /**
     * Determine whether the user can create communityTopics.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
    }
}
