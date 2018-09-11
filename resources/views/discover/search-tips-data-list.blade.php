<div id="searchTipsContent">
    @php($isAllEmpty = true)
    @if($community_zones->isNotEmpty())
        @php($isAllEmpty = false)
        <li class="mdui-menu-item search-tips search-tips-type">
                 <a class="mdui-ripple">
                     <i class="mdui-icon material-icons">view_list</i> {{__('discover.communityZonesAndSections')}}
                 </a>
            </li>
        <li class="mdui-divider"></li>
        @foreach($community_zones as $community_zone)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showCommunityZone',$community_zone->id)}}" class="mdui-ripple">
                    <span class="layui-badge">{{__('community.zone')}}</span>
                    {{$community_zone->name}}
                </a>
            </li>
        @endforeach
        @foreach($community_sections as $community_section)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showCommunitySection',$community_section->id)}}" class="mdui-ripple">
                    <span class="layui-badge layui-bg-green">{{__('community.section')}}</span>
                    {{$community_section->name}}
                </a>
            </li>
        @endforeach
    @endif
    @if($news_categories->isNotEmpty())
        @php($isAllEmpty = false)
        <li class="mdui-menu-item search-tips search-tips-type">
                 <a class="mdui-ripple">
                     <i class="mdui-icon material-icons">view_list</i> {{__('discover.newsCategories')}}
                 </a>
            </li>
        <li class="mdui-divider"></li>
        @foreach($news_categories as $news_category)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showNewsSec',$news_category->id)}}" class="mdui-ripple">{{$news_category->name}}</a>
            </li>
        @endforeach
    @endif
    @if($users->isNotEmpty())
        @php($isAllEmpty = false)
        <li class="mdui-menu-item search-tips search-tips-type">
                 <a class="mdui-ripple">
                     <i class="mdui-icon material-icons">account_circle</i> {{__('discover.users')}}
                 </a>
            </li>
        <li class="mdui-divider"></li>
        @foreach($users as $user)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showPersonalCenter',$user->id)}}" class="mdui-ripple">{{$user->name}}
                    @foreach($user->roles as $role)
                        @switch($role->name)
                            @case('Founder')
                            <span class="layui-badge">{{$role->name}}</span>
                            @break
                            @case('Maintainer')
                            <span class="layui-badge layui-bg-blue">{{$role->name}}</span>
                            @break
                            @case('BanedUser')
                            <span class="layui-badge layui-bg-black">Banned</span>
                            @break
                        @endswitch
                    @endforeach
                </a>
            </li>
        @endforeach
    @endif
    @if($newses->isNotEmpty())
        @php($isAllEmpty = false)
        <li class="mdui-menu-item search-tips search-tips-type">
                 <a class="mdui-ripple">
                     <i class="mdui-icon ion-md-paper"></i> {{__('index.news')}}
                 </a>
            </li>
        <li class="mdui-divider"></li>
        @foreach($newses as $news)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showNewsContent',$news->id)}}" class="mdui-ripple">{{$news->title}}</a>
            </li>
        @endforeach
    @endif
    @if($community_topics->isNotEmpty())
        @php($isAllEmpty = false)
        <li class="mdui-menu-item search-tips search-tips-type">
                 <a class="mdui-ripple">
                     <i class="mdui-icon material-icons">bubble_chart</i> {{__('discover.communityTopics')}}
                 </a>
            </li>
        <li class="mdui-divider"></li>
        @foreach($community_topics as $community_topic)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showCommunityContent',$community_topic->id)}}" class="mdui-ripple">{{$community_topic->title}}</a>
            </li>
        @endforeach
    @endif
    @if($isAllEmpty)
        <li class="mdui-menu-item search-tips search-tips-null">
             <a class="mdui-ripple mdui-text-color-grey-800">
                 <i class="mdui-icon material-icons">feedback</i>  {{__('discover.noRecommendTips')}}
             </a>
        </li>
        <li class="mdui-menu-item search-tips search-tips-null">
            <a class="mdui-ripple mdui-text-color-grey">
                : ) {{__('discover.searchTipHeader')}}
            </a>
        </li>
        <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
            <a class="mdui-ripple mdui-text-color-grey">
                <i class="mdui-icon ion-md-paper"></i> {{__('index.news')}}
            </a>
        </li>
        <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
            <a class="mdui-ripple mdui-text-color-grey">
                <i class="mdui-icon material-icons">bubble_chart</i> {{__('discover.communityTopics')}}
            </a>
        </li>
        <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
            <a class="mdui-ripple mdui-text-color-grey">
                <i class="mdui-icon material-icons">account_circle</i> {{__('discover.users')}}
            </a>
        </li>
        <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
            <a class="mdui-ripple mdui-text-color-grey">
                <i class="mdui-icon material-icons">view_list</i> {{__('discover.categories')}}
            </a>
        </li>
    @endif
</div>
