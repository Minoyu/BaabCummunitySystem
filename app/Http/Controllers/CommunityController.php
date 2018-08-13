<?php

namespace App\Http\Controllers;

use App\Model\CommunitySection;
use App\Model\CommunityTopic;
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
                $query->where('status','publish')->orderBy('last_reply_at','desc');
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
                        ->orderBy('last_reply_at','desc')
                        ->with('user.info')
                        ->paginate(15);
                    break;
            }
        if ($request->ajax()) {
            $view = view('community-section.topics-list-data', compact('topics'))->render();
            return response()->json(['html' => $view]);
        }
        return view('community-section',compact('section','topics','orderBy'));
    }

    public function showCommunityContent(CommunityTopic $topic,Request $request){
        $orderBy = $request->input('orderBy');
        switch ($orderBy){
            case 'thumb_up':
                $replies = $topic->replies()
                    ->orderBy('thumb_up_count','desc')
                    ->with('user.info')
                    ->paginate(10);;
                break;
            default:
                $replies = $topic->replies()
                    ->with('user.info')
                    ->paginate(10);;
                break;
        }
        if ($request->ajax()) {
            $view = view('community-content.comment-data', compact('replies'))->render();
            return response()->json(['html' => $view]);
        }else{
            $topic->increment('view_count');
        }
        return view('community-content',compact('topic','replies','orderBy'));
    }
}
