<div class="reset-dialog mdui-dialog" id="reset-dialog">
    <button class="mdui-btn mdui-btn-icon mdui-text-color-white close" mdui-dialog-close>
        <i class="mdui-icon material-icons">close</i>
    </button>
    <div class="mdui-dialog-title mdui-color-deep-orange mdui-text-color-white">{{__('auth.resetPassword')}}</div>
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
            <button type="button" class="mdui-btn mdui-ripple more-option" mdui-menu="{target: '#password-reset-menu', position: 'top', covered: false}">更多选项</button>
            <ul class="mdui-menu" id="password-reset-menu">
                <li class="mdui-menu-item">
                    <a onclick="resetToLogin()" class="mdui-ripple">{{__('index.login')}}</a>
                </li>
                <li class="mdui-menu-item">
                    <a onclick="resetToRegister()" class="mdui-ripple">{{__('auth.createAccount')}}</a>
                </li>
            </ul>
            <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">{{__('index.next')}}</button>
        </div>
    </form>
    <form class="mdui-hidden">
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">新密码</label>
            <input class="mdui-textfield-input" name="password" type="password" required>
            <div class="mdui-textfield-error">密码不能为空</div>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">重复新密码</label>
            <input class="mdui-textfield-input" name="password_repeat" type="password" required>
            <div class="mdui-textfield-error">密码不能为空</div>
        </div>
        <div class="actions mdui-clearfix">
            <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">提交</button>
        </div>
    </form>
</div>