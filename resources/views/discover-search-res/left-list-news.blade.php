@php($isAllEmpty = true)
@if($newses->isNotEmpty())
    @php($isAllEmpty = false)
    <div class="mdui-card mdui-m-t-1" style="border-radius: 10px">
        <div class="search-card-header">
            <i class="mdui-icon ion-md-paper"></i> {{__('index.news')}}
        </div>
        <div class="search-card-content">
            @include('discover-search-res.left-list-news-data')
            <div  id="NewsData"></div>
            <div id="NewsLoadingBtn" class="mdui-m-y-1" style="">
                <button onclick="ajaxLoadSearchNews()" class="mdui-btn mdui-color-pink-a200 mdui-ripple mdui-center">
                    <i class="mdui-icon material-icons mdui-icon-left">&#xe627;</i>
                    {{__('layout.loadMore')}}
                </button>
            </div>
            <div id="NewsLoadingTip" class="mdui-m-y-1" style="display:none">
                <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
                <span class="loading-tip-text">{{__('layout.loadingMore')}}</span>
            </div>
            <div id="NewsLoadingFailed" class="animated fadeIn faster" style="display:none">
                <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
                <span class="loading-tip-text">{{__('layout.noAnyMore')}}</span>
            </div>
        </div>
    </div>
@endif

@if($isAllEmpty)
    @include('discover-search-res.all-empty-res')
@endif
