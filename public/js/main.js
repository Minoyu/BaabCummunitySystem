var $$ = mdui.JQ;

/**
 * 获取get参数
 * @param name
 * @returns {null}
 * @constructor
 */
function GetQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

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
/*检测如果含有登录参数则打开登录对话框并提示登录*/
setTimeout(function(){
    var notLogged=GetQueryString("notLogged");
    if(notLogged !==null && notLogged==='true')
    {
        openLoginDialog();
        mdui.snackbar({
            message:'You haven\'t logged in<br>你还没有登录本站',
            position:'top'
        });
    }
},600);


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

var editUserInfoDialog = new mdui.Dialog('#edit-user-info-dialog',{modal:true});
//用户信息编辑框
function openEditUserInfoDialog() {
    editUserInfoDialog.open();
}

function editUserInfoDialogSubmit() {
    var id = $$('input[name="userId"]').val();
    var name = $$('input[name="editUserInfoName"]').val();
    var sex = $$('input[name="editUserInfoSex"]').val();
    var sex_open = $$('input[name="editUserInfoSexOpen"]').is(':checked');
    var motto = $$('input[name="editUserInfoMotto"]').val();
    var wechat = $$('input[name="editUserInfoWechat"]').val();
    var wechat_open = $$('input[name="editUserInfoWechatOpen"]').is(':checked');
    var nation = $$('input[name="editUserInfoNation"]').val();
    var nation_open = $$('input[name="editUserInfoNationOpen"]').is(':checked');
    var living_city = $$('input[name="editUserInfoLivingCity"]').val();
    var living_city_open = $$('input[name="editUserInfoLivingCityOpen"]').is(':checked');
    var engaged_in = $$('input[name="editUserInfoEngagedIn"]').val();
    var engaged_in_open = $$('input[name="editUserInfoEngagedInOpen"]').is(':checked');

    var editUserInfoNameTextField=$$('#editUserInfoNameTextField');
    var nameHasError=false;

    if (name===""){
        nameHasError = true;
    }
    if(nameHasError ===true){
        editUserInfoNameTextField.addClass('mdui-textfield-invalid');
    }else{
        editUserInfoNameTextField.removeClass('mdui-textfield-invalid');
        $$.ajax({
            method: 'POST',
            url: '/user/'+id+'/edit/info',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                name:name,
                sex:sex,
                sex_open:sex_open,
                motto:motto,
                wechat:wechat,
                wechat_open:wechat_open,
                nation:nation,
                nation_open:nation_open,
                living_city:living_city,
                living_city_open:living_city_open,
                engaged_in:engaged_in,
                engaged_in_open:engaged_in_open
            },
            success: function (data) {
                data=JSON.parse(data);
                if (data.status===1){
                    mdui.snackbar({
                        message:'Your personal information has been successfully updated<br/>你的个人资料已成功更新',
                        position:'top'
                        });
                    setTimeout(function(){
                        //使用  setTimeout（）方法设定定时5000毫秒
                        window.location.reload();//页面刷新
                    },2000);
                }
            }
        });
    }

}

function handleAvatarUpdate(obj,className) {
    var avatar = obj.files[0];
    var id = $$('input[name="userId"]').val();

    var form = new FormData();
    form.append('avatar',avatar);
    $$.ajax({
        method: 'POST',
        url: '/user/'+id+'/upload/avatar',
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        data: form,
        contentType: false, //禁止设置请求类型
        processData: false, //禁止jquery对DAta数据的处理,默认会处理
        //禁止的原因是,FormData已经帮我们做了处理
        success: function (data) {
            data=JSON.parse(data);
            if (data.status===1){
                mdui.snackbar({
                    message:'Your personal information has been successfully updated<br/>你的个人资料已成功更新',
                    position:'top'
                });
                setTimeout(function(){
                    //使用  setTimeout（）方法设定定时5000毫秒
                    window.location.reload();//页面刷新
                },2000);
            }
        }
    });

}
