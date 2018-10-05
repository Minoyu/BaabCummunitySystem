<?php

namespace App\Model;

use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Jcc\LaravelVote\Vote;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Model
 */
class User extends Authenticatable
{
    use Notifiable,Messagable,CanFollow,CanBeFollowed,Vote,HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * 为路由模型获取键名。
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * 获取与用户关联的信息。
     */
    public function info()
    {
        return $this->hasOne('App\Model\UserInfo');
    }

    public function activities(){
        return $this->hasMany('Spatie\Activitylog\Models\Activity','causer_id');
    }

    public function communityTopics(){
        return $this->hasMany(CommunityTopic::class,'user_id');
    }

    public function newsReplies(){
        return $this->hasMany(NewsReply::class,'user_id');
    }
    public function communityTopicReplies(){
        return $this->hasMany(CommunityTopicReply::class,'user_id');
    }

}
