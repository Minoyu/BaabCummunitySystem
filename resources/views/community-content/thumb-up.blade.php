<div class="mdui-card mdui-m-t-2 community-topic-thumb-up-card">
    <button onclick="ajaxHandleTopicVote('{{route('communityTopicVote')}}','{{route('communityTopicCancelVote')}}','{{$topic->id}}',this,'topic-thumb-up-num')"
            class="mdui-btn mdui-btn-icon @if(Auth::user()->hasVoted($topic)) mdui-color-pink-accent @else mdui-text-color-pink-accent @endif mdui-ripple mdui-center thumb-up-btn">

        <i class="mdui-icon material-icons">thumb_up</i>
    </button>
    <div class="mdui-panel" mdui-panel>
        <div class="mdui-panel-item" id="seeMoreTopicVoter">
            <div onclick="ajaxGetTopicVoters('{{route('communityTopicGetVoters')}}','{{$topic->id}}')" class="mdui-panel-item-header">
                <div class="mdui-panel-item-title">已有<span class="mdui-text-color-pink topic-thumb-up-num">{{$topic->thumb_up_count}}</span>人觉得很赞</div>
                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-panel-item-body">
                <div id="TopicVotersLoadingTip" class="mdui-m-y-1">
                    <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
                    <span class="loading-tip-text">正在加载</span>
                </div>
                <div id="TopicVotersLoadingFailed" class="animated fadeIn faster" style="display: none">
                    <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">&#xe420;</i>
                    <span class="loading-tip-text">成为第一个点赞的人吧</span>
                </div>
                <div id="TopicVotersData" class="topic-voters-list"></div>
            </div>
        </div>
    </div>
</div>