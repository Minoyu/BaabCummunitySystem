<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityTopic extends Model
{
    //
    use SoftDeletes;
    protected $table = 'community_topics';
    protected $guarded = [];
    public function communityZone(){
        return $this->belongsTo(CommunityZone::class,'zone_id');
    }
    public function communitySection(){
        return $this->belongsTo(CommunitySection::class,'section_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


}
