<div class="mdui-panel mdui-hidden-md-up" mdui-panel>
    <div class="mdui-panel-item">
        <div class="mdui-panel-item-header">
            <div class="mdui-panel-item-title" style="width: auto">新闻版块</div>
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
<h2 class="title-with-bottom-border mdui-m-t-2 mdui-p-x-2 mdui-p-t-2 mdui-m-b-0 mdui-card" style="padding-bottom: 12px">
    热点新闻
</h2>
<div class="mdui-card mdui-p-t-1 mdui-m-b-5">
    @include('news.left-list-data')
    <div  id="NewsCenterData"></div>
    <div id="NewsCenterLoadingTip" class="mdui-m-y-2" style="display:none">
        <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
        <span class="loading-tip-text">正在加载更多</span>
    </div>
    <div id="NewsCenterLoadingFailed" style="display:none">
        <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
        <span class="loading-tip-text">没有更多了</span>
    </div>

</div>