<?php

namespace App\Policies;

use App\Model\User;
use App\Model\IndexHeadline;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndexHeadlinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create indexHeadlines.
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
     * Determine whether the user can update the indexHeadline.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\IndexHeadline  $indexHeadline
     * @return mixed
     */
    public function update(User $user, IndexHeadline $indexHeadline)
    {
        //
        return $user->hasPermissionTo('manage_contents');

    }

    /**
     * Determine whether the user can delete the indexHeadline.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\IndexHeadline  $indexHeadline
     * @return mixed
     */
    public function delete(User $user, IndexHeadline $indexHeadline)
    {
        //
        return $user->hasPermissionTo('manage_contents');

    }

    /**
     * 判断是否有管理权限
     * @param User $user
     * @param IndexHeadline $indexHeadline
     * @return bool
     */
    public function manage(User $user, IndexHeadline $indexHeadline){
        return $user->hasPermissionTo('manage_contents');
    }

}
