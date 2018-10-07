@extends('frame.indexframe')
@section('notifyframe-head-title',__('message.messageCenter'))
@section('title',__('message.messageCenter'))
@section('notifyframe-head-icon','message')
@section('message-list-item-class','mdui-list-item-active')
@section('message-tab-class','mdui-tab-active')

@section('content')
    <div class="mdui-card content-card" style="margin-top: 10px">
        <div class="mdui-hidden-sm-down">
            <h1 class="part-title-blue mdui-m-b-4" style="background: #fff;line-height: 28px;margin-top: 10px; margin-bottom: 10px !important; font-size: 24px">
                <i class="mdui-icon material-icons" style="font-size: 28px;margin-top: -5px;">@yield('notifyframe-head-icon')</i>
                @yield('notifyframe-head-title')
            </h1>
        </div>
        <div class="mdui-row">
            <div class="mdui-col-xs-12 mdui-col-sm-4 mdui-col-md-3">
                @include('message.layout.left-type-list-mini')
            </div>
            <div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-9">
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
            </div>
        </div>
    </div>
    {{--@include('admin.layout.msg')--}}

@endsection
