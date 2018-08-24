<div class="mdui-card news-content-card" style="border-radius: 10px">
    @include('admin.layout.msg')
    <h1 class="topic-content-primary-title">
        @if($topic->status=='hidden')
            <span class="mdui-text-color-pink">
                <i class="mdui-icon material-icons">&#xe541;</i>
            </span>
        @endif
        {{$topic->title}}
        <br>
        <small>
            <span>
            @if($topic->status=='hidden')
                <span class="mdui-text-color-pink">
                    · <i class="mdui-icon material-icons">&#xe541;</i> 暂存
                </span>
            @endif
            @if($topic->order >0)
                <span class="layui-badge">置顶</span>
            @endif
            @if($topic->is_excellent)
                <span class="layui-badge layui-bg-blue">精华</span>
            @endif
            @if($topic->order <0)
                <span class="layui-badge">下沉</span>
            @endif
            · <i class="mdui-icon material-icons" style="padding-bottom: 3px">&#xe2c7;</i> <a href="{{route('showCommunitySection',$topic->communitySection->id)}}">{{$topic->communitySection->name}}</a>
            · <i class="mdui-icon material-icons" style="padding-bottom: 3px">&#xe417;</i> <span class="mdui-hidden-xs">访问量</span>{{$topic->view_count}}
            · <i class="mdui-icon material-icons">&#xe0b9;</i> <span class="mdui-hidden-xs">评论量</span>{{$topic->reply_count}}
            · <i class="mdui-icon material-icons">&#xe192;</i> <span class="mdui-hidden-xs">发表于</span>{{$topic->created_at->diffForHumans()}}
            </span>
        </small>
    </h1>

    <div class="topic-content-primary-text">
        {!! $topic->content !!}
    </div>
</div>
