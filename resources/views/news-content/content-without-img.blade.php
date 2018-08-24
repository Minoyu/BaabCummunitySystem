<div class="mdui-card news-content-card" style="border-radius: 10px">
    <h1 class="news-content-primary-title">
        @if($news->status=='hidden')
            <span class="mdui-text-color-pink">
                <i class="mdui-icon material-icons">&#xe541;</i>
            </span>
        @endif
        {{$news->title}}
        <br>
        <small>
            @if($news->status=='hidden')
                <span class="mdui-text-color-pink">
                    · <i class="mdui-icon material-icons">&#xe541;</i> 暂存
                </span>
            @endif
            <a href="{{route('showNews')}}">News Center</a> > <a href="{{route('showNewsSec',$cat->id)}}">{{$cat->name}}</a>
            <span style="white-space: nowrap;">
            · <i class="mdui-icon material-icons" style="padding-bottom: 3px">remove_red_eye</i> <span class="mdui-hidden-xs">访问量</span>{{$news->view_count}}
            · <i class="mdui-icon material-icons">comment</i> <span class="mdui-hidden-xs">评论量</span>{{$news->reply_count}}
            </span>
        </small>
    </h1>
    <div class="news-content-primary-text">
        {!! $news->content !!}
    </div>
</div>
