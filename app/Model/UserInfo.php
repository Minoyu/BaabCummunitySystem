<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $table = 'users_info';
    protected $guarded = [];

    /**
     * 获得拥有此信息的用户。
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}
