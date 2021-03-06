@foreach($notifications as $notification)
    {{--@php--}}
        {{--dump($notification)--}}
    {{--@endphp--}}
    @switch($notification['type'])
        @case('community.topic.replied')
            @include('message.notify-card.community-topic-replied')
        @break
        @case('community.reply.replied')
            @include('message.notify-card.community-reply-replied')
        @break
        @case('news.reply.replied')
            @include('message.notify-card.news-reply-replied')
        @break
        @case('user.followed')
            @include('message.notify-card.user-followed')
        @break
        @case('user.new.welcome')
            @include('message.notify-card.user-new-welcome')
        @break
    @endswitch
@endforeach