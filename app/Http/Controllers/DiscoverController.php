<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class DiscoverController extends Controller
{
    //
    public function showDiscover(Request $request){
        $view = $request->view;
        $dataTooLittle = false;
        $dataTooLittleNum = 8;
        if (Auth::check()){
            switch ($view){
                case 'all':
                    //全部动态
                    $activities = Activity::orderBy('created_at','desc')
                        ->paginate(15);
                    break;
                case 'mine':
                    //我的动态
                    $activities = Activity::where('causer_id',Auth::id())
                        ->orderBy('created_at','desc')
                        ->paginate(15);
                    break;
                default:
                    //用户关注的动态
                    $users = Auth::user()
                        ->followings()
                        ->get();
                    $causerIds =[];
                    foreach ($users as $user){
                        array_push($causerIds,$user->id);
                    }
                    $activities = Activity::whereIn('causer_id',$causerIds)
                        ->orderBy('created_at','desc')
                        ->paginate(15);
                    if ($activities->count()<$dataTooLittleNum){
                        $dataTooLittle = true;
                        $activities = Activity::orderBy('created_at','desc')
                            ->paginate(15);
                    }
                    break;
            }
        }else{
            $activities = Activity::orderBy('created_at','desc')
                ->paginate(15);
        }
        if ($request->ajax()) {
            $html = view('discover.left-list-data',compact('activities'))->render();
            return json_encode(compact('html'));
        }

        return view('discover',compact('activities','view','dataTooLittle'));
    }
}
