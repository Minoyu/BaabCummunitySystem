var $$ = mdui.JQ;
$$.fn.extend({
    animateCss: function (animationName, callback) {
        var animationEnd = (function (el) {
            var animations = {
                animation: 'animationend',
                OAnimation: 'oAnimationEnd',
                MozAnimation: 'mozAnimationEnd',
                WebkitAnimation: 'webkitAnimationEnd',
            };

            for (var t in animations) {
                if (el.style[t] !== undefined) {
                    return animations[t];
                }
            }
        })(document.createElement('div'));

        this.addClass('animated ' + animationName).one(animationEnd, function () {
            $(this).removeClass('animated ' + animationName);

            if (typeof callback === 'function') callback();
        });

        return this;
    },
});

/**
 * 获取get参数
 * @param name
 * @returns {null}
 * @constructor
 */
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
}

function GetUrlRelativePath() {
    var url = document.location.toString();
    var arrUrl = url.split("//");

    var start = arrUrl[1].indexOf("/");
    var end = arrUrl[1].indexOf("#");
    if (end > 0) {
        var relUrl = arrUrl[1].substring(start, end); //stop省略，截取从start开始到结尾的所有字符
    } else {
        var relUrl = arrUrl[1].substring(start); //stop省略，截取从start开始到结尾的所有字符
    }

    if (relUrl.indexOf("?") != -1) {
        relUrl = relUrl.split("?")[0];
    }
    return relUrl;
}

/**
 * 前台Drawer
 */
var indexDrawer = new mdui.Drawer('#index-drawer', {
    swipe: true
});

function toggleIndexDrawer() {
    indexDrawer.toggle();
}

var handleDrawerStatusDialog = new mdui.Dialog('#handleDrawerStatusDialog');
var handleDrawerStatusDialogDom = document.getElementById('handleDrawerStatusDialog');

function handleDrawerDefaultStatus() {
    handleDrawerStatusDialog.open();
    handleDrawerStatusDialogDom.addEventListener('cancel.mdui.dialog', function () {
        $$.ajax({
            method: 'get',
            url: '/switch/drawerOpen',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    handleDrawerStatusDialog.close();
                    mdui.snackbar({
                        message: data.msg,
                        position: 'top'
                    });
                }
            }
        });

    });
    handleDrawerStatusDialogDom.addEventListener('confirm.mdui.dialog', function () {
        $$.ajax({
            method: 'get',
            url: '/switch/drawerClose',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    handleDrawerStatusDialog.close();
                    indexDrawer.close();
                    mdui.snackbar({
                        message: data.msg,
                        position: 'top'
                    });
                }
            }
        });

    });
}

/************************
 * 顶部appbar right menu
 */

var appbarRightMenu = new mdui.Menu('#appbar-right-menu-btn', '#appbar-right-menu', {
    covered: false
});

/************************
 * 首页轮播图
 */

var indexSwiper = new Swiper('.index-swiper-container', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 5000,
        stopOnLastSlide: false,
        disableOnInteraction: true
    },
    // 如果需要滚动条
    scrollbar: {
        el: '.swiper-scrollbar',
        hide: true
    }
});

var bannerSwiper = new Swiper('.banner-container', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 5000,
        stopOnLastSlide: false,
        disableOnInteraction: true
    },

    // 如果需要分页器
    pagination: {
        el: '.banner-pagination'
    },

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    scrollbar: {
        el: '.swiper-scrollbar',
        hide: true
    }

});

/************************
 * 新闻轮播图
 */
layui.use('carousel', function () {
    var newsCarousel = layui.carousel;
    //建造实例
    newsCarousel.render({
        elem: '#news-carousel',
        width: '100%', //设置容器宽度
        height: '100%', //设置容器宽度
        arrow: 'hover' //始终显示箭头
    });
});

//轮播图右侧最新内容
var carsouelRightTab = new mdui.Tab('#carousel-right', {
    trigger: 'hover'
});

//首页资讯版块tab
var infoTab = new mdui.Tab('#info-tab', {
    trigger: 'hover'
});

//首页话题版块tab
var topicTab = new mdui.Tab('#topic-tab', {
    trigger: 'hover'
});

//首页话题版块tab
var fleaMarketTab = new mdui.Tab('#flea-market-tab', {
    trigger: 'hover'
});
//首页话题版块tab
var schoolTab = new mdui.Tab('#school-tab', {
    trigger: 'hover'
});

//登录对话框
var loginDialog = new mdui.Dialog('#login-dialog');

//打开登录框
function openLoginDialog() {
    loginDialog.open();
}

function loginToRegister() {
    loginDialog.close();
    registerByEmailDialog.open();
    // registerByPhoneDialog.open();
}

function loginToReset() {
    loginDialog.close();
    resetDialog.open();
}

function registerToReset() {
    registerByEmailDialog.close();
    // registerByPhoneDialog.close();
    resetDialog.open();
}
/*检测如果含有登录参数则打开登录对话框并提示登录*/
function handleNotLogged() {
    openLoginDialog();
    mdui.snackbar({
        message: 'You haven\'t logged in<br>你还没有登录本站',
        timeout: 3000,
        position: 'top'
    });
}

setTimeout(function () {
    var notLogged = GetQueryString("notLogged");
    if (notLogged !== null && notLogged === 'true') {
        if ($$('meta[name="isLogged"]').attr('content') !== '1') {
            handleNotLogged();
        }

    }
}, 600);

//新闻编辑器
var E = window.wangEditor;
if ($$('#editorToolbar').length > 0) {
    var editor = new E('#editorToolbar', '#editorText');
    var textArea = $$('#editorTextArea');
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        textArea.val(html);
    };
    editor.customConfig.zIndex = 0;
    editor.customConfig.lang = {
        '设置标题': 'Title',
        '字号': 'Font Size',
        '字体': 'Font Family',
        '正文': 'p',
        '链接文字': 'Link text',
        '链接': 'Link',
        '文字颜色': 'Font color',
        '背景色': 'BG color',
        '设置列表': 'Insert list',
        '有序列表': 'Ordered list',
        '无序列表': 'Unordered list',
        '上传图片': 'Upload image',
        '网络图片': 'Image URL',
        '对齐方式': 'Text align',
        '靠左': 'Left',
        '靠右': 'Right',
        '居中': 'Center',
        '上传': 'upload',
        '创建': 'Create',
        '默认': 'Default',
        '插入表格': 'Insert Table',
        '插入': 'Insert',
        '视频': ' Video',
        '代码': ' Code',
        '行': 'line',
        '列': 'col',
        '的表格': ' table',
        // 还可自定添加更多
    };
    switch ($$('#editorToolbar').attr('type')) {
        case 'community-topic':
            var serverUrl = '/community/topic/upload/img';
            if ($$('body').width() < 800) {
                editor.customConfig.menus = [
                    'emoticon', // 表情
                    'head', // 标题
                    'fontSize', // 字号
                    'image', // 插入图片
                    'bold', // 粗体
                    'italic', // 斜体
                    'justify', // 对齐方式
                    'quote', // 引用
                    'undo' // 撤销
                ];
            }
            break;
        case 'news':
            var serverUrl = '/admin/news/upload/img';
            break;
        case 'news-reply':
            var serverUrl = '/news/reply/upload/img';
            editor.customConfig.menus = [
                'emoticon', // 表情
                'image', // 插入图片
                'bold', // 粗体
                'italic', // 斜体
                'underline', // 下划线
                'quote' // 引用
            ];
            break;
        case 'community-reply':
            var serverUrl = '/community/topic/reply/upload/img';
            editor.customConfig.menus = [
                'emoticon', // 表情
                'image', // 插入图片
                'bold', // 粗体
                'italic', // 斜体
                'underline', // 下划线
                'quote' // 引用
            ];
            break;
    }
    editor.customConfig.uploadImgHeaders = {
        'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content'),
        'X-Requested-With': 'XMLHttpRequest'
    };
    editor.customConfig.uploadFileName = 'img[]';
    editor.customConfig.zIndex = 1;
    editor.customConfig.debug = location.href.indexOf('wangeditor_debug_mode=1') > 0;

    //文件上传逻辑
    editor.customConfig.uploadImgTimeout = 300000;
    editor.customConfig.uploadImgMaxSize = 10 * 1024 * 1024;
    editor.customConfig.customUploadImg = function (files, insert) {
        // files 是 input 中选中的文件列表
        editorProgress = $$('#editor-progress');
        $$.each(files, function (i, file) {
            editorProgress.show();
            ImgToBase64(file, 1280, function (base64) {
                $$.ajax({
                    method: 'POST',
                    url: serverUrl,
                    headers: {
                        'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        img_data: base64
                    },
                    //禁止的原因是,FormData已经帮我们做了处理
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status === 1) {
                            // insert 是获取图片 url 后，插入到编辑器的方法
                            // 上传代码返回结果之后，将图片插入到编辑器中
                            insert(data.link, data.slink, data.size);
                            editorProgress.hide();
                        }
                    }
                });
            });


        });
    };

    editor.create();
    // 初始化 textarea 的值
    textArea.val(editor.txt.html());
}


//注册对话框
var registerByEmailDialog = new mdui.Dialog('#register-by-email-dialog');
// var registerByPhoneDialog = new mdui.Dialog('#register-by-phone-dialog');

//打开注册框
function openRegisterDialog() {
    // registerByPhoneDialog.open();
    registerByEmailDialog.open();
}

function registerToLogin() {
    // registerByPhoneDialog.close();
    registerByEmailDialog.close();
    loginDialog.open();
}

// function phoneRegisterToEmailRegister() {
//     registerByPhoneDialog.close();
//     registerByEmailDialog.open();
// }

// function emailRegisterToPhoneRegister() {
//     registerByEmailDialog.close();
//     registerByPhoneDialog.open();
// }

//密码重置对话框
var resetDialog = new mdui.Dialog('#reset-dialog');

//打开重置框
function openResetDialog() {
    resetDialog.open();
}

function resetToRegister() {
    resetDialog.close();
    // registerByPhoneDialog.open();
    registerByEmailDialog.open();
}

function resetToLogin() {
    resetDialog.close();
    loginDialog.open();
}

//页面跳转函数 tab使用
function jumpTo(url) {
    setTimeout(function () {
        location.href = url;
    }, 300);

}
//页面跳转保留参数函数 tab使用
function searchJumpTo(type) {
    var keywords = GetQueryString('keywords');
    setTimeout(function () {
        location.href = '?' + $$.param({
            keywords: keywords,
            type: type
        });
    }, 300);
}

//页面顶部tab及底部nav的激活
var tabVal = $$('#tabActiveVal').text();
var bottomVal = $$('#bottomNavActiveVal').text();

$$('#' + tabVal).addClass('mdui-tab-active');
$$('#' + bottomVal).addClass('mdui-bottom-nav-active');

$("input[name='loginPassword']").keydown(function (e) {
    var curKey = e.which;
    if (curKey === 13) {
        loginSubmit();
    }
});

//Ajax用户登录验证
function loginSubmit() {
    var email = $$('input[name="loginEmail"]').val();
    var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$"); //邮箱正则表达式
    var password = $$('input[name="loginPassword"]').val();
    var remember_me = $$('input[name="remember_me"]').is(':checked');
    var loginEmailErrorField = $$('#loginEmailError');
    var loginPasswordErrorField = $$('#loginPasswordError');
    var loginEmailTextField = $$('#loginEmailTextField');
    var loginPasswordTextField = $$('#loginPasswordTextField');
    var emailHasError = false;
    var passwordHasError = false;


    //至少6位
    if (password.length < 6) {
        passwordHasError = true;
    }
    //邮箱验证开始
    if (email === "") {
        emailHasError = true;
    } else if (!reg.test(email)) { //邮箱正则验证不通过，格式不对
        emailHasError = true;
    }

    if (passwordHasError || emailHasError) {
        if (passwordHasError === true) {
            loginPasswordTextField.addClass('mdui-textfield-invalid');
        } else {
            loginPasswordTextField.removeClass('mdui-textfield-invalid');
        }
        if (emailHasError === true) {
            loginEmailTextField.addClass('mdui-textfield-invalid');
        } else {
            loginEmailTextField.removeClass('mdui-textfield-invalid');
        }
    } else {
        $$.ajax({
            method: 'POST',
            url: '/auth/login',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                password: password,
                remember_me: remember_me
            },
            statusCode: {
                422: function (data) {
                    data = JSON.parse(data.response);
                    if (data.errors.email) {
                        loginEmailErrorField.text(data.errors.email[0]);
                        emailHasError = true;
                    }
                    if (data.errors.password) {
                        loginPasswordErrorField.text(data.errors.password[0]);
                        passwordHasError = true;
                    }
                }
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    //登录成功
                    $$('#loginForm').addClass('mdui-hidden');
                    $$('.dialog-top-tip-button').addClass('mdui-hidden');
                    $$('.username').text(data.user.name);
                    $$('.personalCenterUrl').attr('href', '/user/' + data.user.id);
                    $$('#loginSuccessful').removeClass('mdui-hidden');
                    $$('#loginSuccessIcon').animateCss('rotateIn');
                    loginDialog.handleUpdate();
                    setTimeout(function () {
                        //使用  setTimeout（）方法设定定时3000毫秒
                        location.href = GetUrlRelativePath();
                        //页面刷新
                    }, 3000);
                } else {
                    loginPasswordErrorField.text(data.msg);
                    passwordHasError = true;
                }
            },
            complete: function (xhr, textStatus) {
                if (emailHasError === true) {
                    loginEmailTextField.addClass('mdui-textfield-invalid');
                } else {
                    loginEmailTextField.removeClass('mdui-textfield-invalid');
                }
                if (passwordHasError === true) {
                    loginPasswordTextField.addClass('mdui-textfield-invalid');
                } else {
                    loginPasswordTextField.removeClass('mdui-textfield-invalid');
                }
            }
        });
    }
}

$("input[name='resetEmail']").keydown(function (e) {
    var curKey = e.which;
    if (curKey === 13) {
        resetSubmit();
    }
});

//Ajax用户登录验证
function resetSubmit() {
    var email = $$('input[name="resetEmail"]').val();
    var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$"); //邮箱正则表达式
    var resetEmailErrorField = $$('#resetEmailError');
    var resetEmailTextField = $$('#resetEmailTextField');
    var emailHasError = false;

    //邮箱验证开始
    if (email === "") {
        emailHasError = true;
    } else if (!reg.test(email)) { //邮箱正则验证不通过，格式不对
        emailHasError = true;
    }

    if (emailHasError) {
        resetEmailTextField.addClass('mdui-textfield-invalid');
    } else {
        resetEmailTextField.removeClass('mdui-textfield-invalid');
        $$.ajax({
            method: 'POST',
            url: '/auth/resetPassword',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email
            },
            beforeSend: function () {
                $$('#resetSubmitBtn').html('<div class="mdui-spinner mdui-spinner-colorful"></div>');
                mdui.mutation();
            },
            statusCode: {
                422: function (data) {
                    data = JSON.parse(data.response);
                    if (data.errors.email) {
                        resetEmailErrorField.text(data.errors.email[0]);
                        emailHasError = true;
                    }
                    $$('#resetSubmitBtn').html('NEXT');
                }
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    //发送成功
                    $$('#resetForm').addClass('mdui-hidden');
                    $$('#resetSendSuccessful').removeClass('mdui-hidden');
                    $$('#resetSuccessIcon').animateCss('swing');
                    resetDialog.handleUpdate();
                }
            },
            complete: function (xhr, textStatus) {
                if (emailHasError === true) {
                    resetEmailTextField.addClass('mdui-textfield-invalid');
                } else {
                    resetEmailTextField.removeClass('mdui-textfield-invalid');
                }
                $$('#resetSubmitBtn').html('NEXT');
            }
        });

    }
}

$("input[name='registerByEmailEmail']").keydown(function (e) {
    var curKey = e.which;
    if (curKey === 13) {
        registerByEmailStep1Next();
    }
});
$("input[name='registerByPhonePhone']").keydown(function (e) {
    var curKey = e.which;
    if (curKey === 13) {
        registerByPhoneStep1Next();
    }
});

//注册部分下一步
function registerByEmailStep1Next() {
    var userName = $$('input[name="registerByEmailName"]').val();
    var email = $$('input[name="registerByEmailEmail"]').val();
    var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$"); //邮箱正则表达式
    var registerEmailTextField = $$('#registerByEmailEmailTextField');
    var registerEmailErrorField = $$('#registerByEmailEmailErrorField');
    var registerNameTextField = $$('#registerByEmailNameTextField');
    var nameHasError = false;
    var emailHasError = false;
    //用户名验证
    if (userName === "") {
        nameHasError = true;
    }
    //邮箱验证开始
    if (email === "") {
        emailHasError = true;
    } else if (!reg.test(email)) { //邮箱正则验证不通过，格式不对
        emailHasError = true;
    } else {
        $$.ajax({
            method: 'POST',
            url: '/auth/checkEmailUnique',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email
            },
            statusCode: {
                422: function (data) {
                    data = JSON.parse(data.response);
                    if (data.errors.email) {
                        registerEmailErrorField.text(data.errors.email[0]);
                        emailHasError = true;
                    }
                },
                404: function (data) {
                    data = JSON.parse(data.response);
                    if (data.errors.email) {
                        registerEmailErrorField.text('Server internal error');
                        emailHasError = true;
                    }
                },
                500: function (data) {
                    data = JSON.parse(data.response);
                    if (data.errors.email) {
                        registerEmailErrorField.text('Server internal error');
                        emailHasError = true;
                    }
                }
            },
            complete: function (xhr, textStatus) {
                //跳转
                if (nameHasError || emailHasError) {
                    if (emailHasError === true) {
                        registerEmailTextField.addClass('mdui-textfield-invalid');
                    } else {
                        registerEmailTextField.removeClass('mdui-textfield-invalid');
                    }
                    if (nameHasError === true) {
                        registerNameTextField.addClass('mdui-textfield-invalid');
                    } else {
                        registerNameTextField.removeClass('mdui-textfield-invalid');
                    }
                } else {
                    $$('#registerByEmailStep1Form').addClass('mdui-hidden');
                    $$('#registerByEmailStep2Form').removeClass('mdui-hidden');
                    registerByEmailDialog.handleUpdate();
                }
            }
        });
    }
}

function registerByPhoneStep1Next() {
    var userName = $$('input[name="registerName"]').val();
    var email = $$('input[name="registerEmail"]').val();
    var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$"); //邮箱正则表达式
    var registerEmailTextField = $$('#registerEmailTextField');
    var registerEmailErrorField = $$('#registerEmailErrorField');
    var registerNameTextField = $$('#registerNameTextField');
    var nameHasError = false;
    var emailHasError = false;
    //用户名验证
    if (userName === "") {
        nameHasError = true;
    }
    //邮箱验证开始
    if (email === "") {
        emailHasError = true;
    } else if (!reg.test(email)) { //邮箱正则验证不通过，格式不对
        emailHasError = true;
    } else {
        $$.ajax({
            method: 'POST',
            url: '/auth/checkEmailUnique',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email
            },
            statusCode: {
                422: function (data) {
                    data = JSON.parse(data.response);
                    if (data.errors.email) {
                        registerEmailErrorField.text(data.errors.email[0]);
                        emailHasError = true;
                    }
                },
                404: function (data) {
                    data = JSON.parse(data.response);
                    if (data.errors.email) {
                        registerEmailErrorField.text('Server internal error');
                        emailHasError = true;
                    }
                },
                500: function (data) {
                    data = JSON.parse(data.response);
                    if (data.errors.email) {
                        registerEmailErrorField.text('Server internal error');
                        emailHasError = true;
                    }
                }
            },
            complete: function (xhr, textStatus) {
                //跳转
                if (nameHasError || emailHasError) {
                    if (emailHasError === true) {
                        registerEmailTextField.addClass('mdui-textfield-invalid');
                    } else {
                        registerEmailTextField.removeClass('mdui-textfield-invalid');
                    }
                    if (nameHasError === true) {
                        registerNameTextField.addClass('mdui-textfield-invalid');
                    } else {
                        registerNameTextField.removeClass('mdui-textfield-invalid');
                    }
                } else {
                    $$('#registerStep1Form').addClass('mdui-hidden');
                    $$('#registerStep2Form').removeClass('mdui-hidden');
                    registerByEmailDialog.handleUpdate();
                }
            }
        });
    }
}

$("input[name='registerByEmailPasswordConfirmation']").keydown(function (e) {
    var curKey = e.which;
    if (curKey === 13) {
        registerByEmailStep2Submit();
    }
});

//Ajax注册提交部分
function registerByEmailStep2Submit() {
    var userName = $$('input[name="registerByEmailName"]').val();
    var email = $$('input[name="registerByEmailEmail"]').val();
    var password = $$('input[name="registerByEmailPassword"]').val();
    var password_confirmation = $$('input[name="registerByEmailPasswordConfirmation"]').val();
    var registerPasswordErrorField = $$('#registerByEmailPasswordError');
    var registerPasswordConfirmErrorField = $$('#registerByEmailPasswordConfirmError');
    var registerPasswordTextField = $$('#registerByEmailPasswordTextField');
    var registerPasswordConfirmTextField = $$('#registerByEmailPasswordConfirmTextField');
    var passwordHasError = false;
    var passwordConfirmHasError = false;

    //至少6位
    if (password.length < 6) {
        passwordHasError = true;
    }
    if (password_confirmation !== password) {
        passwordConfirmHasError = true;
    }

    if (passwordHasError || passwordConfirmHasError) {
        if (passwordHasError === true) {
            registerPasswordTextField.addClass('mdui-textfield-invalid');
        } else {
            registerPasswordTextField.removeClass('mdui-textfield-invalid');
        }
        if (passwordConfirmHasError === true) {
            registerPasswordConfirmTextField.addClass('mdui-textfield-invalid');
        } else {
            registerPasswordConfirmTextField.removeClass('mdui-textfield-invalid');
        }
    } else {
        $$.ajax({
            method: 'POST',
            url: '/auth/register',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                name: userName,
                password: password,
                password_confirmation: password_confirmation
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    $$('#registerByEmailStep2Form').addClass('mdui-hidden');
                    $$('.registerSuccessful').removeClass('mdui-hidden');
                    $$('#registerEmailSuccessIcon').animateCss('swing');
                    registerByEmailDialog.handleUpdate();
                }
            }
        });
    }
}

function registerByPhoneStep2Submit() {
    var userName = $$('input[name="registerName"]').val();
    var email = $$('input[name="registerEmail"]').val();
    var password = $$('input[name="registerPassword"]').val();
    var password_confirmation = $$('input[name="registerPasswordConfirmation"]').val();
    var registerPasswordErrorField = $$('#registerPasswordError');
    var registerPasswordConfirmErrorField = $$('#registerPasswordConfirmError');
    var registerPasswordTextField = $$('#registerPasswordTextField');
    var registerPasswordConfirmTextField = $$('#registerPasswordConfirmTextField');
    var passwordHasError = false;
    var passwordConfirmHasError = false;

    //至少6位
    if (password.length < 6) {
        passwordHasError = true;
    }
    if (password_confirmation !== password) {
        passwordConfirmHasError = true;
    }

    if (passwordHasError || passwordConfirmHasError) {
        if (passwordHasError === true) {
            registerPasswordTextField.addClass('mdui-textfield-invalid');
        } else {
            registerPasswordTextField.removeClass('mdui-textfield-invalid');
        }
        if (passwordConfirmHasError === true) {
            registerPasswordConfirmTextField.addClass('mdui-textfield-invalid');
        } else {
            registerPasswordConfirmTextField.removeClass('mdui-textfield-invalid');
        }
    } else {
        $$.ajax({
            method: 'POST',
            url: '/auth/register',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                name: userName,
                password: password,
                password_confirmation: password_confirmation
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    $$('#registerStep2Form').addClass('mdui-hidden');
                    $$('#registerSuccessful').removeClass('mdui-hidden');
                    $$('#registerEmailSuccessIcon').animateCss('swing');
                    registerByEmailDialog.handleUpdate();
                }
            }
        });
    }
}

var editUserInfoDialog = new mdui.Dialog('#edit-user-info-dialog', {
    modal: true
});
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

    var editUserInfoNameTextField = $$('#editUserInfoNameTextField');
    var nameHasError = false;

    if (name === "") {
        nameHasError = true;
    }
    if (nameHasError === true) {
        editUserInfoNameTextField.addClass('mdui-textfield-invalid');
    } else {
        editUserInfoNameTextField.removeClass('mdui-textfield-invalid');
        $$.ajax({
            method: 'POST',
            url: '/user/' + id + '/edit/info',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                name: name,
                sex: sex,
                sex_open: sex_open,
                motto: motto,
                wechat: wechat,
                wechat_open: wechat_open,
                nation: nation,
                nation_open: nation_open,
                living_city: living_city,
                living_city_open: living_city_open,
                engaged_in: engaged_in,
                engaged_in_open: engaged_in_open
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    mdui.snackbar({
                        message: 'Your personal information has been successfully updated<br/>你的个人资料已成功更新',
                        position: 'top'
                    });
                    setTimeout(function () {
                        //使用  setTimeout（）方法设定定时5000毫秒
                        window.location.reload(); //页面刷新
                    }, 2000);
                }
            }
        });
    }

}

/**
 * 处理头像上传
 * @param obj
 * @param className
 */
function handleAvatarUpdate(obj, className) {
    var avatarImg = $$('.' + className);
    var avatar = obj.files[0];
    var id = $$('input[name="userId"]').val();

    ImgToBase64(avatar, 400, function (base64) {
        $$.ajax({
            method: 'POST',
            url: '/user/' + id + '/upload/avatar',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                img_data: base64
            },
            //禁止的原因是,FormData已经帮我们做了处理
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    avatarImg.attr('src', data.src);
                    mdui.snackbar({
                        message: 'The Avatar has been uploaded successfully<br/>头像已成功上传',
                        position: 'top'
                    });
                }
            }
        });
    });
}

/**
 * 处理封面上传
 * @param obj
 * @param className
 */
function handleCoverUpdate(obj, className) {
    var coverImg = $$('.' + className);
    var coverDrawerImg = $$('.coverDrawerImg');
    var cover = obj.files[0];
    var id = $$('input[name="userId"]').val();

    ImgToBase64(cover, 1280, function (base64) {
        $$.ajax({
            method: 'POST',
            url: '/user/' + id + '/upload/cover',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                img_data: base64
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    coverImg.css('background-image', 'url(' + data.src + ')');
                    coverDrawerImg.attr('src', data.src);
                    mdui.snackbar({
                        message: 'The Cover has been uploaded successfully<br/>封面已成功上传',
                        position: 'top'
                    });
                }
            }
        });
    });
}

//新闻页面的ajax翻页
if ($$('#NewsCenterData').length > 0) {
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() + 2 >= $(document).height()) {
            page++;
            loadMoreNews(page);
        }
    });

    function loadMoreNews(page) {
        $$.ajax({
            method: 'get',
            url: '?page=' + page,
            beforeSend: function () {
                $$('#NewsCenterLoadingTip').show();
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.html == "") {
                    $$('#NewsCenterLoadingTip').empty();
                    $$('#NewsCenterLoadingFailed').show();
                    return;
                }
                $$('#NewsCenterLoadingTip').hide();
                $$("#NewsCenterData").append('' +
                    '<div class="animated fadeInUp">' +
                    '<div class="mdui-divider-inset news-page-divider">' +
                    '       <span class="page-num">' + page + '</span>' +
                    '       <span class="page-text">Page</span>' +
                    '    </div>' +
                    '' + data.html + '' +
                    '</div>');
            }
        });

    }

}
//新闻回复的ajax翻页
if ($$('#NewsReplyData').length > 0) {
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() + 2 >= $(document).height()) {
            page++;
            loadMoreNewsReply(page);
        }
    });

    function loadMoreNewsReply(page) {
        var orderBy = GetQueryString('orderBy');
        $$.ajax({
            method: 'get',
            url: '?' + $$.param({
                orderBy: orderBy,
                page: page
            }),
            beforeSend: function () {
                $$('#NewsReplyLoadingTip').show();
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.html == "") {
                    $$('#NewsReplyLoadingTip').empty();
                    $$('#NewsReplyLoadingFailed').show();
                    return;
                }
                $$('#NewsReplyLoadingTip').hide();
                $$("#NewsReplyData").append('<div class="animated fadeInUp">' + data.html + '</div>');
            }
        });

    }

}

//Ajax提交新闻评论
function ajaxSubmitNewsCommentForm(url) {
    var content = $$('textarea[name="content"]').val();
    // 简单表单验证
    if (removeHTMLTag(content).length < 2) {
        mdui.snackbar('News replies need at least 2 characters<br>新闻回复至少需要2个字符', {
            position: 'top',
            timeout: 0,
            buttonText: 'ok'
        });
        return;
    }
    $$.ajax({
        method: 'POST',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        data: {
            content: content
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status === 1) {
                mdui.snackbar({
                    message: data.msg,
                    position: 'top'
                });
                setTimeout(function () {
                    //使用  setTimeout（）方法设定定时2000毫秒
                    window.location.reload(); //页面刷新
                }, 2000);
            } else {
                mdui.snackbar(data.msg, {
                    position: 'top',
                    timeout: 0,
                    buttonText: 'ok'
                });
            }
        },
        statusCode: {
            422: function (data) {
                data = JSON.parse(data.response);
                mdui.snackbar(data.errors.content, {
                    position: 'top',
                    timeout: 0,
                    buttonText: 'ok'
                });
            },
            401: function (data) {
                handleNotLogged();
            }
        }

    });

}

/**
 * 删除新闻回复
 * @param newsReplyId
 * @param newsReplyContent
 */
function deleteNewsReply(newsReplyId, newsReplyContent) {
    mdui.dialog({
        title: 'Delete news replies <br><small>删除新闻回复</small>',
        content: 'Are you sure you want to delete this news reply?<br><small>您确定要删除此新闻回复吗</small><br/>' + newsReplyContent,
        buttons: [{
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function (inst) {
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news/reply/delete',
                        data: {
                            id: newsReplyId
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('Server internal error<br/>服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status === 1) {
                                mdui.snackbar({
                                    message: data.msg,
                                    position: 'top'
                                });
                                setTimeout(function () {
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload(); //页面刷新
                                }, 2000);
                            } else {
                                mdui.snackbar(data.msg, {
                                    position: 'top',
                                    timeout: 0,
                                    buttonText: 'ok'
                                });
                            }

                        }
                    });
                }
            }
        ]
    });
}

function deleteCommunityTopicReply(Id, Content) {
    mdui.dialog({
        title: 'Delete Community Topic Reply<br><small>删除社区话题回复</small>',
        content: 'Are you sure you want to delete this Community Topic Reply?<br><small>您确定要删除此话题回复吗</small><br/>' + Content,

        buttons: [{
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function (inst) {
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/community/topic/reply/delete',
                        data: {
                            id: Id
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('Server internal error<br/>服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status === 1) {
                                mdui.snackbar({
                                    message: data.msg,
                                    position: 'top'
                                });
                                setTimeout(function () {
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload(); //页面刷新
                                }, 2000);
                            } else {
                                mdui.snackbar({
                                    message: data.msg,
                                    position: 'top'
                                });
                            }

                        }
                    });
                }
            }
        ]
    });
}

function replyToReply(userName, userId) {
    editor.txt.html('<a href="/user/' + userId + '">@' + userId + '-' + userName + ' :</a>');
    location.href = "#createComment";
    $('#editorText').focus();
}

//社区列表页的ajax加载
var page = 1;

function ajaxLoadCommunityTopics() {
    page++;
    var orderBy = GetQueryString('orderBy');
    $$.ajax({
        method: 'get',
        url: '?' + $$.param({
            orderBy: orderBy,
            page: page
        }),
        beforeSend: function () {
            $$('#CommunityTopicsLoadingBtn').hide();
            $$('#CommunityTopicsLoadingTip').show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.html == "") {
                $$('#CommunityTopicsLoadingTip').empty();
                $$('#CommunityTopicsLoadingFailed').show();
                return;
            }
            $$('#CommunityTopicsLoadingTip').hide();
            $$("#CommunityTopicsData").append('' +
                '<div class="animated fadeInUp mdui-m-t-3">' +
                '<div class="mdui-divider-inset news-page-divider">' +
                '       <span class="page-num">' + page + '</span>' +
                '       <span class="page-text">Page</span>' +
                '    </div>' +
                '' + data.html + '' +
                '</div>');
            $$('#CommunityTopicsLoadingBtn').show();
        }
    });
}

//Ajax提交话题评论
function ajaxSubmitTopicCommentForm(url) {
    var content = $$('textarea[name="content"]').val();
    // 简单表单验证
    if (removeHTMLTag(content).length < 2) {
        mdui.snackbar('Topic replies need at least 2 characters<br>话题回复至少需要2个字符', {
            position: 'top',
            timeout: 0,
            buttonText: 'ok'
        });
        return;
    }
    $$.ajax({
        method: 'POST',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        data: {
            content: content
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status === 1) {
                mdui.snackbar({
                    message: data.msg,
                    position: 'top'
                });
                setTimeout(function () {
                    //使用  setTimeout（）方法设定定时2000毫秒
                    window.location.reload(); //页面刷新
                }, 2000);
            } else {
                mdui.snackbar(data.msg, {
                    position: 'top',
                    timeout: 0,
                    buttonText: 'ok'
                });
            }
        },
        statusCode: {
            422: function (data) {
                data = JSON.parse(data.response);
                mdui.snackbar(data.errors.content, {
                    position: 'top',
                    timeout: 0,
                    buttonText: 'ok'
                });
            },
            401: function (data) {
                handleNotLogged();
            }
        }

    });

}

//话题回复的ajax加载
var page = 1;

function ajaxLoadTopicReplies() {
    page++;
    var orderBy = GetQueryString('orderBy');
    $$.ajax({
        method: 'get',
        url: '?' + $$.param({
            orderBy: orderBy,
            page: page
        }),
        beforeSend: function () {
            $$('#TopicRepliesLoadingBtn').hide();
            $$('#TopicRepliesLoadingTip').show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.html == "") {
                $$('#TopicRepliesLoadingTip').empty();
                $$('#TopicRepliesLoadingFailed').show();
                return;
            }
            $$('#TopicRepliesLoadingTip').hide();
            $$("#TopicRepliesData").append('' +
                '<div class="animated fadeInUp mdui-m-t-3">' +
                '<div class="mdui-divider-inset news-page-divider">' +
                '       <span class="page-num">' + page + '</span>' +
                '       <span class="page-text">Page</span>' +
                '    </div>' +
                '' + data.html + '' +
                '</div>');
            $$('#TopicRepliesLoadingBtn').show();
        }
    });
}

//Ajax评论投票
function ajaxHandleReplyVote(voteUrl, cancelVoteUrl, replyId, obj) {
    var num = obj.getElementsByTagName("span")[0];
    var icon = obj.getElementsByTagName("i")[0];
    if ($$(obj).hasClass('mdui-text-color-pink-accent')) {
        //已经投票过
        $$.ajax({
            method: 'POST',
            url: cancelVoteUrl,
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                replyId: replyId
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    $$(obj).removeClass('mdui-text-color-pink-accent');
                    $$(num).text(data.thumb_up_count);
                    $$(icon).animateCss('jello');

                } else {
                    mdui.snackbar(data.msg, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            },
            statusCode: {
                422: function (data) {
                    data = JSON.parse(data.response);
                    mdui.snackbar(data.errors.content, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            }

        });
    } else {
        //还未投票过
        $$.ajax({
            method: 'POST',
            url: voteUrl,
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                replyId: replyId
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    $$(obj).addClass('mdui-text-color-pink-accent');
                    $$(num).text(data.thumb_up_count);
                    $$(icon).animateCss('swing');

                } else {
                    mdui.snackbar(data.msg, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            },
            statusCode: {
                422: function (data) {
                    data = JSON.parse(data.response);
                    mdui.snackbar(data.errors.content, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            }

        });
    }

}

//Ajax话题投票
function ajaxHandleTopicVote(voteUrl, cancelVoteUrl, topicId, obj, numClass) {
    var num = $$('.' + numClass);
    if ($$(obj).hasClass('mdui-color-pink-accent')) {
        //已经投票过
        $$.ajax({
            method: 'POST',
            url: cancelVoteUrl,
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: topicId
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    $$(obj).removeClass('mdui-color-pink-accent');
                    $$(obj).addClass('mdui-text-color-pink-accent');
                    $$(obj).animateCss('jello');
                    num.text(data.thumb_up_count);
                } else {
                    mdui.snackbar(data.msg, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            },
            statusCode: {
                422: function (data) {
                    data = JSON.parse(data.response);
                    mdui.snackbar(data.errors.content, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                },
                401: function (data) {
                    handleNotLogged();
                }
            }

        });
    } else {
        //还未投票过
        $$.ajax({
            method: 'POST',
            url: voteUrl,
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: topicId
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    $$(obj).removeClass('mdui-text-color-pink-accent');
                    $$(obj).addClass('mdui-color-pink-accent');
                    $$(obj).animateCss('swing');
                    num.text(data.thumb_up_count)
                } else {
                    mdui.snackbar(data.msg, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            },
            statusCode: {
                422: function (data) {
                    data = JSON.parse(data.response);
                    mdui.snackbar(data.errors.content, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                },
                401: function (data) {
                    handleNotLogged();
                }
            }

        });
    }
}

//监听查看topic点赞
function ajaxGetTopicVoters(url, topicId) {
    setTimeout(function () {
        $$.ajax({
            method: 'post',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: topicId
            },
            beforeSend: function () {
                $$('TopicVotersLoadingTip').show();
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    if (data.html == "") {
                        $$("#TopicVotersData").empty();
                        $$('#TopicVotersLoadingTip').hide();
                        $$('#TopicVotersLoadingFailed').show();
                        return;
                    }
                    $$('#TopicVotersLoadingTip').hide();
                    $$('#TopicVotersLoadingFailed').hide();
                    $$("#TopicVotersData").empty();
                    $$("#TopicVotersData").append(data.html);
                } else {
                    mdui.snackbar(data.msg, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            }
        });
    }, 500);
}

//初始化新建话题页面选择section
var selectSection = new mdui.Select('#selectSection', {
    position: 'bottom'
});

function handleSelGetSections(zoneId, classToAppend) {
    $$.ajax({
        method: 'POST',
        url: '/community/category/getSectionsByZoneId',
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: zoneId
        },
        success: function (data) {
            data = JSON.parse(data);
            var sectionsHtmlToAppend = '<option value="null">Please select Section</option>';
            $$.each(data.sections, function (i, value) {
                sectionsHtmlToAppend += '<option value="' + value.id + '">' + value.name + '</option>'
            });
            $$('.' + classToAppend).empty();
            $$('.' + classToAppend).append(sectionsHtmlToAppend);
            selectSection.handleUpdate();
        }
    });

}

//表单提交按钮
function formPublicSubmit(formid) {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='publish'/>");
    tmpStatusInput.appendTo(formid);
    $$(formid).submit();
}

function formHiddenSubmit(formid) {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='hidden'/>");
    tmpStatusInput.appendTo(formid);
    $$(formid).submit();
}

var followDialog = new mdui.Dialog('#follow-dialog');
var followDialogDom = $$('#follow-dialog');
var userIsMe = $$('input[name="userIsMe"]').val();
/**
 * 处理显示正在关注的用户
 * @param url
 * @param userId
 */
function handleShowFollowingsDialog(url, userId) {
    $$('#FollowDialogTitle').text('Following / 正在关注');
    $$('#FollowDialogLoadingFailed').hide();
    followDialog.open();
    followDialogDom.on('opened.mdui.dialog', function () {
        $$.ajax({
            method: 'post',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: userId
            },
            beforeSend: function () {
                $$('#FollowDialogLoadingTip').show();
                followDialog.handleUpdate();
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    if (data.html == "") {
                        $$('#FollowDialogLoadingTip').hide();
                        if (userIsMe) {
                            $$('#FollowDialogLoadingFailedText').html('You can try to follow others<br/>尝试去关注别人吧');
                        } else {
                            $$('#FollowDialogLoadingFailedText').html('This user is not following anyone<br/>此用户没有关注任何人');
                        }
                        $$('#FollowDialogLoadingFailed').show();
                        followDialog.handleUpdate();
                        return;
                    }
                    $$('#FollowDialogLoadingTip').hide();
                    $$('#FollowDialogLoadingFailed').hide();
                    $$("#FollowDialogData").empty();
                    followDialog.handleUpdate();
                    $$("#FollowDialogData").append(data.html);
                    followDialog.handleUpdate();
                } else {
                    mdui.snackbar(data.msg, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            }
        });
    });
}
/**
 * 处理显示被关注的用户
 * @param url
 * @param userId
 */
function handleShowFollowersDialog(url, userId) {

    $$('#FollowDialogTitle').text('Followers / 关注者');
    $$('#FollowDialogLoadingFailed').hide();
    followDialog.open();
    followDialogDom.on('opened.mdui.dialog', function () {
        $$.ajax({
            method: 'post',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: userId
            },
            beforeSend: function () {
                $$('#FollowDialogLoadingTip').show();
                followDialog.handleUpdate();
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 1) {
                    if (data.html == "") {
                        $$('#FollowDialogLoadingTip').hide();
                        if (userIsMe) {
                            $$('#FollowDialogLoadingFailedText').html('No people following me now<br/>暂时无人关注我');
                        } else {
                            $$('#FollowDialogLoadingFailedText').html('No people following the user now<br/>暂时无人关注此用户');
                        }
                        $$('#FollowDialogLoadingFailed').show();
                        followDialog.handleUpdate();
                        return;
                    }
                    $$('#FollowDialogLoadingTip').hide();
                    $$('#FollowDialogLoadingFailed').hide();
                    $$("#FollowDialogData").empty();
                    followDialog.handleUpdate();
                    $$("#FollowDialogData").append(data.html);
                    followDialog.handleUpdate();
                } else {
                    mdui.snackbar(data.msg, {
                        position: 'top',
                        timeout: 0,
                        buttonText: 'ok'
                    });
                }
            }
        });
    });
}

followDialogDom.on('close.mdui.dialog', function () {
    $$("#FollowDialogData").empty();
    followDialog.handleUpdate();
    followDialog.destroy();
});

//Ajax话题投票
function ajaxHandleFollowUser(followUrl, unfollowUrl, userId, obj, numClass) {
    if ($$('meta[name="isLogged"]').attr('content') !== '1') {
        handleNotLogged();
    } else {
        var num = $$('.' + numClass);
        var text = obj.getElementsByTagName("span")[0];
        var icon = obj.getElementsByTagName("i")[0];
        if ($$(obj).hasClass('mdui-color-pink-accent')) {
            //已经投票过
            $$.ajax({
                method: 'POST',
                url: unfollowUrl,
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: userId
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status === 1) {
                        $$(obj).removeClass('mdui-color-pink-accent');
                        $$(obj).addClass('mdui-text-color-pink-accent');
                        $$(icon).html('&#xe87e;');
                        $$(text).text($$('input[name="__follow"]').val());
                        $$(icon).animateCss('jello');
                        num.text(data.follower_count);
                    } else {
                        mdui.snackbar(data.msg, {
                            position: 'top',
                            timeout: 0,
                            buttonText: 'ok'
                        });
                    }
                },
                statusCode: {
                    422: function (data) {
                        data = JSON.parse(data.response);
                        mdui.snackbar(data.errors.content, {
                            position: 'top',
                            timeout: 0,
                            buttonText: 'ok'
                        });
                    },
                    401: function (data) {
                        handleNotLogged();
                    }
                }

            });
        } else {
            //还未投票过
            $$.ajax({
                method: 'POST',
                url: followUrl,
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: userId
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status === 1) {
                        $$(obj).addClass('mdui-color-pink-accent');
                        $$(obj).removeClass('mdui-text-color-pink-accent');
                        $$(icon).html('&#xe87d;');
                        $$(text).text($$('input[name="__followed"]').val());
                        $$(icon).animateCss('swing');
                        num.text(data.follower_count)
                    } else {
                        mdui.snackbar(data.msg, {
                            position: 'top',
                            timeout: 0,
                            buttonText: 'ok'
                        });
                    }
                },
                statusCode: {
                    422: function (data) {
                        data = JSON.parse(data.response);
                        mdui.snackbar(data.errors.content, {
                            position: 'top',
                            timeout: 0,
                            buttonText: 'ok'
                        });
                    },
                    401: function (data) {
                        handleNotLogged();
                    }
                }

            });
        }
    }
}

//发现页面的ajax翻页
if ($$('#ActivityListData').length > 0) {
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() + 2 >= $(document).height()) {
            page++;
            loadMoreActivity(page);
        }
    });

    function loadMoreActivity(page) {
        var view = GetQueryString('view');
        $$.ajax({
            method: 'get',
            url: '?' + $$.param({
                view: view,
                page: page
            }),
            beforeSend: function () {
                $$('#ActivityListLoadingTip').show();
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.html == "") {
                    $$('#ActivityListLoadingTip').empty();
                    $$('#ActivityListLoadingFailed').show();
                    return;
                }
                $$('#ActivityListLoadingTip').hide();
                $$("#ActivityListData").append('<div class="animated fadeInUp">' + data.html + '</div>');
            }
        });

    }

}
//个人页面的ajax翻页
if ($$('#PersonalCenterListData').length > 0) {
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() + 2 >= $(document).height()) {
            page++;
            loadMorePCList(page);
        }
    });

    function loadMorePCList(page) {
        var view = GetQueryString('view');
        $$.ajax({
            method: 'get',
            url: '?' + $$.param({
                view: view,
                page: page
            }),
            beforeSend: function () {
                $$('#PersonalCenterListLoadingTip').show();
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.html == "") {
                    $$('#PersonalCenterListLoadingTip').empty();
                    $$('#PersonalCenterListLoadingFailed').show();
                    return;
                }
                $$('#PersonalCenterListLoadingTip').hide();
                $$("#PersonalCenterListData").append('<div class="animated fadeInUp">' + data.html + '</div>');
            }
        });

    }

}

function handleCloseHelpUpdateInfo(url) {
    mdui.dialog({
        title: $$('input[name="__closeHelpEditTitle"]').val(),
        content: $$('input[name="__closeHelpEditContent"]').val(),
        buttons: [{
                text: 'cancel'
            },
            {
                text: 'ok',
                onClick: function (inst) {
                    $$.ajax({
                        method: 'POST',
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status === 1) {
                                mdui.snackbar({
                                    message: data.msg,
                                    position: 'top'
                                });
                                setTimeout(function () {
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload(); //页面刷新
                                }, 2000);
                            } else {
                                mdui.snackbar(data.msg, {
                                    position: 'top',
                                    timeout: 0,
                                    buttonText: 'ok'
                                });
                            }
                        }
                    });

                }
            }
        ]
    });
}

/**
 *发现页搜索提示框
 */
var discoverSearchTipsMenu = new mdui.Menu('#search', '#searchTips', {
    position: 'bottom',
    fixed: false
});
var searchInput = $('#search');

//保存定时器ID
var tid = null;

//延迟执行函数
function debounce(fn, wait) {
    //设定默认的延迟时间
    wait = wait || 500;
    //清除定时器
    tid && clearTimeout(tid);
    //定时器执行
    tid = setTimeout(fn, wait);
}

searchInput.focus(function (event) {
    $('#searchTips').width(searchInput.width() - 20);
    debounce(function () {

        discoverSearchTipsMenu.open();
    }, 500);
});

searchInput.bind("input propertychange change", function (event) {
    $('#searchTips').width(searchInput.width() - 20);
    discoverSearchTipsMenu.open();
    debounce(function () {
        var keywords = searchInput.val();
        getSearchInputTips(keywords, 'search');
    }, 800);
});

/**
 * Ajax搜索获取实时tips并更新dom
 * @param keywords
 * @param preType 搜索框前缀 如barSearch search
 */
function getSearchInputTips(keywords, preType) {
    $$.ajax({
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/search/tips',
        data: {
            keywords: keywords
        },
        beforeSend: function () {
            $('.' + preType + 'TipsAjaxProgress').append('<div class="mdui-progress-indeterminate"></div>');
        },
        success: function (data) {
            //JSON字符串转JSON
            data = $.parseJSON(data);
            var searchTipsContent = $('#' + preType + 'TipsContent');
            searchTipsContent.empty();
            searchTipsContent.append(data.html);
        },

        complete: function () {
            $('.' + preType + 'TipsAjaxProgress').empty();
        }
    });
}

/**
 *bar搜索提示框
 */
var barSearchTipsMenu = new mdui.Menu('#barSearchLabel', '#barSearchTips', {
    position: 'bottom',
    fixed: true
});
var barSearchInput = $('#barSearch');

barSearchInput.focus(function (event) {
    hideBarTitle();
    debounce(function () {
        $('#barSearchTips').width(barSearchInput.width() + 20);
        barSearchTipsMenu.open();
    }, 500);
});

barSearchInput.bind("input propertychange change", function (event) {
    $('#barSearchTips').width(barSearchInput.width() + 20);
    barSearchTipsMenu.open();
    debounce(function () {
        var keywords = barSearchInput.val();
        getSearchInputTips(keywords, 'barSearch');
    }, 800);
});

function hideBarTitle() {
    $$('#barTitle').hide();
    $$('#barSubTitle').hide();
    $$('#barMenu').hide();
    $$.showOverlay(900);
    setTimeout(function () {
        $$('#barSearchBtn').attr('type', 'submit');
    }, 300);
}

function showBarTitle() {
    $$('#barTitle').show();
    $$('#barMenu').show();
    $$('#barSubTitle').show();
    $$.hideOverlay(900);
    setTimeout(function () {
        $$('#barSearchBtn').attr('type', 'button');
    }, 300);

}

barSearchInput.focusout(function (event) {
    $$.hideOverlay(900);
});


//搜索框的提交
$("#discoverSearchForm").submit(function (e) {
    var searchInput = $('#search');
    searchInput.val(encodeURI(searchInput.val()));
});
$("#barSearchForm").submit(function (e) {
    var searchInput = $('#barSearch');
    searchInput.val(encodeURI(searchInput.val()));
});

//搜索-社区列表的ajax加载
var page = 1;

function ajaxLoadSearchCommunityTopics() {
    page++;
    var type = GetQueryString('type');
    var keywords = GetQueryString('keywords');
    $$.ajax({
        method: 'get',
        url: '?' + $$.param({
            type: type,
            keywords: keywords,
            page: page
        }),
        beforeSend: function () {
            $$('#CommunityTopicsLoadingBtn').hide();
            $$('#CommunityTopicsLoadingTip').show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.html == "") {
                $$('#CommunityTopicsLoadingTip').empty();
                $$('#CommunityTopicsLoadingFailed').show();
                return;
            }
            $$('#CommunityTopicsLoadingTip').hide();
            $$("#CommunityTopicsData").append('' +
                '<div class="animated fadeInUp mdui-m-t-3">' +
                '<div class="mdui-divider-inset news-page-divider">' +
                '       <span class="page-num">' + page + '</span>' +
                '       <span class="page-text">Page</span>' +
                '    </div>' +
                '' + data.html + '' +
                '</div>');
            $$('#CommunityTopicsLoadingBtn').show();
        }
    });
}
//搜索-用户列表的ajax加载
var page = 1;

function ajaxLoadSearchUsers() {
    page++;
    var type = GetQueryString('type');
    var keywords = GetQueryString('keywords');
    $$.ajax({
        method: 'get',
        url: '?' + $$.param({
            type: type,
            keywords: keywords,
            page: page
        }),
        beforeSend: function () {
            $$('#UsersLoadingBtn').hide();
            $$('#UsersLoadingTip').show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.html == "") {
                $$('#UsersLoadingTip').empty();
                $$('#UsersLoadingFailed').show();
                return;
            }
            $$('#UsersLoadingTip').hide();
            $$("#UsersData").append('' +
                '<div class="animated fadeInUp mdui-m-t-3">' +
                '<div class="mdui-divider-inset news-page-divider">' +
                '       <span class="page-num">' + page + '</span>' +
                '       <span class="page-text">Page</span>' +
                '    </div>' +
                '' + data.html + '' +
                '</div>');
            $$('#UsersLoadingBtn').show();
        }
    });
}
//搜索-新闻列表的ajax加载
var page = 1;

function ajaxLoadSearchNews() {
    page++;
    var type = GetQueryString('type');
    var keywords = GetQueryString('keywords');
    $$.ajax({
        method: 'get',
        url: '?' + $$.param({
            type: type,
            keywords: keywords,
            page: page
        }),
        beforeSend: function () {
            $$('#NewsLoadingBtn').hide();
            $$('#NewsLoadingTip').show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.html == "") {
                $$('#NewsLoadingTip').empty();
                $$('#NewsLoadingFailed').show();
                return;
            }
            $$('#NewsLoadingTip').hide();
            $$("#NewsData").append('' +
                '<div class="animated fadeInUp mdui-m-t-3">' +
                '<div class="mdui-divider-inset news-page-divider">' +
                '       <span class="page-num">' + page + '</span>' +
                '       <span class="page-text">Page</span>' +
                '    </div>' +
                '' + data.html + '' +
                '</div>');
            $$('#NewsLoadingBtn').show();
        }
    });
}

/**
 * 删除社区话题
 * @param topicId
 * @param topicContent
 */
function deleteCommunityTopic(topicId, topicContent) {
    mdui.dialog({
        title: 'Delete Community topic <br><small>删除社区话题</small>',
        content: 'Are you sure you want to delete this topic?<br><small>您确定要删除此社区话题吗</small><br/>' + topicContent,
        buttons: [{
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function (inst) {
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/community/topic/delete',
                        data: {
                            id: topicId
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('Server internal error<br/>服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status === 1) {
                                mdui.snackbar({
                                    message: data.msg,
                                    position: 'top'
                                });
                                setTimeout(function () {
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload(); //页面刷新
                                }, 2000);
                            } else {
                                mdui.snackbar({
                                    message: data.msg,
                                    position: 'top'
                                });
                            }

                        }
                    });
                }
            }
        ]
    });
}

/**
 * 删除新闻
 * @param newsId
 * @param newsTitle
 */
function deleteNews(newsId, newsTitle) {
    mdui.dialog({
        title: 'Delete News <br><small>删除新闻</small>',
        content: 'Are you sure you want to delete this news?<br><small>您确定要删除此社区话题吗</small><br/>' + newsTitle,
        buttons: [{
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function (inst) {
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news/delete',
                        data: {
                            id: newsId
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('Server internal error<br/>服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data = JSON.parse(data)
                            if (data.status === 1) {
                                mdui.snackbar({
                                    message: data.msg,
                                    position: 'top'
                                });
                                setTimeout(function () {
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload(); //页面刷新
                                }, 2000);
                            } else {
                                mdui.snackbar(data.msg, {
                                    position: 'top',
                                    timeout: 0,
                                    buttonText: 'ok'
                                });
                            }

                        }
                    });
                }
            }
        ]
    });
}


// 过滤html标签
function removeHTMLTag(str) {
    str = str.replace(/<\/?[^>]*>/g, ''); //去除HTML tag
    return str;
}

/**
 * 将图片压缩转换为base64
 * @param file
 * @param maxLen
 * @param callBack
 * @constructor
 */
function ImgToBase64(file, maxLen, callBack) {
    var img = new Image();

    var reader = new FileReader(); //读取客户端上的文件
    reader.onload = function () {
        var url = reader.result; //读取到的文件内容.这个属性只在读取操作完成之后才有效,并且数据的格式取决于读取操作是由哪个方法发起的.所以必须使用reader.onload，
        img.src = url; //reader读取的文件内容是base64,利用这个url就能实现上传前预览图片
    };
    img.onload = function () {
        //生成比例
        var width = img.width,
            height = img.height;
        //计算缩放比例
        var rate = 1;
        if (width >= height) {
            if (width > maxLen) {
                rate = maxLen / width;
            }
        } else {
            if (height > maxLen) {
                rate = maxLen / height;
            }
        };
        img.width = width * rate;
        img.height = height * rate;
        //生成canvas
        var canvas = document.createElement("canvas");
        var ctx = canvas.getContext("2d");
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0, img.width, img.height);
        var base64 = canvas.toDataURL('image/jpeg', 0.9);
        callBack(base64);
    };
    reader.readAsDataURL(file);
}

//社区话题移动端页面顶部用户信息
var mobileTopicUserInfoTop = new mdui.Collapse('#mobileTopicUserInfoTop');

function toggleMobileTopicUserInfoTop() {
    mobileTopicUserInfoTop.toggle(0);
}
$$('#mobileTopicUserInfoTopItem').on('open.mdui.collapse', function () {
    $$('#mobileTopicUserInfoTopBtn').addClass('topic-mobile-user-info-btn-180');
});
$$('#mobileTopicUserInfoTopItem').on('close.mdui.collapse', function () {
    $$('#mobileTopicUserInfoTopBtn').removeClass('topic-mobile-user-info-btn-180');
});

//消息发送页面内容框高度
var windowHeight = $$(window).height();
var windowWidth = $$(window).width();
if (windowWidth > 1024) {
    $$('#messageContentList').height(windowHeight - 350);
} else if (windowWidth > 599) {
    $$('#messageContentList').height(windowHeight - 290);
} else {
    $$('#messageContentList').height(windowHeight - 325);
}

var messageContentTextarea = $$('#messageContent');
var messageContentList = $('#messageContentList');
var messageSendBtn = $$('#messageSendBtn');
var messageSendLoading = $$('#messageSendLoading');
var isMessageNull = true;

$(document).ready(function () {
    if (messageContentList.length > 0) {
        messageContentList.scrollTop(messageContentList[0].scrollHeight);
    }
});

messageContentTextarea.on('input propertychange', function () {
    var messageContent = $$('#messageContent').text();
    if (messageContent.length > 0) {
        messageSendBtn.removeAttr('disabled');
        isMessageNull = false;
    } else {
        messageSendBtn.attr('disabled', true);
        isMessageNull = true;
    }
});

function handleMessagePageSend(threadId) {
    if (isMessageNull) {
        mdui.snackbar({
            message: 'Please say something :-)',
            position: 'bottom'
        });
    } else {
        messageSendBtn.animateCss('zoomOutRight', function () {
            messageSendBtn.hide();
            messageSendLoading.show();
            var messageContent = $$('#messageContent').text();
            $$.ajax({
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                method: 'PUT',
                url: '/messages/' + threadId,
                data: {
                    message: messageContent
                },
                success: function (data) {
                    messageContentTextarea.empty();
                    //JSON字符串转JSON
                    data = $.parseJSON(data);
                    messageContentList.append(data.html);
                    messageContentList.scrollTop(messageContentList[0].scrollHeight);

                },
                complete: function () {
                    setTimeout(function () {
                        messageSendLoading.hide();
                        messageSendBtn.show();
                    }, 500);
                }
            });
        });
    }
}

function handlePhotoMessagePageSend(threadId, obj) {
    var photo = obj.files[0];
    messageSendBtn.animateCss('zoomOutRight', function () {
        messageSendBtn.hide();
        messageSendLoading.show();
        ImgToBase64(photo, 1280, function (base64) {
            $$.ajax({
                method: 'POST',
                url: '/messages/' + threadId + '/photo',
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    img_data: base64,
                },
                success: function (data) {
                    data = JSON.parse(data);
                    $$('#messageContentListToAdd').append(data.html);
                    messageContentList.scrollTop(messageContentList[0].scrollHeight);
                    //相册重新初始化
                    initPhotoSwipeFromDOM('.photo-gallery');
                },
                complete: function () {
                    setTimeout(function () {
                        messageSendLoading.hide();
                        messageSendBtn.show();
                    }, 500);
                }
            });
        });

    });
}

//社区话题移动端页面顶部用户信息
var messageContentMoreFunBar = new mdui.Collapse('#messageContentMoreFunBar');
var messageContentMoreFunBarItem = $$('#messageContentMoreFunBarItem');
var messageContentMoreFunBtn = $$('#messageContentMoreFunBtn');

function toggleMessageContentMoreFunBar() {
    messageContentMoreFunBar.toggle(0);
}
messageContentMoreFunBarItem.on('open.mdui.collapse', function () {
    messageContentMoreFunBtn.addClass('message-content-form-textarea-btn-45');
});
messageContentMoreFunBarItem.on('close.mdui.collapse', function () {
    messageContentMoreFunBtn.removeClass('message-content-form-textarea-btn-45');
});

//显示全部参与者对话框
var messageParticipantDialog = new mdui.Dialog('#messageParticipantDialog');

function handleShowAllParticipants(threadId) {
    messageParticipantDialog.open();
    $$.ajax({
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/messages/' + threadId + '/allParticipants',
        statusCode: {
            500: function (xhr, textStatus) {
                mdui.alert('Server internal error<br/>服务器内部错误');
            }
        },
        success: function (data) {
            data = JSON.parse(data);
            $$('#messageParticipantDialogContent').empty();
            $$('#messageParticipantDialogContent').append(data.html);
            messageParticipantDialog.handleUpdate();
        }
    });
}

//显示添加参与者对话框
var addParticipantDialog = new mdui.Dialog('#addParticipantDialog');

function handleGetParticipantsToSelect(threadId) {
    addParticipantDialog.open();
    $$.ajax({
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/messages/' + threadId + '/showParticipantsToSelect',
        statusCode: {
            500: function (xhr, textStatus) {
                mdui.alert('Server internal error<br/>服务器内部错误');
            }
        },
        success: function (data) {
            data = JSON.parse(data);
            $$('#addParticipantDialogContent').empty();
            $$('#addParticipantDialogContent').append(data.html);
            addParticipantDialog.handleUpdate();
        }
    });
}

function handleRemoveParticipants(threadId) {
    var messageParticipantDialogloading = $$("#messageParticipantDialogloading");
    var messageParticipantDialogOK = $$("#messageParticipantDialogOK");
    messageParticipantDialogOK.hide();
    messageParticipantDialogloading.show();

    var removeUsers_ids = [];
    $$('input[name="participants"]').each(function (i, value) {
        if (!$$(value).is(':checked')) {
            removeUsers_ids.push($$(this).val()); //向数组中添加元素
        }
    });

    $$.ajax({
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/messages/' + threadId + '/removeParticipants',
        data: {
            removeUsers: removeUsers_ids
        },
        statusCode: {
            500: function (xhr, textStatus) {
                mdui.alert('Server internal error<br/>服务器内部错误');
            }
        },
        success: function (data) {
            data = JSON.parse(data);
            messageParticipantDialog.close();
        },
        complete: function () {
            messageParticipantDialogloading.hide();
            messageParticipantDialogOK.show();
        }
    });
}

function handleAddParticipants(threadId) {
    var addParticipantDialogloading = $$("#addParticipantDialogloading");
    var addParticipantDialogOK = $$("#addParticipantDialogOK");

    var addUsers_ids = [];
    $$('input[name="participants_to_add"]').each(function (i, value) {
        if ($$(value).is(':checked')) {
            addUsers_ids.push($$(this).val()); //向数组中添加元素
        }
    });
    if (addUsers_ids.length > 0) {
        addParticipantDialogOK.hide();
        addParticipantDialogloading.show();
        $$.ajax({
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/messages/' + threadId + '/addParticipants',
            data: {
                addUsers: addUsers_ids
            },
            statusCode: {
                500: function (xhr, textStatus) {
                    mdui.alert('Server internal error<br/>服务器内部错误');
                }
            },
            success: function (data) {
                data = JSON.parse(data);
                addParticipantDialog.close();
            },
            complete: function () {
                addParticipantDialogloading.hide();
                addParticipantDialogOK.show();
            }
        });
    } else {
        addParticipantDialog.close();
    }
}

//显示创建话题对话框
var createMessageContentDialog = new mdui.Dialog('#createMessageContentDialog');
var createMessageSelectReceiversDialog = new mdui.Dialog('#createMessageSelectReceiversDialog');
var messageReceiverIds = [];

function selectReceiversToCreateMessage() {
    if ($$('meta[name="isLogged"]').attr('content') !== '1') {
        handleNotLogged();
    } else {
        createMessageSelectReceiversDialog.open();
        $$.ajax({
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/messages/showFollowingsToSelect',
            statusCode: {
                500: function (xhr, textStatus) {
                    mdui.alert('Server internal error<br/>服务器内部错误');
                }
            },
            success: function (data) {
                data = JSON.parse(data);
                $$('#createMessageSelectReceiversDialogContent').empty();
                $$('#createMessageSelectReceiversDialogContent').append(data.html);
                createMessageSelectReceiversDialog.handleUpdate();
            }
        });
    }
}

function handleSelectedReceiversToSendMessage() {
    if ($$('meta[name="isLogged"]').attr('content') !== '1') {
        handleNotLogged();
    } else {
        var addUsers_ids = [];
        $$('input[name="participants_to_add"]').each(function (i, value) {
            if ($$(value).is(':checked')) {
                addUsers_ids.push($$(this).val()); //向数组中添加元素
            }
        });
        if (!addUsers_ids.length > 0) {
            mdui.snackbar({
                message: "You haven't chosen the receiver yet.",
                buttonText: 'OK',
                position: 'top',
            });
        } else {
            showCreateMessageDialog(addUsers_ids);
            createMessageSelectReceiversDialog.close();
        }
    }
}

function showCreateMessageDialog(receiverIds) {
    if ($$('meta[name="isLogged"]').attr('content') !== '1') {
        handleNotLogged();
    } else {
        $$('#createMessagePage').show();
        $$('#createMessageSuccess').hide();
        createMessageContentDialog.open();
        messageReceiverIds = receiverIds;
    }
}

$$('#createMessageContentDialogBtn').on('click', function () {
    if (messageReceiverIds && messageReceiverIds.length > 0) {
        var createMessageSubject = $$('input[name="createMessageSubject"]').val();
        var createMessageContent = $$('textarea[name="createMessageContent"]').val();

        var createMessageContentDialogloading = $$("#createMessageContentDialogloading");
        var createMessageContentDialogSend = $$("#createMessageContentDialogSend");

        if (!createMessageSubject) {
            mdui.snackbar({
                message: "Subject can't be empty.",
                buttonText: 'OK',
                position: 'top',
            });
        } else if (!createMessageContent) {
            mdui.snackbar({
                message: "Message content can't be empty.",
                buttonText: 'OK',
                position: 'top',
            });
        } else {
            createMessageContentDialogSend.hide();
            createMessageContentDialogloading.show();

            $$.ajax({
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/messages/',
                data: {
                    subject: createMessageSubject,
                    message: createMessageContent,
                    recipients: messageReceiverIds,
                },
                statusCode: {
                    500: function (xhr, textStatus) {
                        mdui.alert('Server internal error<br/>服务器内部错误');
                    }
                },
                success: function (data) {
                    data = JSON.parse(data);
                    $$('#createMessagePage').hide();
                    $$('#createMessageSuccess').show();
                    createMessageContentDialog.handleUpdate();
                    $$('#messageSendSuccessIcon').animateCss('fadeInLeft');
                },
                complete: function () {
                    createMessageContentDialogloading.hide();
                    createMessageContentDialogSend.show();
                }
            });
        }
    }
});

var editorToolBar = $$('.editor-toolbar');
var origOffsetY = editorToolBar.offset().top;

function onScroll(e) {
    var editorTextElementOffset = $$("#editorText").offset();
    if (window.scrollY >= origOffsetY && window.scrollY < editorTextElementOffset.top + editorTextElementOffset.height + 40) {
        editorToolBar.addClass('sticky')
    } else {
        editorToolBar.removeClass('sticky')
    }
}
document.addEventListener('scroll', onScroll);

/*********************************************************
 * PhotoSwipe
 * */
var initPhotoSwipeFromDOM = function (gallerySelector) {

    // parse slide data (url, title, size ...) from DOM elements
    // (children of gallerySelector)
    var parseThumbnailElements = function (el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for (var i = 0; i < numNodes; i++) {
            if (thumbElements[i].nodeName !== "FIGURE") {
                continue;
            }
            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes
            if (figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };



            if (figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML;
            }

            if (linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            }

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }
        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && (fn(el) ? el : closest(el.parentNode, fn));
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function (e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function (el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if (!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if (childNodes[i].nodeName !== "FIGURE") {
                continue;
            }

            if (childNodes[i].nodeType !== 1) {
                continue;
            }

            if (childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }



        if (index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe(index, clickedGallery);
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function () {
        var hash = window.location.hash.substring(1),
            params = {};

        if (hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if (!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');
            if (pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }

        if (params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function (index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),

            getThumbBoundsFn: function (index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();

                return {
                    x: rect.left,
                    y: rect.top + pageYScroll,
                    w: rect.width
                };
            }

        };

        // PhotoSwipe opened from URL
        if (fromURL) {
            if (options.galleryPIDs) {
                // parse real index when custom PIDs are used
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for (var j = 0; j < items.length; j++) {
                    if (items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if (isNaN(options.index)) {
            return;
        }

        if (disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll(gallerySelector);

    for (var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i + 1);
        // galleryElements[i].onclick = onThumbnailsClick;
        $$.each(galleryElements[i].childNodes, function (i, value) {
            if (value.nodeName == "FIGURE") {
                $$.each(value.childNodes, function (i, value) {
                    if (value.nodeName == "A") {
                        value.onclick = onThumbnailsClick;
                    }
                })
            }
        })

    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if (hashData.pid && hashData.gid) {
        openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
    }
};

// execute above function
initPhotoSwipeFromDOM('.photo-gallery');

/********************************
 * END PhotoSwipe
 * */