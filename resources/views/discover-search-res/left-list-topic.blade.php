@php($isAllEmpty = true)
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
