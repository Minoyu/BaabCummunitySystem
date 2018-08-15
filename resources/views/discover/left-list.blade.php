<div class="mdui-card news-content-card" style="border-radius: 10px;padding-top: 0px">
    <div class="mdui-tab part-divider-tab" mdui-tab>
        <a mdui-tooltip="{content: '按最后回复排序', position: 'top'}" onclick="jumpTo('?view=all')" href="#" class="mdui-ripple">我关注的</a>
        <a mdui-tooltip="{content: '按最后回复排序', position: 'top'}" onclick="jumpTo('?view=all')" href="#" class="mdui-ripple">全站动态</a>
        <a mdui-tooltip="{content: '按最后回复排序', position: 'top'}" onclick="jumpTo('?view=all')" href="#" class="mdui-ripple">我的动态</a>
    </div>
    @include('discover.left-list-data')
    <div  id="ActivityListData"></div>
    <div id="ActivityListLoadingTip" class="mdui-m-y-2" style="display:none">
        <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
        <span class="loading-tip-text">正在加载更多</span>
    </div>
    <div id="ActivityListLoadingFailed" class="animated fadeIn faster" style="display:none">
        <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
        <span class="loading-tip-text">没有更多了</span>
    </div>
</div>