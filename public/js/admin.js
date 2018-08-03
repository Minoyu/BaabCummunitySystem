//新闻分类部分
//创建提交按钮
function createNewsCategorySubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='public'/>");
    tmpStatusInput.appendTo('#createNewsCategoryForm');
    $$('#createNewsCategoryForm').submit();
}
//创建新闻分类暂存按钮
function saveNewsCategorySubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='hidden'/>");
    tmpStatusInput.appendTo('#createNewsCategoryForm');
    $$('#createNewsCategoryForm').submit();
}
//编辑新闻分类提交按钮
function editNewsCategorySubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='public'/>");
    tmpStatusInput.appendTo('#editNewsCategoryForm');
    $$('#editNewsCategoryForm').submit();
}
//编辑新闻分类暂存按钮
function editSaveNewsCategorySubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='hidden'/>");
    tmpStatusInput.appendTo('#editNewsCategoryForm');
    $$('#editNewsCategoryForm').submit();
}

/**
 * 删除新闻分类
 * @param catId
 * @param catName
 */
function deleteNewsCategory(catId,catName) {
    mdui.dialog({
        title: '删除新闻分类',
        content: '您确定要删除此新闻分类吗<br/>'+catName,
        buttons: [
            {
                text: '取消'
            },
            {
                text: '确认',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news-category/delete',
                        data: {
                            id:catId
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('Server internal error<br/>服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data = JSON.parse(data)
                            if (data.status ===1) {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
                                });
                                setTimeout(function(){
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload();//页面刷新
                                },2000);
                            } else {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
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
 * 获取表格中选择的项的id
 * @returns {Array}
 */
function getSelectedIds() {
    var ids=[];
    var result = $$('.mdui-table-row').map(function () {
        //判断如果选择则push进数组
        if ($$(this).hasClass('mdui-table-row-selected')) {
            ids.push($$(this).attr('id'));
        }
    });
    return ids;
}

/**
 * 获取表格中选择的项的name
 * @returns {Array}
 */
function getSelectedNames() {
    var names=[];
    var result = $$('.mdui-table-row').map(function () {
        //判断如果选择则push进数组
        if ($$(this).hasClass('mdui-table-row-selected')) {
            names.push($$(this).attr('name'));
        }
    });
    return names;
}

/**
 * 批量删除新闻分类
 */
function deleteNewsCategories() {
    //获取选中对象数组
    var ids=getSelectedIds();
    var names=getSelectedNames();
    //弹出确认对话框
    mdui.dialog({
        title: '批量删除新闻分类',
        content: '您确定要删除我们吗<br/>'+names,
        buttons: [
            {
                text: '取消'
            },
            {
                text: '确认',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news-category/deletes',
                        data: {
                            ids:ids
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data=JSON.parse(data);
                            if (data.status ===1) {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
                                });
                                setTimeout(function(){
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload();//页面刷新
                                },2000);
                            } else {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top',
                                    timeout:0,
                                    buttonText:'OK',
                                    buttonColor:'pink',
                                    onButtonClick: function(){
                                        window.location.reload();//页面刷新
                                    }
                                });
                            }

                        }
                    });
                }
            }
        ]
    });
}

//新闻编辑器
var E = window.wangEditor;
if ($$('#newsEditorToolbar').length>0){
    var editor = new E('#newsEditorToolbar','#newsEditorText');
    var textArea = $$('#newsContentTextArea');
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        textArea.val(html);
    };
    editor.customConfig.zIndex = 0;
    editor.customConfig.lang = {
        '设置标题': 'title',
        '正文': 'p',
        '链接文字': 'link text',
        '链接': 'link',
        '上传图片': 'upload image',
        '上传': 'upload',
        '创建': 'init'
        // 还可自定添加更多
    };
    editor.customConfig.uploadImgServer = '/admin/news/upload/img';
    editor.customConfig.uploadImgHeaders = {
        'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content'),
        'X-Requested-With': 'XMLHttpRequest'
    };
    editor.customConfig.uploadFileName = 'img[]';
    editor.create();
    // 初始化 textarea 的值
    textArea.val(editor.txt.html());
}

/**
 * 处理新闻封面上传
 * @param obj
 * @param className
 */
function handleNewsCoverUpdate(obj,className) {
    var coverImg = $$('.'+className);
    var coverInput = $$('input[name="cover_img"]');
    var cover = obj.files[0];
    var id = $$('input[name="userId"]').val();

    var form = new FormData();
    form.append('cover',cover);
    $$.ajax({
        method: 'POST',
        url: '/admin/news/upload/cover',
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
                coverImg.attr('src',data.src);
                coverInput.val(data.src);
                mdui.snackbar({
                    message:'The Cover has been uploaded successfully<br/>封面已成功上传',
                    position:'top'
                });
            }
        }
    });

}
//新闻失效日期选择
if ($$('#selInvalidedAt').length>0){
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#selInvalidedAt', //指定元素
            type:'datetime',
            lang: 'en'
        });
    });
}

function createNewsSubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='public'/>");
    tmpStatusInput.appendTo('#createNewsForm');
    $$('#createNewsForm').submit();
}
//创建新闻暂存按钮
function saveNewsSubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='hidden'/>");
    tmpStatusInput.appendTo('#createNewsForm');
    $$('#createNewsForm').submit();
}
//编辑新闻提交按钮
function editNewsSubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='public'/>");
    tmpStatusInput.appendTo('#editNewsForm');
    $$('#editNewsForm').submit();
}
//编辑新闻暂存按钮
function editSaveNewsSubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='hidden'/>");
    tmpStatusInput.appendTo('#editNewsForm');
    $$('#editNewsForm').submit();
}

/**
 * 删除新闻
 * @param newsId
 * @param newsTitle
 */
function deleteNews(newsId,newsTitle) {
    mdui.dialog({
        title: '删除新闻',
        content: '您确定要删除此新闻吗<br/>'+newsTitle,
        buttons: [
            {
                text: '取消'
            },
            {
                text: '确认',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news/delete',
                        data: {
                            id:newsId
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('Server internal error<br/>服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data = JSON.parse(data)
                            if (data.status ===1) {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
                                });
                                setTimeout(function(){
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload();//页面刷新
                                },2000);
                            } else {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
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
 * 批量删除新闻
 */
function deleteNewses() {
    //获取选中对象数组
    var ids=getSelectedIds();
    var titles=getSelectedNames();
    //弹出确认对话框
    mdui.dialog({
        title: '批量删除新闻',
        content: '您确定要删除我们吗<br/>'+titles,
        buttons: [
            {
                text: '取消'
            },
            {
                text: '确认',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news/deletes',
                        data: {
                            ids:ids
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data=JSON.parse(data);
                            if (data.status ===1) {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
                                });
                                setTimeout(function(){
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload();//页面刷新
                                },2000);
                            } else {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top',
                                    timeout:0,
                                    buttonText:'OK',
                                    buttonColor:'pink',
                                    onButtonClick: function(){
                                        window.location.reload();//页面刷新
                                    }
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
 * 删除新闻回复
 * @param newsReplyId
 * @param newsReplyContent
 */
function deleteNewsReply(newsReplyId,newsReplyContent) {
    mdui.dialog({
        title: '删除新闻回复',
        content: '您确定要删除此新闻回复吗<br/>'+newsReplyContent,
        buttons: [
            {
                text: '取消'
            },
            {
                text: '确认',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news/reply/delete',
                        data: {
                            id:newsReplyId
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('Server internal error<br/>服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status ===1) {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
                                });
                                setTimeout(function(){
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload();//页面刷新
                                },2000);
                            } else {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
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
 * 批量删除新闻回复
 */
function deleteNewsReplies() {
    //获取选中对象数组
    var ids=getSelectedIds();
    var titles=getSelectedNames();
    //弹出确认对话框
    mdui.dialog({
        title: '批量删除新闻回复',
        content: '您确定要删除我们吗<br/>'+titles,
        buttons: [
            {
                text: '取消'
            },
            {
                text: '确认',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news/reply/deletes',
                        data: {
                            ids:ids
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('服务器内部错误');
                            }
                        },
                        success: function (data) {
                            data=JSON.parse(data);
                            if (data.status ===1) {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top'
                                });
                                setTimeout(function(){
                                    //使用  setTimeout（）方法设定定时5000毫秒
                                    window.location.reload();//页面刷新
                                },2000);
                            } else {
                                mdui.snackbar({
                                    message:data.msg,
                                    position:'top',
                                    timeout:0,
                                    buttonText:'OK',
                                    buttonColor:'pink',
                                    onButtonClick: function(){
                                        window.location.reload();//页面刷新
                                    }
                                });
                            }

                        }
                    });
                }
            }
        ]
    });
}


