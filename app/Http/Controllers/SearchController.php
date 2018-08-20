<?php

namespace App\Http\Controllers;

use App\Model\CommunityTopic;
use App\Model\News;
use App\Model\User;
use Illuminate\Http\Request;
use TomLingham\Searchy\Facades\Searchy;

class SearchController extends Controller
{
    //
    function indexAll(Request $request){
        $designs = Searchy::designs('title','slug', 'description','detail')->query($request['keywords'])->get();
        $categories = Searchy::categories('title','slug', 'description')->query($request['keywords'])->get();
        $applications = Searchy::applications('title','slug', 'description')->query($request['keywords'])->get();
        $companies = Searchy::companies('title','slug', 'description')->query($request['keywords'])->get();

        return json_encode($designs);
    }

    function discoverTips(Request $request){
        $newses = Searchy::news('title')->query($request['keywords'])->getQuery()->limit(5)->get();
        $community_topics = Searchy::community_topics('title')->query($request['keywords'])->getQuery()->limit(5)->get();
        $users = Searchy::users('name','email')->query($request['keywords'])->getQuery()->limit(5)->get();
        $news_categories = Searchy::news_categories('name')->query($request['keywords'])->getQuery()->limit(2)->get();
        $community_zones = Searchy::community_zones('name')->query($request['keywords'])->getQuery()->limit(2)->get();
        $community_sections = Searchy::community_sections('name')->query($request['keywords'])->getQuery()->limit(2)->get();

        $res=compact('newses',
            'community_topics',
            'community_sections',
            'community_zones',
            'users',
            'news_categories'
        );
        $view = view('discover.search-tips-data-list', $res)->render();
        return response()->json(['html' => $view]);
    }

    public function showSearchRes(Request $request){
        $keywords = urldecode($request->keywords);
        $type = $request->type;
        $page = 1;
        if(!empty($request->page)){
            $page = $request->page;
        }

        switch ($type){
            case 'user':
                $users = Searchy::users('name','email')
                    ->query($keywords)
                    ->getQuery()
                    ->get();

                //遍历生成用户集合
                $user_collection = collect([]);
                foreach ($users as $user){
                    $user = User::where('id',$user->id)->with('info')->first();
                    $followingsCount = $user->followings()->count();
                    $followersCount = $user->followers()->count();

                    $user_collection->push(compact('user','followingsCount','followersCount'));
                }
                $user_collection = $user_collection->forPage($page,10);

                $data = compact(
                    'type',
                    'keywords',
                    'user_collection'
                );

                //如果是Ajax请求
                if ($request->ajax()){
                    $view = view('discover-search-res.left-list-user-data', compact('user_collection'))->render();
                    return response()->json(['html' => $view]);
                }

                return view('discover-search-res',$data);
                break;

            case 'topic':
                //社区话题部分的处理

                $community_topics = Searchy::community_topics('title')->query($keywords)->getQuery()->get();
                $topic_ids = [];
                foreach ($community_topics as $topic){
                    array_push($topic_ids,$topic->id);
                }
                $community_topics = CommunityTopic::whereIn('id',$topic_ids)
                    ->with('user.info')
                    ->paginate(10);

                $data = compact(
                    'type',
                    'keywords',
                    'community_topics'
                );

                //如果是Ajax请求
                if ($request->ajax()){
                    $view = view('discover-search-res.left-list-topic-data', compact('community_topics'))->render();
                    return response()->json(['html' => $view]);
                }
                return view('discover-search-res',$data);
                break;

            case 'news':
                //新闻部分的处理
                $newses = Searchy::news('title')->query($keywords)->getQuery()->get();
                $news_ids = [];
                foreach ($newses as $news){
                    array_push($news_ids,$news->id);
                }
                $newses = News::whereIn('id',$news_ids)
                    ->with('newsCategory')
                    ->paginate(10);

                $data = compact(
                    'type',
                    'keywords',
                    'newses'
                );
                //如果是Ajax请求
                if ($request->ajax()){
                    $view = view('discover-search-res.left-list-news-data', compact('newses'))->render();
                    return response()->json(['html' => $view]);
                }
                return view('discover-search-res',$data);
                break;
            default:
                //社区话题部分的处理

                $community_topics = Searchy::community_topics('title')->query($keywords)->getQuery()->get();
                $topic_ids = [];
                foreach ($community_topics as $topic){
                    array_push($topic_ids,$topic->id);
                }
                $community_topics = CommunityTopic::whereIn('id',$topic_ids)
                    ->with('user.info')
                    ->paginate(10);

                //如果是Ajax请求
                if ($request->ajax()){
                    $view = view('discover-search-res.left-list-topic-data', compact('community_topics'))->render();
                    return response()->json(['html' => $view]);
                }

                $community_zones = Searchy::community_zones('name','description')->query($keywords)->getQuery()->get();
                $community_sections = Searchy::community_sections('name','description')->query($keywords)->getQuery()->get();
                $news_categories = Searchy::news_categories('name','description')->query($keywords)->getQuery()->get();

                $users = Searchy::users('name','email')->query($keywords)->getQuery()->limit(2)->get();

                //遍历生成用户集合
                $user_collection = collect([]);
                foreach ($users as $user){
                    $user = User::where('id',$user->id)->with('info')->first();
                    $followingsCount = $user->followings()->count();
                    $followersCount = $user->followers()->count();

                    $user_collection->push(compact('user','followingsCount','followersCount'));
                }

                //新闻部分的处理
                $newses = Searchy::news('title')->query($keywords)->getQuery()->limit(5)->get();
                $news_ids = [];
                foreach ($newses as $news){
                    array_push($news_ids,$news->id);
                }
                $newses = News::whereIn('id',$news_ids)
                    ->with('newsCategory')
                    ->get();

                $data = compact(
                    'type',
                    'keywords',
                    'community_zones',
                    'community_sections',
                    'news_categories',
                    'user_collection',
                    'newses',
                    'community_topics'
                );

                return view('discover-search-res',$data);
                break;
        }


    }

}
