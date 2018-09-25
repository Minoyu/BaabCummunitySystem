@extends('message.layout.notifyframe')
@section('right-content')
    @include('admin.layout.msg')
    <ul class="mdui-list">
        @each('message.layout.message-thread', $thread_collection, 'thread', 'message.layout.message-no-threads')
    </ul>
    {{$threads->links()}}
@endsection