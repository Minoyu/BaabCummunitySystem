<?php

namespace App\Http\Controllers;

use App\Model\CommunitySection;
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
    public function showCommunityZone(CommunityZone $zone){
        $sections = $zone ->communitySections()
            ->where('status','publish')
            ->orderBy('order','desc')
            ->with(['communityTopics' => function ($query) {
                $query->where('status','publish')->orderBy('order','desc')->first();
            }])
            ->get();
        return view('community-zone',compact('zone','sections'));
    }
    public function showCommunitySection(CommunitySection $section,Request $request){
        $orderBy = $request->input('orderBy');
            switch ($orderBy){
                case 'excellent':
                    $topics = $section->communityTopics()
                        ->where('is_excellent',true)
                        ->where('status','publish')
                        ->orderBy('order','desc')
                        ->with('user.info')
                        ->paginate(15);
                    break;
                case 'thumb_up':
                    $topics = $section->communityTopics()
                        ->where('status','publish')
                        ->orderBy('thumb_up_count','desc')
                        ->orderBy('order','desc')
                        ->with('user.info')
                        ->paginate(15);
                    break;
                case 'recent':
                    $topics = $section->communityTopics()
                        ->where('status','publish')
                        ->orderBy('created_at','desc')
                        ->orderBy('order','desc')
                        ->with('user.info')
                        ->paginate(15);
                    break;
                case 'no_reply':
                    $topics = $section->communityTopics()
                        ->where('last_reply_at',null)
                        ->where('status','publish')
                        ->orderBy('order','desc')
                        ->with('user.info')
                        ->paginate(15);
                    break;
                default:
                    $topics = $section->communityTopics()->where('status','publish')
                        ->orderBy('order','desc')
                        ->with('user.info')
                        ->paginate(15);
                    break;
            }
        return view('community-section',compact('section','topics','orderBy'));
    }
    public function showCommunityContent(){
        return view('community-content');
    }
}
