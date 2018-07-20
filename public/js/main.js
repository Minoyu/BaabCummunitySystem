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
    var email=$$('input[name="email"]').val();
    var password=$$('input[name="password"]').val();
    var remember_me=$$('input[name="remember_me"]').is(':checked');
    var loginEmailErrorField=$$('#loginEmailError');
    var loginPasswordErrorField=$$('#loginPasswordError');
    var loginEmailTextField=$$('#loginEmailTextField');
    var loginPasswordTextField=$$('#loginPasswordTextField');
    var emailHasError=false;
    var passwordHasError=false;


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
            //    登录成功

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
