@foreach($messages_collection as $message)
    @php
        $class = $message['senderIsMe'] ? "message-bubble-right" : "" ;
    @endphp
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
            {{ $message['message']->created_at}}
        </div>
    </li>
@endforeach