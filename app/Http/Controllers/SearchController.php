<?php

namespace App\Http\Controllers;

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
        $users = Searchy::users('name')->query($request['keywords'])->getQuery()->limit(5)->get();
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

}
