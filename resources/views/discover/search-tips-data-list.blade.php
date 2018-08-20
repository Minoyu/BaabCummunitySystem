<div id="searchTipsContent">
    @php($isAllEmpty = true)
    @if($community_zones->isNotEmpty())
        @php($isAllEmpty = false)
        <li class="mdui-menu-item search-tips search-tips-type">
                 <a class="mdui-ripple">
                     <i class="mdui-icon material-icons">view_list</i> 社区分区及板块
                 </a>
            </li>
        <li class="mdui-divider"></li>
        @foreach($community_zones as $community_zone)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showCommunityZone',$community_zone->id)}}" class="mdui-ripple">
                    <span class="layui-badge">分区</span>
                    {{$community_zone->name}}
                </a>
            </li>
        @endforeach
        @foreach($community_sections as $community_section)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showCommunitySection',$community_section->id)}}" class="mdui-ripple">
                    <span class="layui-badge layui-bg-green">板块</span>
                    {{$community_section->name}}
                </a>
            </li>
        @endforeach
    @endif
    @if($news_categories->isNotEmpty())
        @php($isAllEmpty = false)
        <li class="mdui-menu-item search-tips search-tips-type">
                 <a class="mdui-ripple">
                     <i class="mdui-icon material-icons">view_list</i> 新闻板块
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
                     <i class="mdui-icon material-icons">account_circle</i> 用户
                 </a>
            </li>
        <li class="mdui-divider"></li>
        @foreach($users as $user)
            <li class="mdui-menu-item search-tips search-tips-item">
                <a href="{{route('showPersonalCenter',$user->id)}}" class="mdui-ripple">{{$user->name}}</a>
            </li>
        @endforeach
    @endif
    @if($newses->isNotEmpty())
        @php($isAllEmpty = false)
        <li class="mdui-menu-item search-tips search-tips-type">
                 <a class="mdui-ripple">
                     <i class="mdui-icon ion-md-paper"></i> 新闻
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
                     <i class="mdui-icon material-icons">bubble_chart</i> 社区话题
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
                 <i class="mdui-icon material-icons">feedback</i>  暂无相关搜索推荐 您可以回车尝试详细搜索
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
</div>
