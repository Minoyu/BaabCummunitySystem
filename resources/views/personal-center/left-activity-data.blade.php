@foreach($activities as $activity)
    @switch($activity->properties['event'])
        @case('communityTopic.created')
            <div class="activity-list">
                <a href="{{route('showPersonalCenter',$activity->properties['userId'])}}">
                    <img src="{{$activity->properties['userAvatar']}}" alt="users" class="activity-list-users-img mdui-hoverable">
                </a>
                <div class="activity-list-title activity-list-title-orange-a">
                    <i class="mdui-icon material-icons icon-mini">&#xe0bf;</i>
                    创建了新社区话题
                    <a href="{{route('showCommunityContent',$activity->properties['topicId'])}}" class="subject-title">{{$activity->properties['topicTitle']}}</a>
                    <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$activity->created_at->diffForHumans()}}</div>
                </div>
            </div>
            @break
        @case('communityTopicReply.created')
            <div class="activity-list">
                <a href="{{route('showPersonalCenter',$activity->properties['userId'])}}">
                    <img src="{{$activity->properties['userAvatar']}}" alt="users" class="activity-list-users-img mdui-hoverable">
                </a>
                <div class="activity-list-title activity-list-title-blue-a">
                    <i class="mdui-icon material-icons icon-mini">&#xe15e;</i>
                    回复了社区话题
                    <a href="{{route('showCommunityContent',$activity->properties['topicId'])}}#reply-{{$activity->properties['replyId']}}" class="subject-title">{{$activity->properties['topicTitle']}}</a>
                    <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$activity->created_at->diffForHumans()}}</div>
                </div>
                <div class="activity-list-p">
                    {{strip_tags($activity->properties['replyContent'])}}
                </div>
            </div>
            @break
        @case('newsReply.created')
            <div class="activity-list">
                <a href="{{route('showPersonalCenter',$activity->properties['userId'])}}">
                    <img src="{{$activity->properties['userAvatar']}}" alt="users" class="activity-list-users-img mdui-hoverable">
                </a>
                <div class="activity-list-title activity-list-title-teal-a">
                    <i class="mdui-icon material-icons icon-mini">&#xe15e;</i>
                    回复了新闻
                    <a href="{{route('showNewsContent',$activity->properties['newsId'])}}#reply-{{$activity->properties['replyId']}}" class="subject-title">{{$activity->properties['newsTitle']}}</a>
                    <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$activity->created_at->diffForHumans()}}</div>
                </div>
                <div class="activity-list-p">
                    {{strip_tags($activity->properties['replyContent'])}}

                </div>
                @if($activity->properties['cover_img'])
                    <img class="activity-list-img" src="{{$activity->properties['cover_img']}}">
                @endif
            </div>
            @break
        @case('communityTopic.voted')
            <div class="activity-list">
                <a href="{{route('showPersonalCenter',$activity->properties['userId'])}}">
                    <img src="{{$activity->properties['userAvatar']}}" alt="users" class="activity-list-users-img mdui-hoverable">
                </a>
                <div class="activity-list-title activity-list-title-pink-a">
                    <i class="mdui-icon material-icons icon-mini">&#xe8dc;</i>
                    点赞了社区话题
                    <a href="{{route('showCommunityContent',$activity->properties['topicId'])}}" class="subject-title">{{$activity->properties['topicTitle']}}</a>
                    <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$activity->created_at->diffForHumans()}}</div>
                </div>
            </div>
            @break
        @case('communityTopicReply.voted')
            <div class="activity-list">
                <a href="{{route('showPersonalCenter',$activity->properties['userId'])}}">
                    <img src="{{$activity->properties['userAvatar']}}" alt="users" class="activity-list-users-img mdui-hoverable">
                </a>
                <div class="activity-list-title activity-list-title-pink-a">
                    <i class="mdui-icon material-icons icon-mini">&#xe8dc;</i>
                    点赞了社区话题
                    <a href="{{route('showCommunityContent',$activity->properties['topicId'])}}#reply-{{$activity->properties['replyId']}}" class="subject-title">{{$activity->properties['topicTitle']}}</a>
                    下的回复
                    <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$activity->created_at->diffForHumans()}}</div>
                </div>
                <div class="activity-list-p">
                    {{strip_tags($activity->properties['replyContent'])}}
                </div>
            </div>
            @break
        @case('newsReply.voted')
            <div class="activity-list">
                <a href="{{route('showPersonalCenter',$activity->properties['userId'])}}">
                    <img src="{{$activity->properties['userAvatar']}}" alt="users" class="activity-list-users-img mdui-hoverable">
                </a>
                <div class="activity-list-title activity-list-title-pink-a">
                    <i class="mdui-icon material-icons icon-mini">&#xe8dc;</i>
                    点赞了新闻
                    <a href="{{route('showNewsContent',$activity->properties['newsId'])}}#reply-{{$activity->properties['replyId']}}" class="subject-title">{{$activity->properties['newsTitle']}}</a>
                    下的回复
                    <div class="activity-list-time" ><i class="mdui-icon material-icons">&#xe192;</i> {{$activity->created_at->diffForHumans()}}</div>
                </div>
                <div class="activity-list-p">
                    {{strip_tags($activity->properties['replyContent'])}}

                </div>
                @if($activity->properties['cover_img'])
                    <img class="activity-list-img" src="{{$activity->properties['cover_img']}}">
                @endif
            </div>
            @break

    @endswitch
@endforeach