<div class="mdui-card " style="border-radius: 10px">
    <h1 style="text-align: center">
        {{$cat->name}} <small>· <a href="{{route('showNews')}}" style="font-size: 70%">新闻中心</a></small>
    </h1>
    <div class="mdui-panel mdui-hidden-md-up" mdui-panel>
        <div class="mdui-panel-item" style="box-shadow: none;-webkit-box-shadow: none">
            <div class="mdui-panel-item-header" style="background: #f6f6f6">
                <div class="mdui-panel-item-title" style="width: auto">查看新闻版块</div>
                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-panel-item-body">
                <ul class="mdui-list">
                    @foreach($newsCategories as $newsCategory)
                        <a href="{{route('showNewsSec',$newsCategory->id)}}">
                            <li class="mdui-list-item mdui-ripple @if(isset($cat)&&$cat->id == $newsCategory->id) mdui-list-item-active @endif ">
                                <i class="mdui-list-item-icon mdui-icon material-icons">{{$newsCategory->icon}}</i>
                                <div class="mdui-list-item-content">{{$newsCategory->name}}</div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @include('news-sec.list-data')
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
