<div class="login-dialog mdui-dialog" id="login-dialog">
    <a class="mdui-btn mdui-btn-icon mdui-text-color-white close" mdui-dialog-close>
        <i class="mdui-icon material-icons">close</i>
    </a>
    <div class="mdui-dialog-title mdui-color-indigo login-bg">
        {{__('index.login')}}
        <button onclick="loginToRegister()" class="mdui-btn mdui-ripple mdui-float-right dialog-top-tip-button" type="button">{{__('auth.notRegistered')}}</button>
    </div>
    <form id="loginForm">
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom" id="loginEmailTextField">
            <label class="mdui-textfield-label">{{__('auth.email')}}</label>
            <input class="mdui-textfield-input" name="loginEmail" type="text" required>
            <div class="mdui-textfield-error" id="loginEmailError">{{__('auth.noEmpty')}}</div>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom" id="loginPasswordTextField">
            <label class="mdui-textfield-label">{{__('auth.password')}}</label>
            <input class="mdui-textfield-input" name="loginPassword" type="password" pattern="^.*(?=.{6,}).*$" required/>
            <div class="mdui-textfield-error" id="loginPasswordError">{{__('auth.atLeast6P')}}</div>
            {{--<div class="mdui-textfield-helper">{{__('auth.atLeast6')}}</div>--}}
        </div>
        <div class="actions mdui-clearfix">
            <button class="mdui-btn mdui-ripple more-option" type="button" mdui-menu="{target: '#login-dialog-menu', position: 'top', covered: false}">{{__('auth.moreOptions')}}</button>
            <ul class="mdui-menu full-width-menu" id="login-dialog-menu">
                <li class="mdui-menu-item">
                    <a onclick="loginToReset()" class="mdui-ripple">{{__('auth.forgotPassword')}}</a>
                </li>
                <li class="mdui-menu-item">
                    <a onclick="loginToRegister()" class="mdui-ripple">{{__('auth.createAccount')}}</a>
                </li>
                <label class="mdui-switch" style="margin: 0px 15px">
                    <input type="checkbox" name="remember_me" checked/>
                    <i class="mdui-switch-icon"></i>&nbsp;&nbsp;{{__('auth.rememberMe')}}
                </label>
            </ul>
            <a onclick="loginSubmit()" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">{{__('auth.confirmLogin')}}</a>
        </div>
    </form>
    <div id="loginSuccessful" class="mdui-valign success mdui-hidden">
        <div class="mdui-center">
            <i class="mdui-icon material-icons mdui-text-color-green mdui-center icon">&#xe862;</i>
            <h3 class="mdui-center">{{__('auth.LoginSuccess')}} , <span class="username"></span></h3>
            <div class="btns">
                <a class="mdui-btn mdui-btn-dense mdui-btn-raised mdui-ripple personalCenterUrl">{{__('index.personalCenter')}}</a>
                <button onclick="window.location.href=GetUrlRelativePath()" class="mdui-btn mdui-btn-dense mdui-btn-raised mdui-ripple mdui-color-pink-400 mdui-m-l-2">{{__('index.back')}}</button>
            </div>
        </div>
    </div>
</div>