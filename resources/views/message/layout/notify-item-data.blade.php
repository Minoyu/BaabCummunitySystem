@foreach($notifications as $notification)
    {{--@php--}}
        {{--dump($notification)--}}
    {{--@endphp--}}
    @switch($notification['type'])
        @case('community.topic.replied')
            @include('message.notify-card.community-topic-replied')
        @break
        @case('user.followed')
            ceshi
        @break
    @endswitch
@endforeach