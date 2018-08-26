<div class="mdui-card news-content-card" style="border-radius: 10px;padding-top: 5px;padding-bottom: 0px">
    <h1 class="part-title-with-bg mdui-m-y-1">
        {{$keywords}} - {{__('discover.searchRes')}}
    </h1>
    <div class="mdui-tab part-divider-tab" mdui-tab>
        <a mdui-tooltip="{content: '{{__('discover.complexTip')}}', position: 'top'}" onclick="searchJumpTo('default')" href="#" class="mdui-ripple @if($type =='default') mdui-tab-active  @endif">{{__('discover.complex')}}</a>
        <a mdui-tooltip="{content: '{{__('discover.usersTip')}}', position: 'top'}" onclick="searchJumpTo('user')" href="#" class="mdui-ripple @if($type =='user') mdui-tab-active  @endif">{{__('discover.users')}}</a>
        <a mdui-tooltip="{content: '{{__('discover.topicsTip')}}', position: 'top'}" onclick="searchJumpTo('topic')" href="#" class="mdui-ripple @if($type =='topic') mdui-tab-active  @endif">{{__('community.topics')}}</a>
        <a mdui-tooltip="{content: '{{__('index.news')}}', position: 'top'}" onclick="searchJumpTo('news')" href="#" class="mdui-ripple @if($type =='news') mdui-tab-active  @endif">{{__('index.news')}}</a>
    </div>
</div>
@if($type == 'user')
    @include('discover-search-res.left-list-user')
@elseif($type == 'topic')
    @include('discover-search-res.left-list-topic')
@elseif($type == 'news')
    @include('discover-search-res.left-list-news')
@else
    @include('discover-search-res.left-list-data')
@endif
