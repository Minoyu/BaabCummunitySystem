@extends('message.layout.notifyframe-mini')
@section('notifyframe-head-title',__('message.messageCenter'))
@section('title',__('message.messageCenter'))
@section('notifyframe-head-icon','message')

@section('message-list-item-class','mdui-list-item-active')
@section('message-tab-class','mdui-tab-active')

@section('right-content')
    <h2 class="mdui-m-t-1">
        <a href="{{route('messages.show',$thread->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-text-color-grey-600">
            <i class="mdui-icon material-icons">arrow_back</i>
        </a>
        <i class="mdui-icon material-icons">history</i> {{ $thread->subject }}</h2>
    {{$messages->links()}}
    <ul class="message-bubble-list">
        @include('message.layout.message-bubble-detail-time')
    </ul>
    {{$messages->links()}}
@endsection
