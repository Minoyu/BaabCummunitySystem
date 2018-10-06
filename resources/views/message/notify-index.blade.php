@extends('message.layout.notifyframe')
@section('notifyframe-head-title',__('message.notificationCenter'))
@section('title',__('message.notificationCenter'))
@section('notifyframe-head-icon','notifications')
@section('notification-list-item-class','mdui-list-item-active')
@section('notification-tab-class','mdui-tab-active')

@section('right-content')
    @include('message.layout.notify-item-data')
    {{$notify->links()}}
    {{--Js所需翻译库--}}
    <input class="mdui-hidden" name="__follow" value="{{__('user.follow')}}"/>
    <input class="mdui-hidden" name="__followed" value="{{__('user.followed')}}"/>
@endsection
@include('layout.footer-fab')