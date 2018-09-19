<?php

namespace App\Model\Activity;

use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        //所有表的关联删除
        DB::table('activity_log')->where('causer_id',$user->id)->delete();
        DB::table('community_topic_replies')->where('user_id',$user->id)->delete();
        DB::table('community_topics')->where('user_id',$user->id)->delete();
        DB::table('followables')->where('user_id',$user->id)->delete();
        DB::table('followables')
            ->where('followable_id',$user->id)
            ->where('followable_type','App\Model\User')
            ->delete();
        DB::table('model_has_permissions')
            ->where('model_id',$user->id)
            ->where('model_type','App\Model\User')
            ->delete();
        DB::table('model_has_roles')
            ->where('model_id',$user->id)
            ->where('model_type','App\Model\User')
            ->delete();
        DB::table('news')
            ->where('user_id',$user->id)
            ->delete();
        DB::table('news_replies')
            ->where('user_id',$user->id)
            ->delete();
        DB::table('users_info')
            ->where('user_id',$user->id)
            ->delete();
        DB::table('votes')
            ->where('user_id',$user->id)
            ->delete();
    }
}