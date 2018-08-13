<div class="mdui-card news-content-card" style="border-radius: 10px">
    <h1 class="topic-content-primary-title">
        {{$topic->title}}
        <br>
        <small>
            <span>
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
