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
Route::get('/news/content','NewsController@showNewsContent')->name('showNewsContent');

//社区页面
Route::get('/community','CommunityController@showCommunity')->name('showCommunity');
Route::get('/community/test','CommunityController@showCommunitySec')->name('showCommunitySec');
Route::get('/community/content','CommunityController@showCommunityContent')->name('showCommunityContent');

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

//  修改用户信息
    Route::post('/user/{user}/edit/info','UserController@updateUserInfo')->name('editUserInfo');
//  上传用户头像
    Route::post('/user/{user}/upload/avatar','UserController@uploadAvatar')->name('uploadUserAvatar');
    Route::post('/user/{user}/upload/cover','UserController@uploadCover')->name('uploadUserCover');
});

//TODO 后台测试路由
Route::group(['prefix'=>'admin'],function () {
    //新闻分类管理模块
    Route::get("/news-category",'NewsCategoryController@adminListShow')->name('adminNewsCategoriesList');
    Route::get("/news-category/create",'NewsCategoryController@adminCreateShow')->name('adminNewsCategoriesCreate');
    Route::post("/news-category/store",'NewsCategoryController@store')->name('adminNewsCategoriesStore');
    Route::get("/news-category/{newsCategory}/edit",'NewsCategoryController@adminEditShow')->name('adminNewsCategoriesEdit');
    Route::post("/news-category/{newsCategory}/update",'NewsCategoryController@update')->name('adminNewsCategoriesUpdate');
    Route::post("/news-category/delete",'NewsCategoryController@softDelete')->name('newsCategorySoftDelete');
    Route::post("/news-category/deletes",'NewsCategoryController@softDeletes')->name('newsCategoriesSoftDeletes');
});
