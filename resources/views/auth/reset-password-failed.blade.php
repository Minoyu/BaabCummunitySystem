@extends('frame.indexframe')
@section('title',__('auth.resetPassword'))

@section('content')
    <div class="mdui-card create-page-card" style="margin-top: 20px">
        <i class="mdui-icon material-icons mdui-text-color-red mdui-center tip-page-icon animated swing" id="loginSuccessIcon">assignment_late</i>
        <h1 class="tip-page-title mdui-text-color-indigo">
            {{__('auth.resetPasswordFailed')}}
        </h1>
        <h3 class="create-page-subtitle mdui-text-color-indigo" >
            {{__('auth.resetPasswordFailedTip')}}
        </h3>
        <button onclick="openResetDialog()" class="mdui-btn mdui-btn-dense mdui-center mdui-m-t-5 mdui-color-pink-accent">{{__('index.retry')}}</button>
    </div>
@endsection