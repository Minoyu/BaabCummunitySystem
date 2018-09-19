@foreach($replies as $reply)
    @if(isset($reply->topic_id))
        <div class="activity-list">
            <a href="{{route('showPersonalCenter',$user->id)}}">
                <img src="{{$user->info->avatar_url}}" alt="users" class="activity-list-users-img mdui-hoverable">
            </a>
            <div class="activity-list-title activity-list-title-blue-a">
                <i class="mdui-icon material-icons icon-mini">&#xe15e;</i>
                {{__('discover.replyTopic')}}
                <a href="{{route('showCommunityContent',$reply->communityTopic->id)}}#reply-{{$reply->id}}" class="subject-title">{{$reply->communityTopic->title}}</a>
                <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$reply->created_at->diffForHumans()}}</div>
            </div>
            <div class="activity-list-p">
                {{strip_tags($reply->content)}}
            </div>
        </div>
    @else
        <div class="activity-list">
            <a href="{{route('showPersonalCenter',$user->id)}}">
                <img src="{{$user->info->avatar_url}}" alt="users" class="activity-list-users-img mdui-hoverable">
            </a>
            <div class="activity-list-title activity-list-title-teal-a">
                <i class="mdui-icon material-icons icon-mini">&#xe15e;</i>
                {{__('discover.replyNews')}}
                <a href="{{route('showNewsContent',$reply->news->id)}}#reply-{{$reply->id}}" class="subject-title">{{$reply->news->title}}</a>
                <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$reply->created_at->diffForHumans()}}</div>
            </div>
            <div class="activity-list-p">
                {{strip_tags($reply->content)}}

            </div>
            @if($reply->news->cover_img)
                <img class="activity-list-img" src="{{$reply->news->cover_img}}">
            @endif
        </div>
    @endif
@endforeach