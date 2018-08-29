<?php

namespace App\Http\Controllers;

use App\Model\CommunitySection;
use App\Model\CommunityTopic;
use App\Model\CommunityZone;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    //

    /**
     * 显示社区首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCommunity(){
        $zones = CommunityZone::with('communitySections')
            ->where('status','publish')
            ->orderBy('order','desc')
            ->get();
        return view('community',compact('zones'));
    }

    /**
     * 显示社区分区页 二级
     * @param CommunityZone $zone
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * 显示社区版块页 三级
     * @param CommunitySection $section
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
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
                        ->orderBy('order','desc')
                        ->orderBy('created_at','desc')
                        ->with('user.info')
                        ->paginate(15);
                    break;
                case 'no_reply':
                    $topics = $section->communityTopics()
                        ->whereColumn('last_reply_at','created_at')
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

    /**
     * 显示社区内容页面
     * @param CommunityTopic $topic
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
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
