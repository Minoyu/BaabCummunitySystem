<div class="mdui-card " style="border-radius: 10px">
    <h1 style="text-align: center">
        {{$cat->name}} <small>· <a href="{{route('showNews')}}" style="font-size: 70%">新闻中心</a></small>
    </h1>
    <div class="news-sec-description">{{$cat->description}}</div>
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
