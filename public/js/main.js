var $$ = mdui.JQ;


/************************
 * 顶部appbar right menu
 */

var appbarRightMenu = new mdui.Menu('#appbar-right-menu-btn','#appbar-right-menu',{covered:false});

/************************
 * 首页轮播图
 */
layui.use('carousel', function(){
    var carousel = layui.carousel;
    //建造实例
    carousel.render({
        elem: '#index-carousel',
        width: '100%', //设置容器宽度
        height: '100%', //设置容器宽度
        arrow: 'hover' //始终显示箭头
    });
});

//轮播图右侧最新内容
var carsouelRightTab = new mdui.Tab('#carousel-right',{trigger:'hover'});

//首页资讯板块tab
var infoTab = new mdui.Tab('#info-tab',{trigger:'hover'});

//首页地区板块tab
var regionalTab = new mdui.Tab('#regional-tab',{trigger:'hover'});

//登录对话框
var loginDialog = new mdui.Dialog('#login-dialog',{modal:true});

//打开登录框
function openLoginDialog() {
    loginDialog.open();
}
function loginToRegister() {
    loginDialog.close();
    registerDialog.open();
}
function loginToReset() {
    loginDialog.close();
    resetDialog.open();
}
//注册对话框
var registerDialog = new mdui.Dialog('#register-dialog',{modal:true});

//打开注册框
function openRegisterDialog() {
    registerDialog.open();
}
function registerToLogin() {
    registerDialog.close();
    loginDialog.open();
}

//密码重置对话框
var resetDialog = new mdui.Dialog('#reset-dialog',{modal:true});

//打开重置框
function openResetDialog() {
    resetDialog.open();
}
function resetToRegister() {
    resetDialog.close();
    registerDialog.open();
}
function resetToLogin() {
    resetDialog.close();
    loginDialog.open();
}

//页面跳转函数 tab使用
function jumpTo(url){
    location.href= url;
}

//页面顶部tab及底部nav的激活
var tabVal = $$('#tabActiveVal').text();
var bottomVal = $$('#bottomNavActiveVal').text();

$$('#'+tabVal).addClass('mdui-tab-active');
$$('#'+bottomVal).addClass('mdui-bottom-nav-active');

//Ajax用户登录验证
function loginSubmit() {
    var email=$$('input[name="loginEmail"]').val();
    var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$"); //邮箱正则表达式
    var password=$$('input[name="loginPassword"]').val();
    var remember_me=$$('input[name="remember_me"]').is(':checked');
    var loginEmailErrorField=$$('#loginEmailError');
    var loginPasswordErrorField=$$('#loginPasswordError');
    var loginEmailTextField=$$('#loginEmailTextField');
    var loginPasswordTextField=$$('#loginPasswordTextField');
    var emailHasError=false;
    var passwordHasError=false;


    //至少6位
    if (password.length<6){
        passwordHasError = true;
    }
    //邮箱验证开始
    if (email === ""){
        emailHasError = true;
    }else if(!reg.test(email)){ //邮箱正则验证不通过，格式不对
        emailHasError = true;
    }

    if (passwordHasError || emailHasError){
        if(passwordHasError ===true){
            loginPasswordTextField.addClass('mdui-textfield-invalid');
        }else{
            loginPasswordTextField.removeClass('mdui-textfield-invalid');
        }
        if(emailHasError ===true){
            loginEmailTextField.addClass('mdui-textfield-invalid');
        }else{
            loginEmailTextField.removeClass('mdui-textfield-invalid');
        }
    }else{
        $$.ajax({
        method: 'POST',
        url: '/auth/login',
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        data: {
            email:email,
            password:password,
            remember_me:remember_me
        },
        statusCode: {
            422: function (data) {
                data=JSON.parse(data.response);
                if (data.errors.email){
                    loginEmailErrorField.text(data.errors.email[0]);
                    emailHasError=true;
                }
                if (data.errors.password){
                    loginPasswordErrorField.text(data.errors.password[0]);
                    passwordHasError=true;
                }
            }
        },
        success: function (data) {
            data=JSON.parse(data);
            if (data.status===1){
            //登录成功
                $$('#loginForm').addClass('mdui-hidden');
                $$('.dialog-top-tip-button').addClass('mdui-hidden');
                $$('.username').text(data.user.name);
                console.log(data.user.name);
                $$('#loginSuccessful').removeClass('mdui-hidden');
                loginDialog.handleUpdate();
                setTimeout(function(){
                    //使用  setTimeout（）方法设定定时5000毫秒
                    window.location.reload();//页面刷新
                },5000);
            }else{
                loginPasswordErrorField.text(data.msg);
                passwordHasError=true;
            }
        },
        complete: function (xhr, textStatus) {
            if(emailHasError ===true){
                loginEmailTextField.addClass('mdui-textfield-invalid');
            }else{
                loginEmailTextField.removeClass('mdui-textfield-invalid');
            }
            if(passwordHasError ===true){
                loginPasswordTextField.addClass('mdui-textfield-invalid');
            }else{
                loginPasswordTextField.removeClass('mdui-textfield-invalid');
            }
        }
    });
    }
}

//注册部分下一步
function registerStep1Next() {
    var userName = $$('input[name="registerName"]').val();
    var email = $$('input[name="registerEmail"]').val();
    var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$"); //邮箱正则表达式
    var registerEmailTextField=$$('#registerEmailTextField');
    var registerEmailErrorField=$$('#registerEmailErrorField');
    var registerNameTextField=$$('#registerNameTextField');
    var nameHasError=false;
    var emailHasError=false;
    //用户名验证
    if (userName === ""){
        nameHasError = true;
    }
    //邮箱验证开始
    if (email === ""){
        emailHasError = true;
    }else if(!reg.test(email)){ //邮箱正则验证不通过，格式不对
        emailHasError = true;
    }else{
        $$.ajax({
            method: 'POST',
            url: '/auth/checkEmailUnique',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email:email
            },
            statusCode: {
                422: function (data) {
                    data=JSON.parse(data.response);
                    if (data.errors.email){
                        registerEmailErrorField.text(data.errors.email[0]);
                        emailHasError=true;
                    }
                },
                404:function (data) {
                    data=JSON.parse(data.response);
                    if (data.errors.email){
                        registerEmailErrorField.text('Server internal error');
                        emailHasError=true;
                    }
                },
                500:function (data) {
                    data=JSON.parse(data.response);
                    if (data.errors.email){
                        registerEmailErrorField.text('Server internal error');
                        emailHasError=true;
                    }
                }
            },
            complete: function (xhr, textStatus) {
                //跳转
                if( nameHasError || emailHasError){
                    if(emailHasError ===true){
                        registerEmailTextField.addClass('mdui-textfield-invalid');
                    }else{
                        registerEmailTextField.removeClass('mdui-textfield-invalid');
                    }
                    if(nameHasError ===true){
                        registerNameTextField.addClass('mdui-textfield-invalid');
                    }else{
                        registerNameTextField.removeClass('mdui-textfield-invalid');
                    }
                }else{
                    $$('#registerStep1Form').addClass('mdui-hidden');
                    $$('#registerStep2Form').removeClass('mdui-hidden');
                    registerDialog.handleUpdate();
                }
            }
        });
    }
}

//Ajax注册提交部分
function registerStep2Submit() {
    var userName = $$('input[name="registerName"]').val();
    var email = $$('input[name="registerEmail"]').val();
    var password = $$('input[name="registerPassword"]').val();
    var password_confirmation = $$('input[name="registerPasswordConfirmation"]').val();
    var registerPasswordErrorField=$$('#registerPasswordError');
    var registerPasswordConfirmErrorField=$$('#registerPasswordConfirmError');
    var registerPasswordTextField=$$('#registerPasswordTextField');
    var registerPasswordConfirmTextField=$$('#registerPasswordConfirmTextField');
    var passwordHasError=false;
    var passwordConfirmHasError=false;

    //至少6位
    if (password.length<6){
        passwordHasError = true;
    }
    if (password_confirmation!==password){
        passwordConfirmHasError = true;
    }

    if (passwordHasError || passwordConfirmHasError){
        if(passwordHasError ===true){
            registerPasswordTextField.addClass('mdui-textfield-invalid');
        }else{
            registerPasswordTextField.removeClass('mdui-textfield-invalid');
        }
        if(passwordConfirmHasError ===true){
            registerPasswordConfirmTextField.addClass('mdui-textfield-invalid');
        }else{
            registerPasswordConfirmTextField.removeClass('mdui-textfield-invalid');
        }
    }else{
        $$.ajax({
            method: 'POST',
            url: '/auth/register',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email:email,
                name:userName,
                password:password,
                password_confirmation:password_confirmation
            },
            success: function (data) {
                data=JSON.parse(data);
                if (data.status===1){
                    $$('#registerStep2Form').addClass('mdui-hidden');
                    $$('#registerSuccessful').removeClass('mdui-hidden');
                    registerDialog.handleUpdate();
                }
            }
        });
    }


}
