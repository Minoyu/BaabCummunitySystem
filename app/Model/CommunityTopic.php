<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jcc\LaravelVote\CanBeVoted;

class CommunityTopic extends Model
{
    //
    use SoftDeletes,CanBeVoted;
    protected $table = 'community_topics';
    protected $guarded = [];
    protected $vote = User::class;

    public function communityZone(){
        return $this->belongsTo(CommunityZone::class,'zone_id');
    }
    public function communitySection(){
        return $this->belongsTo(CommunitySection::class,'section_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function replies(){
        return $this->hasMany(CommunityTopicReply::class,'topic_id');
    }


}
