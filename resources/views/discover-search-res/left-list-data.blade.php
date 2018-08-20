@php($isAllEmpty = true)
@if($community_zones->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon material-icons">view_list</i> 社区分区及板块
        </div>
        <div class="search-card-content">
            @foreach($community_zones as $community_zone)
             <a href="{{route('showCommunityZone',$community_zone->id)}}">
                 <div class="community-cat-search-res-item">
                     <img src="{{$community_zone->img_url}}">
                     <div class="cat-title">
                         <span class="layui-badge">分区</span>
                         {{$community_zone->name}}

                     </div>
                     <div class="cat-subtitle">
                         板块数 {{$community_zone->section_count}} · 话题数 {{$community_zone->topic_count}}
                     </div>
                 </div>
             </a>
            @endforeach
            @foreach($community_sections as $community_section)
             <a href="{{route('showCommunityZone',$community_section->id)}}">
                 <div class="community-cat-search-res-item">
                     <img src="{{$community_section->img_url}}">
                     <div class="cat-title">
                         <span class="layui-badge layui-bg-green">板块</span>
                         {{$community_section->name}}

                     </div>
                     <div class="cat-subtitle">
                         话题数 {{$community_section->topic_count}}
                     </div>
                 </div>
             </a>
            @endforeach

        </div>
    </div>
@endif
@if($user_collection->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon material-icons">account_circle</i> 用户
        </div>
        <div class="search-card-content">
            @foreach($user_collection as $user_item)
                <a href="{{route('showPersonalCenter',$user_item['user']->id)}}">
                    <div class="user-search-res-item">
                        <img src="{{$user_item['user']->info->avatar_url}}">
                        <div class="user-name">
                            {{$user_item['user']->name}}
                            {{--关注按钮--}}
                            @if((Auth::check() && $user_item['user']->id != Auth::id()) || !Auth::check())
                                @if( Auth::check() && $user_item['user']->isFollowedBy(Auth::user()))
                                    <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$user_item['user']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-color-pink-accent mdui-btn-raised">
                                        <i class="mdui-icon material-icons mdui-icon-left">&#xe87d;</i>
                                        <span>已关注</span>
                                    </a>
                                @else
                                    <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$user_item['user']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-text-color-pink-accent mdui-btn-raised">
                                        <i class="mdui-icon material-icons mdui-icon-left">&#xe87e;</i>
                                        <span>关注</span>
                                    </a>
                                @endif
                            @endif
                        </div>
                        <div class="user-info">
                            关注了 {{$user_item['followingsCount']}} · 关注者 {{$user_item['followersCount']}}
                           <span class="mdui-hidden-xs"> · {{$user_item['user']->info->motto}}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="search-card-view-more">
            <button class="mdui-btn mdui-btn-dense mdui-text-color-blue-800 mdui-center" onclick="searchJumpTo('user')">
                查看更多用户搜索结果 >
            </button>
        </div>
    </div>
@endif

@if($news_categories->isNotEmpty()||$newses->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon ion-md-paper"></i> 新闻
        </div>
        <div class="search-card-content">
            @if($news_categories->isNotEmpty())
                <ul class="mdui-list">
                    @foreach($news_categories as $news_category)
                        <a href="{{route('showNewsSec',$news_category->id)}}">
                            <li class="mdui-list-item mdui-ripple">
                                <i class="mdui-list-item-icon mdui-icon material-icons">{{$news_category->icon}}</i>
                                <div class="mdui-list-item-content">
                                    <span class="layui-badge">新闻板块</span>
                                    {{$news_category->name}}
                                </div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            @endif
            @foreach($newses as $news)
                @if($news->cover_img)
                    <a href="{{route('showNewsContent',$news->id)}}">
                        <div class="news-list-item">
                            <img class="news-list-item-img" src="{{$news->cover_img}}">
                            <div class="news-list-item-title mdui-text-color-indigo">{{$news->title}}</div>
                            <div class="news-list-item-content mdui-hidden-xs">{{str_limit(strip_tags($news->content), $limit = 120, $end = '...')}}</div>
                            <a href="{{route('showNewsSec',$news->newsCategory->id)}}" class="news-list-item-part-name">{{$news->newsCategory->name}}</a>
                        </div>
                    </a>
                @else
                    <a href="{{route('showNewsContent',$news->id)}}">
                        <div class="news-list-item-without-img">
                            <div class="news-list-item-title mdui-text-color-indigo">{{$news->title}}</div>
                            <div class="news-list-item-content">{!!str_limit(strip_tags($news->content), $limit = 120, $end = '...')!!}</div>
                            <a href="{{route('showNewsSec',$news->newsCategory->id)}}" class="news-list-item-part-name">{{$news->newsCategory->name}}</a>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
        <div class="search-card-view-more">
            <button class="mdui-btn mdui-btn-dense mdui-text-color-pink mdui-center" onclick="searchJumpTo('news')">
                查看更多新闻搜索结果 >
            </button>
        </div>
    </div>
@endif
@if($community_topics->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon material-icons">bubble_chart</i> 社区话题
        </div>
        <div class="search-card-content community-topic-list">
            @include('discover-search-res.left-list-topic-data')
            <div  id="CommunityTopicsData"></div>
            <div id="CommunityTopicsLoadingBtn" class="mdui-m-y-1" style="">
                <button onclick="ajaxLoadSearchCommunityTopics()" class="mdui-btn mdui-color-pink-a200 mdui-ripple mdui-center">
                    <i class="mdui-icon material-icons mdui-icon-left">&#xe627;</i>
                    加载更多
                </button>
            </div>
            <div id="CommunityTopicsLoadingTip" class="mdui-m-y-1" style="display:none">
                <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
                <span class="loading-tip-text">正在加载更多</span>
            </div>
            <div id="CommunityTopicsLoadingFailed" class="animated fadeIn faster" style="display:none">
                <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
                <span class="loading-tip-text">没有更多了</span>
            </div>

        </div>
    </div>
@endif
@if($isAllEmpty)
    <li class="mdui-menu-item search-tips search-tips-null mdui-m-t-5" style="font-size: 18px">
        <a class="mdui-ripple mdui-text-color-grey-800">
            <i class="mdui-icon material-icons">feedback</i>  暂未搜索到相关内容
        </a>
    </li>
    <li class="mdui-menu-item search-tips search-tips-null">
        <a class="mdui-ripple mdui-text-color-grey">
            : ) 目前 您可以尝试输入您所想要查找的
        </a>
    </li>
    <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
        <a class="mdui-ripple mdui-text-color-grey">
            <i class="mdui-icon ion-md-paper"></i> 新闻
        </a>
    </li>
    <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
        <a class="mdui-ripple mdui-text-color-grey">
            <i class="mdui-icon material-icons">bubble_chart</i> 社区话题
        </a>
    </li>
    <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
        <a class="mdui-ripple mdui-text-color-grey">
            <i class="mdui-icon material-icons">account_circle</i> 用户
        </a>
    </li>
    <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
        <a class="mdui-ripple mdui-text-color-grey">
            <i class="mdui-icon material-icons">view_list</i> 新闻版块、社区分区及板块
        </a>
    </li>
@endif
