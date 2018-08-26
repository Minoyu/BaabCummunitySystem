@php($isAllEmpty = true)
@if($community_zones->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon material-icons">view_list</i> {{__('index.community')}}
        </div>
        <div class="search-card-content">
            @foreach($community_zones as $community_zone)
             <a href="{{route('showCommunityZone',$community_zone->id)}}">
                 <div class="community-cat-search-res-item">
                     <img src="{{$community_zone->img_url}}">
                     <div class="cat-title">
                         <span class="layui-badge">{{__('community.zone')}}</span>
                         {{$community_zone->name}}

                     </div>
                     <div class="cat-subtitle">
                         {{__('index.sectionsCount')}} {{$community_zone->section_count}} · {{__('index.postsCount')}} {{$community_zone->topic_count}}
                     </div>
                 </div>
             </a>
            @endforeach
            @foreach($community_sections as $community_section)
             <a href="{{route('showCommunityZone',$community_section->id)}}">
                 <div class="community-cat-search-res-item">
                     <img src="{{$community_section->img_url}}">
                     <div class="cat-title">
                         <span class="layui-badge layui-bg-green">{{__('community.section')}}</span>
                         {{$community_section->name}}

                     </div>
                     <div class="cat-subtitle">
                         {{__('index.postsCount')}} {{$community_section->topic_count}}
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
            <i class="mdui-icon material-icons">account_circle</i> {{__('discover.users')}}
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
                                        <span>{{__('user.followed')}}</span>
                                    </a>
                                @else
                                    <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$user_item['user']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-text-color-pink-accent mdui-btn-raised">
                                        <i class="mdui-icon material-icons mdui-icon-left">&#xe87e;</i>
                                        <span>{{__('user.follow')}}</span>
                                    </a>
                                @endif
                            @endif
                        </div>
                        <div class="user-info">
                            {{__('user.following')}} {{$user_item['followingsCount']}} · {{__('user.followers')}} {{$user_item['followersCount']}}
                           <span class="mdui-hidden-xs"> · {{$user_item['user']->info->motto}}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="search-card-view-more">
            <button class="mdui-btn mdui-btn-dense mdui-text-color-blue-800 mdui-center" onclick="searchJumpTo('user')">
                {{__('discover.viewMoreUsers')}} >
            </button>
        </div>
    </div>
@endif

@if($news_categories->isNotEmpty()||$newses->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon ion-md-paper"></i> {{__('index.news')}}
        </div>
        <div class="search-card-content">
            @if($news_categories->isNotEmpty())
                <ul class="mdui-list">
                    @foreach($news_categories as $news_category)
                        <a href="{{route('showNewsSec',$news_category->id)}}">
                            <li class="mdui-list-item mdui-ripple">
                                <i class="mdui-list-item-icon mdui-icon material-icons">{{$news_category->icon}}</i>
                                <div class="mdui-list-item-content">
                                    <span class="layui-badge">{{__('discover.categories')}}</span>
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
                {{__('discover.viewMoreNews')}} >
            </button>
        </div>
    </div>
@endif
@if($community_topics->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon material-icons">bubble_chart</i> {{__('discover.communityTopics')}}
        </div>
        <div class="search-card-content community-topic-list">
            @include('discover-search-res.left-list-topic-data')
            <div  id="CommunityTopicsData"></div>
            <div id="CommunityTopicsLoadingBtn" class="mdui-m-y-1" style="">
                <button onclick="ajaxLoadSearchCommunityTopics()" class="mdui-btn mdui-color-pink-a200 mdui-ripple mdui-center">
                    <i class="mdui-icon material-icons mdui-icon-left">&#xe627;</i>
                    {{__('layout.loadMore')}}
                </button>
            </div>
            <div id="CommunityTopicsLoadingTip" class="mdui-m-y-1" style="display:none">
                <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
                <span class="loading-tip-text">{{__('layout.loadingMore')}}</span>
            </div>
            <div id="CommunityTopicsLoadingFailed" class="animated fadeIn faster" style="display:none">
                <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
                <span class="loading-tip-text">{{__('layout.noAnyMore')}}</span>
            </div>

        </div>
    </div>
@endif
@if($isAllEmpty)
    @include('discover-search-res.all-empty-res')
@endif
