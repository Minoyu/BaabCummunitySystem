<div class="mdui-card news-content-card" style="border-radius: 10px;padding-top: 5px;padding-bottom: 0px">
    <h1 class="part-title-with-bg mdui-m-y-1">
        {{$keywords}} - 搜索结果
    </h1>
    <div class="mdui-tab part-divider-tab" mdui-tab>
        <a mdui-tooltip="{content: '综合搜索结果', position: 'top'}" onclick="searchJumpTo('default')" href="#" class="mdui-ripple @if($type =='default') mdui-tab-active  @endif">综合</a>
        <a mdui-tooltip="{content: '用户搜索结果', position: 'top'}" onclick="searchJumpTo('user')" href="#" class="mdui-ripple @if($type =='user') mdui-tab-active  @endif">用户</a>
        <a mdui-tooltip="{content: '话题搜索结果', position: 'top'}" onclick="searchJumpTo('topic')" href="#" class="mdui-ripple @if($type =='topic') mdui-tab-active  @endif">话题</a>
        <a mdui-tooltip="{content: '新闻搜索结果', position: 'top'}" onclick="searchJumpTo('news')" href="#" class="mdui-ripple @if($type =='news') mdui-tab-active  @endif">新闻</a>
    </div>
</div>
@include('discover-search-res.left-list-data')
