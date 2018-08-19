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
Route::get('/news/category/{cat}','NewsController@showNewsSec')->name('showNewsSec');
Route::get('/news/{news}','NewsController@showNewsContent')->name('showNewsContent');

//新闻回复图片上传
Route::post('/news/reply/upload/img','NewsController@uploadReplyImg')->name('uploadNewsImg');


//社区页面
Route::get('/community','CommunityController@showCommunity')->name('showCommunity');
Route::get('/community/zone/{zone}','CommunityController@showCommunityZone')->name('showCommunityZone');
Route::get('/community/section/{section}','CommunityController@showCommunitySection')->name('showCommunitySection');
Route::get('/community/topic/{topic}','CommunityController@showCommunityContent')->name('showCommunityContent');
Route::post("/community/topic/vote/getVoters",'CommunityTopicController@ajaxGetVoters')->name('communityTopicGetVoters');

//社区话题图片上传
Route::post('/community/topic/upload/img','CommunityTopicController@uploadImg')->name('uploadCommunityTopicImg');


//切换语言
Route::get('/switch/lang','IndexController@switchLang')->name('switchLang');

//用户登录、注册
Route::post('/auth/login','AuthController@login')->name('userLogin');
Route::get('/auth/not/login','AuthController@notLogin')->name('notLogin');
Route::post('/auth/checkEmailUnique','AuthController@checkEmailUnique')->name('userCheckEmail');
Route::post('/auth/register','AuthController@register')->name('userRegister');

//用户相关
Route::get('/user/{user}','UserController@showPersonalCenter')->name('showPersonalCenter');
Route::post("/user/getFollowings",'UserController@ajaxGetFollowings')->name('userGetFollowings');
Route::post("/user/getFollowers",'UserController@ajaxGetFollowers')->name('userGetFollowers');

//  发现页面
Route::get("/discover",'DiscoverController@showDiscover')->name('showDiscover');

Route::group(['middleware'=>'auth:web'],function (){
    Route::get('/auth/logout','AuthController@logout')->name('userLogout');

//  新闻回复
    Route::post("/news/{news}/reply/store",'NewsReplyController@store')->name('newsReplyStore');
//  社区话题回复
    Route::post("/community/topic/{topic}/reply/store",'CommunityTopicReplyController@store')->name('communityTopicReplyStore');

//  社区话题创建
    Route::get("/community/create/topic",'CommunityTopicController@create')->name('communityTopicCreate');
    Route::post("/community/create/topic/store",'CommunityTopicController@storeMini')->name('communityTopicStore');
    Route::get("/community/edit/topic/{topic}",'CommunityTopicController@edit')->name('communityTopicEdit');
    Route::post("/community/edit/topic/{topic}/update",'CommunityTopicController@updateMini')->name('communityTopicUpdate');


    //ajax通过zoneid获取sections
    Route::post('/community/category/getSectionsByZoneId','CommunityCategoryController@getSectionsByZoneId')->name('communitygetSectionsByZoneId');

//  社区话题回复投票相关
    Route::post("/community/topic/reply/vote",'CommunityTopicReplyController@handleAjaxVote')->name('communityTopicReplyVote');
    Route::post("/community/topic/reply/cancelVote",'CommunityTopicReplyController@handleAjaxCancelVote')->name('communityTopicReplyCancelVote');
//  新闻回复投票相关
    Route::post("/news/reply/vote",'NewsReplyController@handleAjaxVote')->name('newsReplyVote');
    Route::post("/news/reply/cancelVote",'NewsReplyController@handleAjaxCancelVote')->name('newsReplyCancelVote');
//  社区话题投票相关
    Route::post("/community/topic/vote",'CommunityTopicController@handleAjaxVote')->name('communityTopicVote');
    Route::post("/community/topic/cancelVote",'CommunityTopicController@handleAjaxCancelVote')->name('communityTopicCancelVote');


//  修改用户信息
    Route::post('/user/{user}/edit/info','UserController@updateUserInfo')->name('editUserInfo');
    Route::post('/user/{user}/edit/info/motto','UserController@helpUpdateUserMotto')->name('helpEditUserMotto');
    Route::post('/user/{user}/edit/info/livingCity','UserController@helpUpdateUserLivingCity')->name('helpEditUserLivingCity');
    Route::post('/user/{user}/edit/info/nation','UserController@helpUpdateUserNation')->name('helpEditUserNation');
    Route::post('/user/{user}/edit/info/engaged','UserController@helpUpdateUserEngaged')->name('helpEditUserEngaged');
    Route::post('/user/{user}/edit/info/wechat','UserController@helpUpdateUserWechat')->name('helpEditUserWechat');
    Route::post('/user/{user}/edit/info/closeHelp','UserController@helpUpdateClose')->name('closeHelpEditUserInfo');
//
//  用户关注
    Route::post("/user/follow",'UserController@handleAjaxFollow')->name('userFollowOther');
    Route::post("/user/unfollow",'UserController@handleAjaxUnfollow')->name('userUnfollowOther');


//  上传部分
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
    Route::get("/news-category/{newsCategory}/up/order",'NewsCategoryController@turnUpOrder')->name('newsCategoryTurnUpNewsOrder');
    Route::get("/news-category/{newsCategory}/down/order",'NewsCategoryController@turnDownOrder')->name('newsCategoryTurnDownNewsOrder');

    //新闻管理模块
    Route::get("/news",'NewsController@adminListShow')->name('adminNewsList');
    Route::get("/news/create",'NewsController@adminCreateShow')->name('adminNewsCreate');
    Route::post("/news/store",'NewsController@store')->name('adminNewsStore');
    Route::get("/news/{news}/edit",'NewsController@adminEditShow')->name('adminNewsEdit');
    Route::post("/news/{news}/update",'NewsController@update')->name('adminNewsUpdate');
    Route::post("/news/delete",'NewsController@softDelete')->name('newsSoftDelete');
    Route::post("/news/deletes",'NewsController@softDeletes')->name('newsSoftDeletes');
    Route::get("/news/{news}/up/order",'NewsController@turnUpOrder')->name('newsTurnUpNewsOrder');
    Route::get("/news/{news}/down/order",'NewsController@turnDownOrder')->name('newsTurnDownNewsOrder');

    //新闻回复管理模块
    Route::get("/news/reply/all",'NewsReplyController@adminListShowAll')->name('adminNewsReplyAllList');
    Route::get("/news/{news}/reply",'NewsReplyController@adminListShow')->name('adminNewsReplyList');
    Route::get("/news/{news}/reply/create",'NewsReplyController@adminCreateShow')->name('adminNewsReplyCreate');
    Route::post("/news/{news}/reply/store",'NewsReplyController@store')->name('adminNewsReplyStore');
    Route::get("/news/{news}/reply/{reply}/edit",'NewsReplyController@adminEditShow')->name('adminNewsReplyEdit');
    Route::post("/news/{news}/reply/{reply}/update",'NewsReplyController@update')->name('adminNewsReplyUpdate');
    Route::post("/news/reply/delete",'NewsReplyController@softDelete')->name('newsReplySoftDelete');
    Route::post("/news/reply/deletes",'NewsReplyController@softDeletes')->name('newsReplySoftDeletes');

    //新闻轮播图管理模块
    Route::get("/news-carousel",'NewsCarouselController@adminListShow')->name('adminNewsCarouselsList');
    Route::get("/news-carousel/create",'NewsCarouselController@adminCreateShow')->name('adminNewsCarouselCreate');
    Route::post("/news-carousel/store",'NewsCarouselController@store')->name('adminNewsCarouselStore');
    Route::get("/news-carousel/{newsCarousel}/edit",'NewsCarouselController@adminEditShow')->name('adminNewsCarouselEdit');
    Route::post("/news-carousel/{newsCarousel}/update",'NewsCarouselController@update')->name('adminNewsCarouselUpdate');
    Route::post("/news-carousel/delete",'NewsCarouselController@softDelete')->name('newsCarouselSoftDelete');
    Route::get("/news-carousel/{newsCarousel}/up/order",'NewsCarouselController@turnUpOrder')->name('newsCarouselTurnUpNewsOrder');
    Route::get("/news-carousel/{newsCarousel}/down/order",'NewsCarouselController@turnDownOrder')->name('newsCarouselTurnDownNewsOrder');


    //新闻图片上传
    Route::post('/news/upload/img','NewsController@uploadImg')->name('uploadNewsImg');
    //新闻封面图片上传
    Route::post('/news/upload/cover','NewsController@uploadCover')->name('uploadNewsCover');
    //新闻轮播图上传
    Route::post('/news-carousel/upload','NewsCarouselController@uploadCover')->name('uploadNewsCover');

    //社区一二级分类管理模块
    Route::get("/community/category/zones-and-sections",'CommunityCategoryController@showZonesAndSections')->name('adminCommunityZonesAndSectionsShow');
    Route::get("/community/category/zone/create",'CommunityCategoryController@adminZoneCreateShow')->name('adminCommunityZoneCreate');
    Route::post("/community/category/zone/store",'CommunityCategoryController@adminZoneStore')->name('adminCommunityZoneStore');
    Route::get("/community/category/zone/{zone}/edit",'CommunityCategoryController@adminZoneEditShow')->name('adminCommunityZoneEdit');
    Route::post("/community/category/zone/{zone}/update",'CommunityCategoryController@adminZoneUpdate')->name('adminCommunityZoneUpdate');
    Route::post("/community/category/zone/delete",'CommunityCategoryController@zoneSoftDelete')->name('communityZoneSoftDelete');

    Route::get("/community/category/section/create",'CommunityCategoryController@adminSectionCreateShow')->name('adminCommunitySectionCreate');
    Route::post("/community/category/section/store",'CommunityCategoryController@adminSectionStore')->name('adminCommunitySectionStore');
    Route::get("/community/category/section/{section}/edit",'CommunityCategoryController@adminSectionEditShow')->name('adminCommunitySectionEdit');
    Route::post("/community/category/section/{section}/update",'CommunityCategoryController@adminSectionUpdate')->name('adminCommunitySectionUpdate');
    Route::post("/community/category/section/delete",'CommunityCategoryController@sectionSoftDelete')->name('communitySectionSoftDelete');

    //ajax通过zoneid获取sections
    Route::post('/community/category/getSectionsByZoneId','CommunityCategoryController@getSectionsByZoneId')->name('communitygetSectionsByZoneId');

    //社区话题管理模块
    Route::get("/community/topic",'CommunityTopicController@adminListShow')->name('adminCommunityTopicList');
    Route::get("/community/topic/show-by-category",'CommunityTopicController@adminListShowByCategory')->name('adminCommunityTopicListByCategory');
    Route::get("/community/topic/create",'CommunityTopicController@adminCreateShow')->name('adminCommunityTopicCreate');
    Route::post("/community/topic/store",'CommunityTopicController@store')->name('adminCommunityTopicStore');
    Route::get("/community/topic/{topic}/edit",'CommunityTopicController@adminEditShow')->name('adminCommunityTopicEdit');
    Route::post("/community/topic/{topic}/update",'CommunityTopicController@update')->name('adminCommunityTopicUpdate');
    Route::post("/community/topic/delete",'CommunityTopicController@softDelete')->name('communityTopicSoftDelete');
    Route::post("/community/topic/deletes",'CommunityTopicController@softDeletes')->name('communityTopicSoftDeletes');
    Route::get("/community/topic/{topic}/up/order",'CommunityTopicController@turnUpOrder')->name('communityTopicTurnUpOrder');
    Route::get("/community/topic/{topic}/down/order",'CommunityTopicController@turnDownOrder')->name('communityTopicTurnDownOrder');

    //社区话题回复管理模块
    Route::get("/community/topic/reply/all",'CommunityTopicReplyController@adminListShowAll')->name('adminCommunityTopicReplyAllList');
    Route::get("/community/topic/{topic}/reply",'CommunityTopicReplyController@adminListShow')->name('adminCommunityTopicReplyList');
    Route::get("/community/topic/{topic}/reply/create",'CommunityTopicReplyController@adminCreateShow')->name('adminCommunityTopicReplyCreate');
    Route::post("/community/topic/{topic}/reply/store",'CommunityTopicReplyController@store')->name('adminCommunityTopicReplyStore');
    Route::get("/community/topic/{topic}/reply/{reply}/edit",'CommunityTopicReplyController@adminEditShow')->name('adminCommunityTopicReplyEdit');
    Route::post("/community/topic/{topic}/reply/{reply}/update",'CommunityTopicReplyController@update')->name('adminCommunityTopicReplyUpdate');
    Route::post("/community/topic/reply/delete",'CommunityTopicReplyController@softDelete')->name('topicReplySoftDelete');
    Route::post("/community/topic/reply/deletes",'CommunityTopicReplyController@softDeletes')->name('topicReplySoftDeletes');

    //zone封面图片上传
    Route::post('/community/category/zones/upload/img','CommunityCategoryController@uploadZoneImg')->name('uploadZoneImg');


});
