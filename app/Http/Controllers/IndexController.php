<?php

namespace App\Http\Controllers;

use App\Model\CommunitySection;
use App\Model\CommunityTopic;
use App\Model\CommunityZone;
use App\Model\IndexCarousel;
use App\Model\IndexHeadline;
use App\Model\NewsCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //
    /**
     * 首页显示逻辑
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIndex(){
        $indexCarousels = IndexCarousel::where('status','publish')
            ->orderBy('order','desc')
            ->orderBy('created_at','desc')
            ->get();
        $indexLeftHeadlines = IndexHeadline::where('position','left')
            ->where('status','publish')
            ->orderBy('order','desc')
            ->orderBy('created_at','desc')
            ->limit(6)
            ->get();
        $indexRightHeadlines = IndexHeadline::where('position','right')
            ->where('status','publish')
            ->orderBy('order','desc')
            ->orderBy('created_at','desc')
            ->limit(6)
            ->get();
        $hotTopics = CommunityTopic::where('status','publish')
            ->orderBy('reply_count','desc')
            ->orderBy('view_count','desc')
            ->orderBy('order','desc')
            ->orderBy('created_at','desc')
            ->limit(7)
            ->get();
        $newTopics = CommunityTopic::where('status','publish')
            ->orderBy('created_at','desc')
            ->orderBy('order','desc')
            ->limit(7)
            ->get();
        $newsCategories = NewsCategory::where('status','publish')
            ->orderBy('order','desc')
            ->limit(6)
            ->get();

        $newsCollections = collect([]);
        foreach ($newsCategories as $newsCategory){
            $newses = $newsCategory
                ->news()
                ->where('status','publish')
                ->where('invalided_at',null)
                ->orWhere('invalided_at','>',Carbon::now())
                ->orderBy('order','desc')
                ->limit(7)
                ->get();
            $newsCollections->push(compact('newsCategory','newses'));
        }

        $communityZones = CommunityZone::where('status','publish')
            ->orderBy('order','desc')
            ->with('communitySections')
            ->get();

        $topicSections = CommunitySection::whereNotIn('zone_id', [1, 2])
            ->where('status','publish')
            ->orderBy('order','desc')
            ->limit(6)
            ->get();
        $topicCollections = collect([]);
        foreach ($topicSections as $topicSection){
            $topics = $topicSection
                ->communityTopics()
                ->where('status','publish')
                ->orderBy('order','desc')
                ->orderBy('last_reply_at','desc')
                ->limit(7)
                ->get();
            $topicCollections->push(compact('topicSection','topics'));
        }

        $businessSections = CommunitySection::where('zone_id', 1)
            ->where('status','publish')
            ->orderBy('order','desc')
            ->limit(6)
            ->get();
        $businessCollections = collect([]);
        foreach ($businessSections as $businessSection){
            $topics = $businessSection
                ->communityTopics()
                ->where('status','publish')
                ->orderBy('order','desc')
                ->orderBy('last_reply_at','desc')
                ->limit(7)
                ->get();
            $businessCollections->push(compact('businessSection','topics'));
        }

        $schoolSections = CommunitySection::where('zone_id', 2)
            ->where('status','publish')
            ->orderBy('order','desc')
            ->limit(6)
            ->get();

        $schoolCollections = collect([]);
        foreach ($schoolSections as $schoolSection){
            $topics = $schoolSection
                ->communityTopics()
                ->where('status','publish')
                ->orderBy('order','desc')
                ->orderBy('last_reply_at','desc')
                ->limit(7)
                ->get();
            $schoolCollections->push(compact('schoolSection','topics'));
        }


        return view('index',compact(
            'indexCarousels',
            'indexLeftHeadlines',
            'indexRightHeadlines',
            'hotTopics',
            'newTopics',
            'newsCollections',
            'communityZones',
            'topicCollections',
            'businessCollections',
            'schoolCollections'
        ));
    }

    /**
     * 切换语言
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLang(){
        if (App::isLocale('en')) {
            Session::put('language', 'zh');
        }else{
            Session::put('language', 'en');
        }
        return redirect()->back();
    }

    public function handleDrawerDefaultClose(){
        if(Auth::check()){
            $userInfo = Auth::user()->info();
            //用户验证权限
            $this->authorize('update',$userInfo->first());
            $userInfo->update(['is_drawer_open'=>false]);
        }
        Session::put('isDrawerOpen',false);

        $status = 1;
        $msg = __('controller.drawerDefaultClose');

        return json_encode(compact('status','msg'));//ajax
    }

    public function handleDrawerDefaultOpen(){
        if(Auth::check()){
            $userInfo = Auth::user()->info();
            //用户验证权限
            $this->authorize('update',$userInfo->first());
            $userInfo->update(['is_drawer_open'=>true]);
        }
        Session::put('isDrawerOpen',true);

        $status = 1;
        $msg = __('controller.drawerDefaultOpen');

        return json_encode(compact('status','msg'));//ajax
    }
}
