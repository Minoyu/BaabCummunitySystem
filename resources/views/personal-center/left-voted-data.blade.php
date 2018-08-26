@foreach($votes as $vote)
    @if(isset($vote->section_id))
        <div class="activity-list">
            <a href="{{route('showPersonalCenter',$user->id)}}">
                <img src="{{$user->info->avatar_url}}" alt="users" class="activity-list-users-img mdui-hoverable">
            </a>
            <div class="activity-list-title activity-list-title-pink-a">
                <i class="mdui-icon material-icons icon-mini">&#xe8dc;</i>
                {{__('discover.likedTopics')}}
                <a href="{{route('showCommunityContent',$vote->id)}}" class="subject-title">{{$vote->title}}</a>
                <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$vote->created_at->diffForHumans()}}</div>
            </div>
        </div>
    @elseif(isset($vote->topic_id))
        <div class="activity-list">
            <a href="{{route('showPersonalCenter',$user->id)}}">
                <img src="{{$user->info->avatar_url}}" alt="users" class="activity-list-users-img mdui-hoverable">
            </a>
            <div class="activity-list-title activity-list-title-indigo-a">
                <i class="mdui-icon material-icons icon-mini">&#xe8dc;</i>
                {{__('discover.likedTopicReply')}}
                <a href="{{route('showCommunityContent',$vote->communityTopic->id)}}#reply-{{$vote->id}}" class="subject-title">{{$vote->communityTopic->title}}</a>
                <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$vote->created_at->diffForHumans()}}</div>
            </div>
            <div class="activity-list-p">
                {{strip_tags($vote->content)}}
            </div>

        </div>
    @elseif(isset($vote->news_id))
        <div class="activity-list">
            <a href="{{route('showPersonalCenter',$user->id)}}">
                <img src="{{$user->info->avatar_url}}" alt="users" class="activity-list-users-img mdui-hoverable">
            </a>
            <div class="activity-list-title activity-list-title-purple-a">
                <i class="mdui-icon material-icons icon-mini">&#xe8dc;</i>
                {{__('discover.likedNewsReply')}}
                <a href="{{route('showCommunityContent',$vote->news->id)}}#reply-{{$vote->id}}" class="subject-title">{{$vote->news->title}}</a>
                <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$vote->created_at->diffForHumans()}}</div>
            </div>
            <div class="activity-list-p">
                {{strip_tags($vote->content)}}
            </div>
        </div>
    @endif
@endforeach