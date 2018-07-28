//新闻分类部分
//创建提交按钮
function createNewsCategorySubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='public'/>");
    tmpStatusInput.appendTo('#createNewsCategoryForm');
    $$('#createNewsCategoryForm').submit();
}
//创建暂存按钮
function saveNewsCategorySubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='hidden'/>");
    tmpStatusInput.appendTo('#createNewsCategoryForm');
    $$('#createNewsCategoryForm').submit();
}
//编辑提交按钮
function editNewsCategorySubmit() {
    var tmpStatusInput = $$("<input class='mdui-hidden' type='text' name='status' value='public'/>");
    tmpStatusInput.appendTo('#editNewsCategoryForm');
    $$('#editNewsCategoryForm').submit();
}
//编辑暂存按钮
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

var E = window.wangEditor;
if ($$('#newsEditor').length>0){
    var editor = new E('#newsEditor');
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
