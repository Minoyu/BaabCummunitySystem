@foreach($messages_collection as $message)
    @php
        $class = $message['senderIsMe'] ? "message-bubble-right" : "" ;
    @endphp
    @if(!strpos($message['message']->body, '<figure>'))
        <li class="message-bubble-item {{$class}} animated zoomInRight">
            <a href="{{route('showPersonalCenter',$message['message']->user->id)}}">
                <img class="message-bubble-avatar mdui-hoverable" src="{{$message['message']->user->info->avatar_url}}" />
            </a>
            <div class="message-bubble-username">
                {{$message['message']->user->name}}
            </div>
            <div class="message-bubble-content">
                {{ $message['message']->body }}
            </div>
            <div class="message-bubble-time">
                {{ $message['message']->created_at->diffForHumans() }}
            </div>
        </li>
    @else
        <li class="message-bubble-item {{$class}} animated zoomInRight">
            <a href="{{route('showPersonalCenter',$message['message']->user->id)}}">
                <img class="message-bubble-avatar mdui-hoverable" src="{{$message['message']->user->info->avatar_url}}" />
            </a>
            <div class="message-bubble-username">
                {{$message['message']->user->name}}
            </div>
            <div class="message-bubble-time">
                {{ $message['message']->created_at->diffForHumans() }}
            </div>
        </li>
        {!! $message['message']->body !!}
    @endif
@endforeach