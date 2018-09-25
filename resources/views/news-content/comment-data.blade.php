@foreach($replies as $reply)
    <a name="reply-{{$reply->id}}" id="reply-{{$reply->id}}"></a>
    <div class="news-content-comment-list">
        <a href="#"><img src="{{$reply->user->info->avatar_url}}" alt="users" class="news-content-comment-users-img mdui-hoverable"></a>
        <a href="#" class="news-content-comment-username">{{$reply->user->name}}
            @foreach($reply->user->roles as $role)
                @switch($role->name)
                    @case('Founder')
                    <span class="layui-badge">{{$role->name}}</span>
                    @break
                    @case('Maintainer')
                    <span class="layui-badge layui-bg-blue">{{$role->name}}</span>
                    @break
                    @case('BanedUser')
                    <span class="layui-badge layui-bg-black">Banned</span>
                    @break
                @endswitch
            @endforeach
        </a>
        {{--<a href="#" class="news-content-comment-dianzan-btn"><i class="mdui-icon material-icons">thumb_up</i></a>--}}
        <div class="news-content-comment-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$reply->created_at->diffForHumans()}}</div>
        <div class="news-content-comment-p">{!! $reply->content !!}</div>
        <div class="action-area">
            <span class="action-need-hover">
                @can('update',$reply)
                    <a href="{{route('adminNewsReplyEdit',[$reply->news->id,$reply->id])}}" target="_blank" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense mdui-text-color-pink-accent">
                        <i class="mdui-icon material-icons">edit</i>
                    </a>
                    <button onclick="deleteNewsReply('{{$reply->id}}','{{str_limit(strip_tags($reply->content), $limit = 20, $end = '...')}}')" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense mdui-text-color-pink-accent">
                        <i class="mdui-icon material-icons">delete</i>
                    </button>
                @endcan
            </span>
            <a onclick="replyToReply('{{$reply->user->name}}','{{$reply->user->id}}')"  mdui-tooltip="{content: '{{__('index.reply')}}', position: 'top'}"  class="mdui-btn mdui-btn-icon mdui-btn-dense news-content-comment-reply-btn" ><i class="mdui-icon material-icons mdui-icon-left ">comment</i></a>
            <a onclick="ajaxHandleReplyVote('{{route('newsReplyVote')}}','{{route('newsReplyCancelVote')}}','{{$reply->id}}',this)"
               class="mdui-btn mdui-btn-dense news-content-comment-reply-btn @if( Auth::check() &&  Auth::user()->hasVoted($reply)) mdui-text-color-pink-accent @endif">
                <i class="mdui-icon material-icons mdui-icon-left">&#xe8dc;</i>
                <span>{{$reply->thumb_up_count}}</span>
            </a>
        </div>

    </div>
    <li class="mdui-divider-inset mdui-m-y-0" style="margin-left: 80px"></li>
@endforeach