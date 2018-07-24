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
Route::get('news/content','NewsController@showNewsContent')->name('showNewsContent');

//社区页面
Route::get('/community','CommunityController@showCommunity')->name('showCommunity');
Route::get('/community/test','CommunityController@showCommunitySec')->name('showCommunitySec');

//切换语言
Route::get('/switch/lang','IndexController@switchLang')->name('switchLang');

//用户登录、注册
Route::post('/auth/login','AuthController@login')->name('userLogin');
Route::get('/auth/not/login','AuthController@notLogin')->name('notLogin');
Route::post('/auth/checkEmailUnique','AuthController@checkEmailUnique')->name('userCheckEmail');
Route::post('/auth/register','AuthController@register')->name('userRegister');

//用户相关
Route::get('/user/{user}','UserController@showPersonalCenter')->name('showPersonalCenter');

Route::group(['middleware'=>'auth:web'],function (){
    Route::get('/auth/logout','AuthController@logout')->name('userLogout');

    Route::post('/user/{user}/edit/info','UserController@updateUserInfo')->name('editUserInfo');
});
