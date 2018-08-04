<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommunityTopic extends Model
{
    //
    public function communityZone(){
        return $this->belongsTo(CommunityZone::class,'zone_id');
    }
    public function communitySection(){
        return $this->belongsTo(CommunitySection::class,'section_id');
    }
}
