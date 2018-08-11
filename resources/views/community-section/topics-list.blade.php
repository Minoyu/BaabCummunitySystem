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
</ul>