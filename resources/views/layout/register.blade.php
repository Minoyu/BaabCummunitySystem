<div class="register-dialog mdui-dialog" id="register-dialog">
    <button class="mdui-btn mdui-btn-icon mdui-text-color-white close" mdui-dialog-close>
        <i class="mdui-icon material-icons">close</i>
    </button>
    <div class="mdui-dialog-title mdui-text-color-white register-bg">
        {{__('auth.createAccount')}}
        <button onclick="registerToLogin()" class="mdui-btn mdui-ripple mdui-float-right" type="button">{{__('auth.Registered')}}</button>
    </div>
    <form id="registerStep1Form" class="">
        <div id="registerNameTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.username')}}</label>
            <input id="registerNameError" class="mdui-textfield-input" name="registerName" type="text" placeholder="{{__('auth.needName')}}" required>
            <div class="mdui-textfield-error">{{__('auth.nameEmpty')}}</div>
        </div>
        <div id="registerEmailTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.email')}}</label>
            <input id="registerEmailError" class="mdui-textfield-input" name="registerEmail" type="email" placeholder="{{__('auth.needEmail')}}" required>
            <div class="mdui-textfield-error">{{__('auth.emailEmpty')}}</div>
        </div>
        <div class="actions">
            <a onclick="registerToLogin()" class="mdui-btn mdui-ripple more-option">{{__('auth.Registered')}}</a>
            <a onclick="registerStep1Next()" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">{{__('index.next')}}</a>
        </div>
    </form>
    <form id="registerStep2Form" class="mdui-hidden">
        <div id="registerPasswordTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.password')}}</label>
            <input class="mdui-textfield-input" name="registerPassword" type="password" placeholder="{{__('auth.password_p')}}" required>
            <div class="mdui-textfield-error" id="registerPasswordError">{{__('auth.atLeast6')}}</div>
        </div>

        <div id="registerPasswordConfirmTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.password_confirmation')}}</label>
            <input class="mdui-textfield-input" name="registerPasswordConfirmation" type="password" placeholder="{{__('auth.password_confirmation_p')}}" required>
            <div class="mdui-textfield-error" id="registerPasswordConfirmError">{{__('auth.password_confirmation_failed')}}</div>
        </div>

        <div class="actions mdui-clearfix">
            <a onclick="registerStep2Submit()" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">{{__('index.register')}}</a>
        </div>
    </form>
</div>`