@php($isAllEmpty = true)
@if($community_topics->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon material-icons">bubble_chart</i> {{__('discover.communityTopics')}}
        </div>
        <div class="search-card-content community-topic-list">
            @include('discover-search-res.left-list-topic-data')
            <div  id="CommunityTopicsData"></div>
            <div id="CommunityTopicsLoadingBtn" class="mdui-m-y-1" style="">
                <button onclick="ajaxLoadSearchCommunityTopics()" class="mdui-btn mdui-color-pink-a200 mdui-ripple mdui-center">
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

        </div>
    </div>
@endif
@if($isAllEmpty)
    @include('discover-search-res.all-empty-res')
@endif
