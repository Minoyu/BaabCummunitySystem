<div class="register-dialog mdui-dialog" id="register-dialog">
    <a class="mdui-btn mdui-btn-icon mdui-text-color-white close" mdui-dialog-close>
        <i class="mdui-icon material-icons">close</i>
    </a>
    <div class="mdui-dialog-title mdui-text-color-white register-bg">
        {{__('index.register')}}
        <button onclick="registerToLogin()" class="mdui-btn mdui-ripple mdui-float-right dialog-top-tip-button" type="button">{{__('auth.Registered')}}</button>
    </div>
    <form id="registerStep1Form">
        <div id="registerNameTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.username')}}</label>
            <input id="registerNameError" class="mdui-textfield-input" name="registerName" type="text" placeholder="{{__('auth.needName')}}" required>
            <div class="mdui-textfield-error">{{__('auth.nameEmpty')}}</div>
        </div>
        <div id="registerEmailTextField" class="mdui-textfield mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.email')}}</label>
            <input id="registerEmailError" class="mdui-textfield-input" name="registerEmail" type="email" placeholder="{{__('auth.needEmail')}}" required>
            <div id="registerEmailErrorField" class="mdui-textfield-error">{{__('auth.emailEmpty')}}</div>
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
    <div id="registerSuccessful" class="mdui-valign success mdui-hidden">
        <div class="mdui-center">
            <i class="mdui-icon material-icons mdui-text-color-green mdui-center icon">&#xe862;</i>
            <h3 class="mdui-center">{{__('auth.RegisterSuccess')}}</h3>
            <div class="btns">
                <button class="mdui-btn mdui-btn-dense mdui-btn-raised mdui-ripple " mdui-dialog-close>{{__('index.back')}}</button>
                <button onclick="registerToLogin()" class="mdui-btn mdui-btn-dense mdui-btn-raised mdui-ripple mdui-color-pink-400 mdui-m-l-2">{{__('index.login')}}</button>
            </div>
        </div>
    </div>
</div>`