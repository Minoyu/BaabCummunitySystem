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
                    · <i class="mdui-icon material-icons">&#xe541;</i> {{__('community.saved')}}
                </span>
            @endif
            @if(isset($news->invalided_at) && $news->invalided_at < \Carbon\Carbon::now())
                · <span class="layui-badge layui-bg-black">{{__('news.invalidTip')}}</span>
            @endif
            <a href="{{route('showNews')}}">· {{__('news.newsCenter')}}</a> > <a href="{{route('showNewsSec',$cat->id)}}">{{$cat->name}}</a>
            <span style="white-space: nowrap;">
            · <i class="mdui-icon material-icons" style="padding-bottom: 3px">remove_red_eye</i> <span class="mdui-hidden-xs">{{__('community.visitedCount')}}</span> {{$news->view_count}}
            · <i class="mdui-icon material-icons">comment</i> <span class="mdui-hidden-xs">{{__('community.commentCount')}}</span> {{$news->reply_count}}
            </span>
        </small>
    </h1>
    <div class="news-content-primary-text">
        {!! $news->content !!}
    </div>
</div>
