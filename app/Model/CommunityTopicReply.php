<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityTopicReply extends Model
{
    //
    use SoftDeletes;
    protected $table = 'community_topic_replies';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function communityTopic(){
        return $this->belongsTo(CommunityTopic::class,'topic_id');
    }
}
