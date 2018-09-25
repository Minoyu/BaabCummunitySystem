@php
    $class = $messages['senderIsMe'] ? "message-bubble-right" : "" ;
@endphp
<li class="message-bubble-item {{$class}} ">
    <a href="{{route('showPersonalCenter',$messages['sender']->id)}}">
        <img class="message-bubble-avatar mdui-hoverable" src="{{$messages['sender']->info->avatar_url}}" />
    </a>
    <div class="message-bubble-username">
        {{$messages['sender']->name}}
    </div>
    <div class="message-bubble-content">
        {!! $messages['message']->body !!}
    </div>
</li>