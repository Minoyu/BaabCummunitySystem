<?php

namespace App\Model\Activity;

use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class UserObserver{

    /**
     * 监听用户创建事件
     * @param User $user
     */
    public function created(User $user){
        $userId =$user->id;
        $userName = $user->name;
        $event = 'user.created';
        activity()->on($user)
            ->withProperties(compact(
                'userId',
                'userName',
                'userAvatar',
                'event'))
            ->log('用户加入社区');
    }

    public function deleted(User $user)
    {
        Activity::where([
            ['subject_id', $user->id],
            ['subject_type', 'App\Model\User'],
        ])->delete();
        Activity::where([
            ['causer_id', $user->id]
        ])->delete();
    }
}