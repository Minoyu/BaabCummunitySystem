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


}
