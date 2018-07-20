<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//首页
Route::get('/','IndexController@showIndex')->name('showIndex');

//新闻页面
Route::get('/news','NewsController@showNews')->name('showNews');
Route::get('/news/test','NewsController@showNewsSec')->name('showNewsSec');

//社区页面
Route::get('/community','CommunityController@showCommunity')->name('showCommunity');
Route::get('/community/test','CommunityController@showCommunitySec')->name('showCommunitySec');

//切换语言
Route::get('/switch/lang','IndexController@switchLang')->name('switchLang');
