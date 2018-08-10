<?php

namespace App\Http\Controllers;

use App\Model\CommunityZone;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    //
    public function showCommunity(){
        $zones = CommunityZone::with('communitySections')
            ->where('status','publish')
            ->orderBy('order','desc')
            ->get();
        return view('community',compact('zones'));
    }
    public function showCommunityZone(){
        return view('community-zones');
    }
    public function showCommunitySection(){
        return view('community-sec');
    }
    public function showCommunityContent(){
        return view('community-content');
    }
}
