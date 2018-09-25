<li class="mdui-list-item mdui-ripple">
    <div class="mdui-list-item-avatar mdui-hoverable">
        <a href="{{route('showPersonalCenter',$thread['lastMessageUser']->id)}}">
            <img src="{{$thread['lastMessageUser']->info->avatar_url}}"/>
        </a>
    </div>
    <div class="mdui-list-item-content">
        <a href="{{ route('messages.show', $thread['thread']->id) }}">
            <div class="mdui-list-item-title">
                <span class="layui-badge @if(!$thread['isUnread']) layui-bg-gray @endif" style="height: 16px;line-height: 16px;">
                    {{ $thread['unreadCount'] }}
                </span>
                {{ $thread['thread']->subject }}
            </div>
            <div class="mdui-list-item-text mdui-list-item-two-line">
                <span class="mdui-text-color-theme-text">
                    {{--@php dd($thread['creatorIsMe']) @endphp--}}
                    {{$thread['participantsCount']}}P ·
                    @if($thread['lastMessageIsMe'])
                        To {{$thread['participantsString']}}
                    @else
                        From {{$thread['participantsString']}}
                    @endif
                </span>
                - {{ $thread['lastMessage']->body }}
            </div>
            <div class="mdui-list-item-text">
                {{ $thread['lastMessage']->created_at->diffForHumans() }}
            </div>
        </a>
    </div>

</li>