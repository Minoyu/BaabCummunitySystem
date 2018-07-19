<div class="register-dialog mdui-dialog" id="register-dialog">
    <button class="mdui-btn mdui-btn-icon mdui-text-color-white close" mdui-dialog-close>
        <i class="mdui-icon material-icons">close</i>
    </button>
    <div class="mdui-dialog-title mdui-text-color-white register-bg">
        {{__('auth.createAccount')}}
        <button onclick="registerToLogin()" class="mdui-btn mdui-ripple mdui-float-right" type="button">{{__('auth.Registered')}}</button>
    </div>
    <form class="">
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">邮箱</label>
            <input class="mdui-textfield-input" name="email" type="email" required>
            <div class="mdui-textfield-error">邮箱格式错误</div>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom send-email-field">
            <label class="mdui-textfield-label">邮件验证码</label>
            <input class="mdui-textfield-input" name="email_code" type="text" required>
            <div class="mdui-textfield-error">验证码不能为空</div>
            <button class="mdui-btn send-email" type="button">发送验证码</button>
        </div>
        <div class="actions">
            <a onclick="registerToLogin()" class="mdui-btn mdui-ripple more-option">{{__('auth.Registered')}}</a>
            <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">{{__('index.next')}}</button>
        </div>
    </form>
    <form class="">
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">用户名</label>
            <input class="mdui-textfield-input" name="username" type="text" required>
            <div class="mdui-textfield-error">用户名不能为空</div>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">{{__('auth.password')}}</label>
            <input class="mdui-textfield-input" name="password" type="password" required>
            <div class="mdui-textfield-error">密码不能为空</div>
        </div><div class="actions mdui-clearfix">
            <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">{{__('index.register')}}</button>
        </div>
    </form>
</div>