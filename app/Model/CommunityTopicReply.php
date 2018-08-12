<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jcc\LaravelVote\CanBeVoted;

class CommunityTopicReply extends Model
{
    //
    use SoftDeletes,CanBeVoted;
    protected $table = 'community_topic_replies';
    protected $guarded = [];
    protected $vote = User::class;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function communityTopic(){
        return $this->belongsTo(CommunityTopic::class,'topic_id');
    }
}
