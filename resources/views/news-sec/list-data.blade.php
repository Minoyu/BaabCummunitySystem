@foreach($newses as $news)
    @if($news->cover_img)
        <a href="{{route('showNewsContent',$news->id)}}">
            <div class="news-list-item">
                <img class="news-list-item-img" src="{{$news->cover_img}}">
                <div class="news-list-item-title mdui-text-color-indigo">{{$news->title}}</div>
                <div class="news-list-item-content mdui-hidden-xs">{{str_limit(strip_tags($news->content), $limit = 120, $end = '...')}}</div>
            </div>
        </a>
    @else
        <a href="{{route('showNewsContent',$news->id)}}">
            <div class="news-list-item-without-img">
                <div class="news-list-item-title mdui-text-color-indigo">{{$news->title}}</div>
                <div class="news-list-item-content">{!!str_limit(strip_tags($news->content), $limit = 180, $end = '...')!!}</div>
            </div>
        </a>
    @endif
@endforeach
