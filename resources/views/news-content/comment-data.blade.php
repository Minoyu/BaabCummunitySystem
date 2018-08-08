@foreach($replies as $reply)
    <div class="news-content-comment-list">
        <a href="#"><img src="{{$reply->user->info->avatar_url}}" alt="users" class="news-content-comment-users-img mdui-hoverable"></a>
        <a href="#" class="news-content-comment-username">{{$reply->user->name}}</a>
        {{--<a href="#" class="news-content-comment-dianzan-btn"><i class="mdui-icon material-icons">thumb_up</i></a>--}}
        <div class="news-content-comment-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$reply->created_at->diffForHumans()}}</div>
        <div class="news-content-comment-p">{!! $reply->content !!}</div>
        <div class="action-area">
            <a onclick="replyToNewsReply('{{$reply->user->name}}','{{$reply->user->id}}')" class="mdui-btn mdui-btn-dense news-content-comment-reply-btn" ><i class="mdui-icon material-icons mdui-icon-left ">comment</i>回复</a>
            <a href="{{route('adminNewsReplyEdit',[$news->id,$reply->id])}}" target="_blank" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense mdui-text-color-pink-accent">
                <i class="mdui-icon material-icons">edit</i>
            </a>
            <button onclick="deleteNewsReply('{{$reply->id}}','{{str_limit(strip_tags($reply->content), $limit = 20, $end = '...')}}')" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense mdui-text-color-pink-accent">
                <i class="mdui-icon material-icons">delete</i>
            </button>
        </div>

    </div>
    <li class="mdui-divider-inset mdui-m-y-0" style="margin-left: 80px"></li>
@endforeach