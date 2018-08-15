<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DiscoverController extends Controller
{
    //
    public function showDiscover(){
        $activities = Activity::orderBy('created_at','desc')->get();
        return view('discover',compact('activities'));
    }
}
