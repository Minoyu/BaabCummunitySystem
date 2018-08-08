<div class="news-content-cover-img" style="background-image: url({{$news->cover_img}})"></div>
<div class="mdui-card" style="border-radius: 10px">
    <h1 class="news-content-primary-title">
        {{$news->title}}
        <br>
        <small>
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
