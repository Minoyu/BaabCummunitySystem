<?php

namespace App\Policies;

use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
        if ($user->id === $model->id ||$user->hasPermissionTo('manage_users')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
        return $user->hasPermissionTo('manage_users');
    }
}
