<div class="mdui-panel mdui-hidden-md-up" mdui-panel>
    <div class="mdui-panel-item">
        <div class="mdui-panel-item-header">
            <div class="mdui-panel-item-title" style="width: auto">{{__('discover.newsCategories')}}</div>
            <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
        </div>
        <div class="mdui-panel-item-body">
            <ul class="mdui-list">
                @foreach($newsCategories as $newsCategory)
                    <a href="{{route('showNewsSec',$newsCategory->id)}}">
                        <li class="mdui-list-item mdui-ripple">
                            <i class="mdui-list-item-icon mdui-icon material-icons">{{$newsCategory->icon}}</i>
                            <div class="mdui-list-item-content">{{$newsCategory->name}}</div>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="mdui-card mdui-p-x-2 mdui-m-t-2 mdui-m-b-5" style="border-radius: 8px">
    <h2 class="part-title-red mdui-m-t-2">
        <i class="mdui-icon material-icons">explore</i>
        {{__('news.hotNews')}}
    </h2>
    @include('news.left-list-data')
    <div  id="NewsCenterData"></div>
    <div id="NewsCenterLoadingTip" class="mdui-m-y-2" style="display:none">
        <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
        <span class="loading-tip-text">{{__('layout.loadingMore')}}</span>
    </div>
    <div id="NewsCenterLoadingFailed" class="animated fadeIn faster" style="display:none">
        <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
        <span class="loading-tip-text">{{__('layout.noAnyMore')}}</span>
    </div>

</div>