<?php

namespace App\Policies;

use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function updateUserInfo(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    public function uploadAvatar(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
    public function uploadCover(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
