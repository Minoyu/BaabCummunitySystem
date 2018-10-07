@extends('frame.indexframe')

@section('notifyframe-head-title',__('message.notificationCenter'))
@section('title',__('message.notificationCenter'))
@section('notifyframe-head-icon','notifications')
@section('notification-list-item-class','mdui-list-item-active')
@section('notification-tab-class','mdui-tab-active')

@section('content')
    <div class="mdui-card content-card" style="margin-top: 10px">
        <h1 class="part-title-blue mdui-m-b-4" style="background: #fff;line-height: 28px;margin-top: 10px; margin-bottom: 10px !important; font-size: 24px">
            <i class="mdui-icon material-icons" style="font-size: 28px;">@yield('notifyframe-head-icon')</i>
            @yield('notifyframe-head-title')
        </h1>
        <div class="mdui-row">
            <div class="mdui-col-xs-12 mdui-col-sm-4 mdui-col-md-3">
                @include('message.layout.left-type-list')
            </div>
            <div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-9">
                @include('message.layout.notify-item-data')
                {{$notify->links()}}
                {{--Js所需翻译库--}}
                <input class="mdui-hidden" name="__follow" value="{{__('user.follow')}}"/>
                <input class="mdui-hidden" name="__followed" value="{{__('user.followed')}}"/>
            </div>
        </div>
    </div>
    @include('layout.footer-fab')
@endsection