<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityZone extends Model
{
    //
    use SoftDeletes;
    protected $table = 'community_zones';
    protected $guarded = [];

    public function communitySections(){
        return $this->hasMany(CommunitySection::class,'zone_id');
    }
    public function communityTopics(){
        return $this->hasMany(CommunityTopic::class,'zone_id');
    }
}
