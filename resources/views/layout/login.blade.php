<div class="login-dialog mdui-dialog" id="login-dialog">
    <button class="mdui-btn mdui-btn-icon mdui-text-color-white close" mdui-dialog-close>
        <i class="mdui-icon material-icons">close</i>
    </button>
    <div class="mdui-dialog-title mdui-color-indigo">登录</div>
    <form>
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">用户名或邮箱</label>
            <input class="mdui-textfield-input" name="name" type="text" required>
            <div class="mdui-textfield-error">账号不能为空</div>
        </div>
        <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom">
            <label class="mdui-textfield-label">密码</label>
            <input class="mdui-textfield-input" name="password" type="password" required>
            <div class="mdui-textfield-error">密码不能为空</div>
        </div>
        <div class="actions mdui-clearfix">
            <button class="mdui-btn mdui-ripple more-option" type="button" mdui-menu="{target: '#login-dialog-menu', position: 'top', covered: false}">更多选项</button>
            <ul class="mdui-menu" id="login-dialog-menu">
                <li class="mdui-menu-item">
                    <a class="mdui-ripple">忘记密码</a>
                </li>
                <li class="mdui-menu-item">
                    <a class="mdui-ripple">创建新账号</a>
                </li>
            </ul>
            <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-float-right">登录</button>
        </div>
    </form>
</div>