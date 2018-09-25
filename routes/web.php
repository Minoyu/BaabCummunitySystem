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



//社区页面
Route::get('/community','CommunityController@showCommunity')->name('showCommunity');
Route::get('/community/zone/{zone}','CommunityController@showCommunityZone')->name('showCommunityZone');
Route::get('/community/section/{section}','CommunityController@showCommunitySection')->name('showCommunitySection');
Route::get('/community/topic/{topic}','CommunityController@showCommunityContent')->name('showCommunityContent');
Route::post("/community/topic/vote/getVoters",'CommunityTopicController@ajaxGetVoters')->name('communityTopicGetVoters');



//切换语言
Route::get('/switch/lang','IndexController@switchLang')->name('switchLang');

//切换是否打开抽屉栏
Route::get('/switch/drawerClose','IndexController@handleDrawerDefaultClose')->name('switchDrawerClose');
Route::get('/switch/drawerOpen','IndexController@handleDrawerDefaultOpen')->name('switchDrawerOpen');

//用户登录、注册
Route::post('/auth/login','AuthController@login')->name('userLogin');
Route::get('/auth/not/login','AuthController@notLogin')->name('notLogin');
Route::post('/auth/checkEmailUnique','AuthController@checkEmailUnique')->name('userCheckEmail');
Route::post('/auth/register','AuthController@register')->name('userRegister');

//忘记密码重置
Route::post("/auth/resetPassword",'Auth\ResetPasswordController@handleResetPassword');
Route::get("/auth/resetPassword/{token}",'Auth\ResetPasswordController@showResetPage')->name('showResetPasswordPage');
Route::post("/auth/resetPassword/{token}",'Auth\ResetPasswordController@storeResetPassword')->name('storeResetPassword');

//用户相关
Route::get('/user/{user}','UserController@showPersonalCenter')->name('showPersonalCenter');
Route::post("/user/getFollowings",'UserController@ajaxGetFollowings')->name('userGetFollowings');
Route::post("/user/getFollowers",'UserController@ajaxGetFollowers')->name('userGetFollowers');

//  发现页面
Route::get("/discover",'DiscoverController@showDiscover')->name('showDiscover');

//搜索部分
Route::post('/search/tips','SearchController@discoverTips')->name('getSearchTips');
Route::get('/search','SearchController@showSearchRes')->name('showSearchRes');

Route::group(['middleware'=>'auth:web'],function (){

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });

    Route::group(['prefix' => 'testMessages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });

    Route::get('/auth/logout','AuthController@logout')->name('userLogout');

//  新闻回复
    Route::post("/news/{news}/reply/store",'NewsReplyController@store')->name('newsReplyStore');
    //新闻回复图片上传
    Route::post('/news/reply/upload/img','NewsController@uploadReplyImg')->name('uploadNewsImg');

//  社区话题回复
    Route::post("/community/topic/{topic}/reply/store",'CommunityTopicReplyController@store')->name('communityTopicReplyStore');

//  社区话题创建
    Route::get("/community/create/topic",'CommunityTopicController@create')->name('communityTopicCreate');
    Route::post("/community/create/topic/store",'CommunityTopicController@storeMini')->name('communityTopicStore');
    Route::get("/community/edit/topic/{topic}",'CommunityTopicController@edit')->name('communityTopicEdit');
    Route::post("/community/edit/topic/{topic}/update",'CommunityTopicController@updateMini')->name('communityTopicUpdate');

    //社区话题图片上传
    Route::post('/community/topic/upload/img','CommunityTopicController@uploadImg')->name('uploadCommunityTopicImg');
    Route::post('/community/topic/reply/upload/img','CommunityTopicController@uploadReplyImg')->name('uploadCommunityTopicReplyImg');

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


Route::group(['prefix'=>'admin','middleware' => ['role:Founder|Maintainer']],function () {
    Route::get("/",'NewsController@adminListShow')->name('showAdmin');

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
    Route::post('/news-carousel/upload','NewsCarouselController@uploadCover')->name('uploadNewsCarousel');

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
    Route::get("/community/topic/{topic}/toggle/excellent",'CommunityTopicController@toggleExcellent')->name('communityTopicToggleExcellent');

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

    Route::group(['middleware' => ['role:Founder']],function (){
        //用户及权限管理模块
        Route::get("/user",'Admin\AdminUserController@showUsersList')->name('adminShowUsersList');
        Route::get("/user/{user}/edit",'Admin\AdminUserController@showUserEdit')->name('adminShowUserEdit');
        Route::post("/user/{user}/update",'Admin\AdminUserController@userEditUpdate')->name('adminUserEditUpdate');
        Route::post("/user/delete",'Admin\AdminUserController@softDelete')->name('adminUserDelete');
        Route::post("/user/deletes",'Admin\AdminUserController@softDeletes')->name('adminUserDeletes');
        Route::post("/user/changeRoles",'Admin\AdminUserController@changeRoles')->name('adminUserChangeRoles');

        //角色管理模块
        Route::get("/role",'Admin\AdminRolesController@showRoleList')->name('adminShowRolesList');
        Route::get("/role/create",'Admin\AdminRolesController@showCreatRole')->name('adminShowCreateRole');
        Route::post("/role/remove/permission",'Admin\AdminRolesController@removePermission')->name('adminRoleRemoveRole');
        Route::post("/role/store",'Admin\AdminRolesController@store')->name('adminRoleStore');
        Route::get("/role/{role}/edit",'Admin\AdminRolesController@showEditRole')->name('adminShowRoleEdit');
        Route::post("/role/{role}/update",'Admin\AdminRolesController@update')->name('adminRoleUpdate');
        Route::post("/role/delete",'Admin\AdminRolesController@delete')->name('adminRoleDelete');


        //权限管理模块
        Route::get("/permission",'Admin\AdminPermissionController@showPermissionList')->name('adminShowPermissionsList');
        Route::get("/permission/create",'Admin\AdminPermissionController@showCreatPermission')->name('adminShowCreatePermission');
        Route::post("/permission/remove/role",'Admin\AdminPermissionController@removeRole')->name('adminPermissionRemoveRole');
        Route::post("/permission/store",'Admin\AdminPermissionController@store')->name('adminPermissionStore');
        Route::get("/permission/{permission}/edit",'Admin\AdminPermissionController@showEditPermission')->name('adminShowPermissionEdit');
        Route::post("/permission/{permission}/update",'Admin\AdminPermissionController@update')->name('adminPermissionUpdate');
        Route::post("/permission/delete",'Admin\AdminPermissionController@delete')->name('adminPermissionDelete');
    });


    //首页轮播图管理模块
    Route::get("/index-carousel",'IndexCarouselController@adminListShow')->name('adminIndexCarouselsList');
    Route::get("/index-carousel/create",'IndexCarouselController@adminCreateShow')->name('adminIndexCarouselCreate');
    Route::post("/index-carousel/store",'IndexCarouselController@store')->name('adminIndexCarouselStore');
    Route::get("/index-carousel/{indexCarousel}/edit",'IndexCarouselController@adminEditShow')->name('adminIndexCarouselEdit');
    Route::post("/index-carousel/{indexCarousel}/update",'IndexCarouselController@update')->name('adminIndexCarouselUpdate');
    Route::post("/index-carousel/delete",'IndexCarouselController@softDelete')->name('indexCarouselSoftDelete');
    Route::get("/index-carousel/{indexCarousel}/up/order",'IndexCarouselController@turnUpOrder')->name('indexCarouselTurnUpNewsOrder');
    Route::get("/index-carousel/{indexCarousel}/down/order",'IndexCarouselController@turnDownOrder')->name('indexCarouselTurnDownNewsOrder');

    Route::post('/index-carousel/upload','IndexCarouselController@uploadCover')->name('uploadIndexCarousel');

    //首页头条管理模块
    Route::get("/index-headline",'IndexHeadlineController@adminListShow')->name('adminIndexHeadlinesList');
    Route::get("/index-headline/create",'IndexHeadlineController@adminCreateShow')->name('adminIndexHeadlineCreate');
    Route::post("/index-headline/store",'IndexHeadlineController@store')->name('adminIndexHeadlineStore');
    Route::get("/index-headline/{indexHeadline}/edit",'IndexHeadlineController@adminEditShow')->name('adminIndexHeadlineEdit');
    Route::post("/index-headline/{indexHeadline}/update",'IndexHeadlineController@update')->name('adminIndexHeadlineUpdate');
    Route::post("/index-headline/delete",'IndexHeadlineController@softDelete')->name('indexHeadlineSoftDelete');
    Route::get("/index-headline/{indexHeadline}/up/order",'IndexHeadlineController@turnUpOrder')->name('indexHeadlineTurnUpNewsOrder');
    Route::get("/index-headline/{indexHeadline}/down/order",'IndexHeadlineController@turnDownOrder')->name('indexHeadlineTurnDownNewsOrder');


});

//Route::get('/test/welcome', function () {
//    $user = \App\Model\User::find(1);
//
//    return new App\Mail\SendWelcomeEmail($user->name);
//});