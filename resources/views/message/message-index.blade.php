@extends('message.layout.notifyframe')
@section('notifyframe-head-title',__('message.messageCenter'))
@section('title',__('message.messageCenter'))
@section('notifyframe-head-icon','message')

@section('message-list-item-class','mdui-list-item-active')
@section('message-tab-class','mdui-tab-active')

@section('right-content')
    @include('admin.layout.msg')
    <ul class="mdui-list">
        @each('message.layout.message-thread', $thread_collection, 'thread', 'message.layout.message-no-threads')
    </ul>
    {{$threads->links()}}
@endsection
@include('layout.footer-fab')