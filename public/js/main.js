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
