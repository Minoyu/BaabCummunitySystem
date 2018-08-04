<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunitySection extends Model
{
    //
    use SoftDeletes;
    protected $table = 'community_sections';
    protected $guarded = [];
    public function communityZone(){
        return $this->belongsTo(CommunityZone::class,'zone_id');
    }
    public function communityTopics(){
        return $this->hasMany(CommunityTopic::class,'section_id');
    }

}
