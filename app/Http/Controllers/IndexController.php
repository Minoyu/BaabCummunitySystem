<?php

namespace App\Http\Controllers;

use App\Model\CommunitySection;
use App\Model\CommunityTopic;
use App\Model\CommunityZone;
use App\Model\IndexCarousel;
use App\Model\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //
    public function showIndex(){
        $indexCarousels = IndexCarousel::where('status','publish')
            ->orderBy('order','desc')
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
            ->with(['news' => function ($query) {
                $query->where('status','publish')
                    ->orderBy('order','desc')
                    ->limit(7);
            }])
            ->get();

        $communityZones = CommunityZone::where('status','publish')
            ->orderBy('order','desc')
            ->with('communitySections')
            ->get();

        $communitySections = CommunitySection::where('status','publish')
            ->orderBy('order','desc')
            ->limit(6)
            ->with(['communityTopics' => function ($query) {
                $query->where('status','publish')
                    ->orderBy('order','desc')
                    ->orderBy('last_reply_at','desc')
                    ->limit(7);
            }])
            ->get();

        return view('index',compact(
            'indexCarousels',
            'hotTopics',
            'newTopics',
            'newsCategories',
            'communitySections',
            'communityZones'
        ));
    }


    public function switchLang(){
        if (App::isLocale('en')) {
            Session::put('language', 'zh');
        }else{
            Session::put('language', 'en');
        }
        return redirect()->back();
    }
}
