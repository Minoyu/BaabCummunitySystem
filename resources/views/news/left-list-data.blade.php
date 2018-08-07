@foreach($newses as $news)
    @if($news->cover_img)
        <a href="#">
            <div class="news-list-item mdui-hoverable">
                <img class="news-list-item-img" src="{{$news->cover_img}}">
                <div class="news-list-item-title mdui-text-color-indigo">{{$news->title}}</div>
                <div class="news-list-item-content mdui-hidden-xs">{{str_limit(strip_tags($news->content), $limit = 120, $end = '...')}}</div>
                <a href="#" class="news-list-item-part-name">{{$news->newsCategory->name}}</a>
            </div>
        </a>
    @else
        <a href="#">
            <div class="news-list-item-without-img mdui-hoverable">
                <div class="news-list-item-title mdui-text-color-indigo">{{$news->title}}</div>
                <div class="news-list-item-content">{!!str_limit(strip_tags($news->content), $limit = 180, $end = '...')!!}</div>
                <a href="#" class="news-list-item-part-name">{{$news->newsCategory->name}}</a>
            </div>
        </a>
    @endif
@endforeach
