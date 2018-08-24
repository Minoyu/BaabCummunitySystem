<?php

namespace App\Policies;

use App\Model\User;
use App\Model\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create news.
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
     * Determine whether the user can update the news.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\News  $news
     * @return mixed
     */
    public function update(User $user, News $news)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\News  $news
     * @return mixed
     */
    public function delete(User $user, News $news)
    {
        //
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * 判断是否有管理权限
     * @param User $user
     * @param News $news
     * @return bool
     */
    public function manage(User $user, News $news){
        return $user->hasPermissionTo('manage_contents');
    }

    /**
     * 判断是否有权限上传图片
     * @param User $user
     * @return bool
     */
    public function uploadImgs(User $user){
        return $user->hasPermissionTo('manage_contents');
    }
    /**
     * 判断是否有权限上传图片
     * @param User $user
     * @return bool
     */
    public function uploadReplyImgs(User $user){
        return $user->hasPermissionTo('do_action');
    }

}
