<div class="register-dialog mdui-dialog" id="register-by-email-dialog">
    <a class="mdui-btn mdui-btn-icon mdui-text-color-white close" mdui-dialog-close>
        <i class="mdui-icon material-icons">close</i>
    </a>
    <div class="mdui-dialog-title mdui-text-color-white register-bg">
        <div class="dialog-title">
            {{__('index.register')}}
        </div>
        <button onclick="registerToLogin()" class="mdui-btn mdui-ripple mdui-float-right dialog-top-tip-button" type="button">{{__('auth.Registered')}}</button>
    </div>
    <form id="registerByEmailStep1Form">
        <div id="registerByEmailNameTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <i class="mdui-icon material-icons">account_circle</i>
            <label class="mdui-textfield-label">{{__('auth.username')}}</label>
            <input id="registerByEmailNameError" class="mdui-textfield-input" name="registerByEmailName" type="text" placeholder="{{__('auth.needName')}}" required>
            <div class="mdui-textfield-error">{{__('auth.nameEmpty')}}</div>
        </div>
        <div id="registerByEmailEmailTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <i class="mdui-icon material-icons">email</i>
            <label class="mdui-textfield-label">{{__('auth.email')}}</label>
            <input id="registerByEmailEmailError" class="mdui-textfield-input" name="registerByEmailEmail" type="email" placeholder="{{__('auth.needEmail')}}" required>
            <div id="registerByEmailEmailErrorField" class="mdui-textfield-error">{{__('auth.emailEmpty')}}</div>
        </div>
        <div class="actions mdui-clearfix">
            <button class="mdui-btn mdui-ripple more-option" type="button" mdui-menu="{target: '#register-by-email-dialog-menu', position: 'top', covered: false}">{{__('auth.moreOptions')}}</button>
            <ul class="mdui-menu full-width-menu" id="register-by-email-dialog-menu">
                <li class="mdui-menu-item">
                <a onclick="registerToReset()" class="mdui-ripple">{{__('auth.forgotPassword')}}</a>
                </li>
                {{--<li class="mdui-menu-item">--}}
                    {{--<a onclick="emailRegisterToPhoneRegister()" class="mdui-ripple">{{__('auth.registerByPhone')}}</a>--}}
                {{--</li>--}}
                <li class="mdui-menu-item">
                    <a onclick="registerToLogin()" class="mdui-ripple">{{__('auth.Registered')}}</a>
                </li>
            </ul>

            <a onclick="registerByEmailStep1Next()" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">{{__('index.next')}}</a>
            <a class="mdui-btn mdui-btn-icon mdui-float-right mdui-m-r-1 mdui-text-color-grey-600" mdui-dialog-close>
                <i class="mdui-icon material-icons">arrow_back</i>
            </a>
        </div>
    </form>
    <form id="registerByEmailStep2Form" class="mdui-hidden">
        <div id="registerByEmailPasswordTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.password')}}</label>
            <input class="mdui-textfield-input" name="registerByEmailPassword" type="password" placeholder="{{__('auth.password_p')}}" required>
            <div class="mdui-textfield-error" id="registerPasswordError">{{__('auth.atLeast6')}}</div>
        </div>

        <div id="registerByEmailPasswordConfirmTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.password_confirmation')}}</label>
            <input class="mdui-textfield-input" name="registerByEmailPasswordConfirmation" type="password" placeholder="{{__('auth.password_confirmation_p')}}" required>
            <div class="mdui-textfield-error" id="registerByEmailPasswordConfirmError">{{__('auth.password_confirmation_failed')}}</div>
        </div>

        <div class="actions mdui-clearfix">
            <a onclick="registerByEmailStep2Submit()" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">{{__('index.register')}}</a>
        </div>
    </form>
    <div class="mdui-valign success mdui-hidden registerSuccessful">
        <div class="mdui-center">
            <i class="mdui-icon material-icons mdui-text-color-green mdui-center icon" id="registerEmailSuccessIcon">&#xe862;</i>
            <h3 class="mdui-center mdui-m-t-2">{{__('auth.RegisterSuccess')}}</h3>
            <div class="btns">
                <button class="mdui-btn mdui-btn-dense mdui-btn-raised mdui-ripple " mdui-dialog-close>{{__('index.back')}}</button>
                <button onclick="registerToLogin()" class="mdui-btn mdui-btn-dense mdui-btn-raised mdui-ripple mdui-color-pink-400 mdui-m-l-2">{{__('index.login')}}</button>
            </div>
        </div>
    </div>
</div>