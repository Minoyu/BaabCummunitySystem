@extends('frame.indexframe')
@section('title',__('auth.resetPassword'))

@section('content')
    <div class="mdui-card create-page-card" style="margin-top: 20px">
        <form id="resetPasswordForm" method="post" action="{{route('storeResetPassword',$token)}}">
            {{csrf_field()}}
            <a href="{{route('showPersonalCenter',$user->id)}}" target="_blank">
                <img class="mdui-hoverable mdui-center" style="width: 70px;height: 70px;border-radius: 50%" src="{{$user->info->avatar_url}}"/>
            </a>
            <h1 class="create-page-title mdui-text-color-indigo">
                {{__('auth.resetPassword')}}
            </h1>
            <h3 class="create-page-subtitle mdui-text-color-indigo" >
                {{__('auth.resetPasswordPageTip')}}
            </h3>
            @include('admin.layout.msg')
            <div class="mdui-textfield mdui-textfield-floating-label mdui-center" style="max-width: 500px">
                <h3 class="create-page-part-title mdui-text-color-indigo">1.{{__('auth.newPassword')}}</h3>
                <i class="mdui-icon material-icons">lock</i><br>
                <label class="mdui-textfield-label">{{__('auth.nowYouCanResetPass')}}</label>
                <input class="mdui-textfield-input" name="password" type="password" minlength="6" required/>
                <div class="mdui-textfield-error">{{__('auth.atLeast6')}}</div>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label mdui-center" style="max-width: 500px">
                <h3 class="create-page-part-title mdui-text-color-indigo">2.{{__('auth.password_confirmation')}}</h3>
                <i class="mdui-icon material-icons">lock</i><br>
                <label class="mdui-textfield-label">{{__('auth.password_confirmation_p')}}</label>
                <input class="mdui-textfield-input" name="password_confirmation" type="password" minlength="6" required/>
                <div class="mdui-textfield-error">{{__('auth.atLeast6')}}</div>
            </div>
            <button class="mdui-btn mdui-btn-dense mdui-center mdui-m-t-2 mdui-color-pink-accent">{{__('auth.confirmToChange')}}</button>
        </form>
    </div>
</div>
@endsection