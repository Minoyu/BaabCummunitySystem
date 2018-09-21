@extends('frame.indexframe')
@section('title',__('auth.resetPassword'))

@section('content')
    <div class="mdui-card create-page-card" style="margin-top: 20px">
        <i class="mdui-icon material-icons mdui-text-color-green mdui-center tip-page-icon animated slideInDown" id="loginSuccessIcon">check_circle</i>
        <h1 class="tip-page-title mdui-text-color-indigo">
            {{__('auth.resetPasswordSuccess')}}
        </h1>
        <h3 class="create-page-subtitle mdui-text-color-indigo" >
            {{__('auth.resetPasswordSuccessTip')}}
        </h3>
        <button onclick="openLoginDialog()" class="mdui-btn mdui-btn-dense mdui-center mdui-m-t-5 mdui-color-pink-accent">{{__('index.loginNow')}}</button>
    </div>
@endsection