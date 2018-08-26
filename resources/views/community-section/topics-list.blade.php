<a name="topicList" id="topicList"></a>
<h1 class="part-title-with-bg">{{__('community.topics')}}</h1>
<div class="mdui-tab part-divider-tab" mdui-tab>
    <a mdui-tooltip="{content: '{{__('community.activeTip')}}', position: 'top'}" onclick="jumpTo('?orderBy=default#topicList')" href="#" class="mdui-ripple">{{__('community.active')}}</a>
    <a mdui-tooltip="{content: '{{__('community.excellentTip')}}', position: 'top'}" onclick="jumpTo('?orderBy=excellent#topicList')" href="#" class="mdui-ripple @if($orderBy == 'excellent') mdui-tab-active @endif">{{__('community.excellent')}}</a>
    <a mdui-tooltip="{content: '{{__('community.likesTip')}}', position: 'top'}" onclick="jumpTo('?orderBy=thumb_up#topicList')" href="#" class="mdui-ripple @if($orderBy == 'thumb_up') mdui-tab-active @endif">{{__('community.likes')}}</a>
    <a mdui-tooltip="{content: '{{__('community.latestTip')}}', position: 'top'}" onclick="jumpTo('?orderBy=recent#topicList')" href="#" class="mdui-ripple @if($orderBy == 'recent') mdui-tab-active @endif">{{__('layout.latest')}}</a>
    <a mdui-tooltip="{content: '{{__('community.no_reply')}}', position: 'top'}" onclick="jumpTo('?orderBy=no_reply#topicList')" href="#" class="mdui-ripple @if($orderBy == 'no_reply') mdui-tab-active @endif">{{__('community.no_reply')}}</a>
</div>
<ul class="mdui-list community-topic-list">
    @include('community-section.topics-list-data')
    <div  id="CommunityTopicsData"></div>
    <div id="CommunityTopicsLoadingBtn" class="mdui-m-y-1" style="">
        <button onclick="ajaxLoadCommunityTopics()" class="mdui-btn mdui-color-pink-a200 mdui-ripple mdui-center">
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

</ul>