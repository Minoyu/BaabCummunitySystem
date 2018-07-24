<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityController extends Controller
{
    //
    public function showCommunity(){
        return view('community');
    }
    public function showCommunitySec(){
        return view('community-sec');
    }
    public function showCommunityContent(){
        return view('community-content');
    }
}
