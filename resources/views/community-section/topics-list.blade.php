<h1 class="part-title-with-bg">Topics</h1>
<div class="mdui-tab part-divider-tab" mdui-tab>
    <a mdui-tooltip="{content: '按最后回复排序', position: 'top'}" onclick="jumpTo('?orderBy=default')" href="#" class="mdui-ripple">活跃</a>
    <a mdui-tooltip="{content: '只显示精华话题', position: 'top'}" onclick="jumpTo('?orderBy=excellent')" href="#" class="mdui-ripple @if($orderBy == 'excellent') mdui-tab-active @endif">精华</a>
    <a mdui-tooltip="{content: '按点赞数排序', position: 'top'}" onclick="jumpTo('?orderBy=thumb_up')" href="#" class="mdui-ripple @if($orderBy == 'thumb_up') mdui-tab-active @endif">赞数</a>
    <a mdui-tooltip="{content: '按发布时间排序', position: 'top'}" onclick="jumpTo('?orderBy=recent')" href="#" class="mdui-ripple @if($orderBy == 'recent') mdui-tab-active @endif">最近</a>
    <a mdui-tooltip="{content: '未回复过的话题', position: 'top'}" onclick="jumpTo('?orderBy=no_reply')" href="#" class="mdui-ripple @if($orderBy == 'no_reply') mdui-tab-active @endif">零回复</a>
</div>
<ul class="mdui-list community-topic-list">
    @include('community-section.topics-list-data')
    <div  id="CommunityTopicsData"></div>
    <div id="CommunityTopicsLoadingBtn" class="mdui-m-y-1" style="">
        <button onclick="ajaxLoadCommunityTopics()" class="mdui-btn mdui-color-pink-a200 mdui-ripple mdui-center">
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

</ul>