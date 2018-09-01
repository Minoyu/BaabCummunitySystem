

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

$$(function () {
    //后台侧边栏展开激活
    var adminDrawerMenuCollapse = new mdui.Collapse('#adminDrawerMenu',{accordion:true});
    var adminDrawerActiveVal = $$('#adminDrawerActiveVal').text();

    adminDrawerMenuCollapse.open('#'+adminDrawerActiveVal);
    $$('#'+adminDrawerActiveVal).addClass('mdui-list-item-active');
});



//新闻分类部分

/**
 * 删除新闻分类
 * @param catId
 * @param catName
 */
function deleteNewsCategory(catId,catName) {
    mdui.dialog({
        title: 'Delete News Category<br><small>删除新闻分类</small>',
        content: 'Are you sure you want to delete this news category?<br><small>您确定要删除此新闻分类吗</small><br/>'+catName,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
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
                                mdui.snackbar(data.msg,{
                                    position:'top',
                                    timeout:0,
                                    buttonText:'ok'
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
        title: 'Batch delete News Category<br><small>批量删除新闻分类</small>',
        content: 'Are you sure you want to delete these news categories?<br><small>您确定要删除这些新闻分类吗</small><br/>'+names,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
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

/**
 * 删除新闻轮播图
 * @param id
 * @param name
 */
function deleteNewsCarousel(id,name) {
    mdui.dialog({
        title: 'Delete News Carousel<br><small>删除新闻轮播图</small>',
        content: 'Are you sure you want to delete this news carousel?<br><small>您确定要删除此新闻轮播图吗</small><br/>'+name,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/news-carousel/delete',
                        data: {
                            id:id
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
                                mdui.snackbar(data.msg,{
                                    position:'top',
                                    timeout:0,
                                    buttonText:'ok'
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
 * 处理新闻封面上传
 * @param obj
 * @param className
 */
function handleNewsCoverUpdate(obj,className) {
    var coverImg = $$('.'+className);
    var coverInput = $$('input[name="cover_img"]');
    var cover = obj.files[0];
    var id = $$('input[name="userId"]').val();

    ImgToBase64(cover, 900, function (base64) {
        $$.ajax({
            method: 'POST',
            url: '/admin/news/upload/cover',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                img_data:base64
            },
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
    });
}

/**
 * 处理新闻轮播图上传
 * @param obj
 * @param className
 */
function handleNewsCarouselUpdate(obj,className) {
    var coverImg = $$('.'+className);
    var coverInput = $$('input[name="cover_img"]');
    var cover = obj.files[0];
    var id = $$('input[name="userId"]').val();

    ImgToBase64(cover, 1000, function (base64) {
        $$.ajax({
            method: 'POST',
            url: '/admin/news-carousel/upload',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                img_data:base64
            },
            success: function (data) {
                data=JSON.parse(data);
                if (data.status===1){
                    coverImg.attr('src',data.src);
                    coverInput.val(data.src);
                    mdui.snackbar({
                        message:'The News Carousel has been uploaded successfully<br/>新闻轮播图已成功上传',
                        position:'top'
                    });
                }
            }
        });
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

/**
 * 删除新闻
 * @param newsId
 * @param newsTitle
 */
function deleteNews(newsId,newsTitle) {
    mdui.dialog({
        title: 'Delete News<br><small>删除新闻</small>',
        content: 'Are you sure you want to delete this news?<br><small>您确定要删除此新闻吗</small><br/>'+newsTitle,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
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
                                mdui.snackbar(data.msg,{
                                    position:'top',
                                    timeout:0,
                                    buttonText:'ok'
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
        title: 'Batch delete News<br><small>批量删除新闻</small>',
        content: 'Are you sure you want to delete these news?<br><small>您确定要删除这些新闻吗</small><br/>'+titles,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
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
                                mdui.snackbar(data.msg,{
                                    position:'top',
                                    timeout:0,
                                    buttonText:'ok'
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
        title: 'Delete News Reply<br><small>删除新闻回复</small>',
        content: 'Are you sure you want to delete this news reply?<br><small>您确定要删除此新闻回复吗</small><br/>'+newsReplyContent,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
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
                                mdui.snackbar(data.msg,{
                                    position:'top',
                                    timeout:0,
                                    buttonText:'ok'
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
        title: 'Batch delete News Replies<br><small>批量删除新闻回复</small>',
        content: 'Are you sure you want to delete these news replies?<br><small>您确定要删除这些新闻回复吗</small><br/>'+titles,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
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
                                mdui.alert('Server internal error<br/>服务器内部错误');
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
 * 处理zone封面图上传
 * @param obj
 * @param className
 */
function handleZoneImgUpdate(obj,className) {
    var Img = $$('.'+className);
    var Input = $$('input[name="img_url"]');
    var file = obj.files[0];

    ImgToBase64(file, 500, function (base64) {
        $$.ajax({
            method: 'POST',
            url: '/admin/community/category/zones/upload/img',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                img_data:base64
            },
            success: function (data) {
                data=JSON.parse(data);
                if (data.status===1){
                    Img.attr('src',data.src);
                    Input.val(data.src);
                    mdui.snackbar({
                        message:'The Cover has been uploaded successfully<br/>封面已成功上传',
                        position:'top'
                    });
                }
            }
        });
    });


}

//社区分类管理页collapse
var adminCommunityCategoryCollapse = new mdui.Collapse('#adminCommunityCategoryCollapse');

function adminCommunityCatOpenAll(){
    adminCommunityCategoryCollapse.openAll()
}
function adminCommunityCatCloseAll(){
    adminCommunityCategoryCollapse.closeAll()
}

/**
 * 删除社区zone
 * @param zoneId
 * @param zoneContent
 */
function deleteCommunityZone(zoneId,zoneContent) {
    mdui.dialog({
        title: 'Delete Community Zone<br><small>删除社区分区</small>',
        content: 'Are you sure you want to delete this Community Zone?<br><small>您确定要删除此社区分区吗</small><br/>'+zoneContent,

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/community/category/zone/delete',
                        data: {
                            id:zoneId
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
 * 删除社区section
 * @param sectionId
 * @param sectionContent
 */
function deleteCommunitySection(sectionId,sectionContent) {
    mdui.dialog({
        title: 'Delete Community Section<br><small>删除社区版块</small>',
        content: 'Are you sure you want to delete this Community Section?<br><small>您确定要删除此社区版块吗</small><br/>'+sectionContent,

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/community/category/section/delete',
                        data: {
                            id:sectionId
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

//初始化新建话题页面选择section
var adminSelectSection = new mdui.Select('#adminSelectSection',{position: 'bottom'});

function handleSelGetSections(zoneId,classToAppend){
    $$.ajax({
        method: 'POST',
        url: '/admin/community/category/getSectionsByZoneId',
        headers: {
            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
        },
        data:{
            id:zoneId
        },
        success: function (data) {
            data=JSON.parse(data);
            var sectionsHtmlToAppend='<option value="null">Please select a section</option>';
            $$.each(data.sections,function (i,value) {
                sectionsHtmlToAppend+='<option value="'+value.id+'">'+value.name+'</option>'
            });
            $$('.'+classToAppend).empty();
            $$('.'+classToAppend).append(sectionsHtmlToAppend);
            adminSelectSection.handleUpdate();
        }
    });

}

/**
 * 删除社区话题
 * @param topicId
 * @param topicContent
 */
function deleteCommunityTopic(topicId,topicContent) {
    mdui.dialog({
        title: 'Delete Community Topic<br><small>删除社区话题</small>',
        content: 'Are you sure you want to delete this Community Topic?<br><small>您确定要删除此社区话题吗</small><br/>'+topicContent,

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/community/topic/delete',
                        data: {
                            id:topicId
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
 * 批量删除社区话题
 */
function deleteCommunityTopics() {
    //获取选中对象数组
    var ids=getSelectedIds();
    var titles=getSelectedNames();
    //弹出确认对话框
    mdui.dialog({
        title: 'Batch delete Community Topics<br><small>批量删除社区话题</small>',
        content: 'Are you sure you want to delete these Community Topics?<br><small>您确定要删除这些社区话题吗</small><br/>'+titles,

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/community/topic/deletes',
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

function deleteCommunityTopicReply(Id,Content) {
    mdui.dialog({
        title: 'Delete Community Topic Reply<br><small>删除社区话题回复</small>',
        content: 'Are you sure you want to delete this Community Topic Reply?<br><small>您确定要删除此话题回复吗</small><br/>'+Content,

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/community/topic/reply/delete',
                        data: {
                            id:Id
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
function deleteCommunityTopicReplies() {
    //获取选中对象数组
    var ids=getSelectedIds();
    var titles=getSelectedNames();
    //弹出确认对话框
    mdui.dialog({
        title: 'Batch delete Community Topic Replies<br><small>批量删除社区话题回复</small>',
        content: 'Are you sure you want to delete these Community Topic Replies?<br><small>您确定要删除这些社区话题回复吗</small><br/>'+titles,

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/community/topic/reply/deletes',
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
 * 删除用户
 */
function deleteUser(Id,Content) {
    mdui.dialog({
        title: 'Delete User<br><small>删除用户</small>',
        content: 'Are you sure you want to delete this User?<br><small>您确定要删除此用户吗</small>'+
        '<br><span class="mdui-text-color-red">Warning: deleting the user will delete all content generated by the user at the same time</span>'+
        '<br><span class="mdui-text-color-red"><small>警告：删除用户将一并删除用户产生的所有内容</small></span><br/>'+Content,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/user/delete',
                        data: {
                            id:Id
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
 * 批量删除用户
 */
function deleteUsers() {
    //获取选中对象数组
    var ids=getSelectedIds();
    var titles=getSelectedNames();
    //弹出确认对话框
    mdui.dialog({
        title: 'Batch Delete User<br><small>批量删除用户</small>',
        content: 'Are you sure you want to delete these User?<br><small>您确定要删除这些用户吗</small>'+
        '<br><span class="mdui-text-color-red">Warning: deleting the user will delete all content generated by the user at the same time</span>'+
        '<br><span class="mdui-text-color-red"><small>警告：删除用户将一并删除用户产生的所有内容</small></span><br/>'+titles,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/user/deletes',
                        data: {
                            ids:ids
                        },
                        statusCode: {
                            500: function (xhr, textStatus) {
                                mdui.alert('Server internal error<br/>服务器内部错误');
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

function handlePermissionRemoveRole(permissionName,permissionId,roleName,roleId) {
    mdui.dialog({
        title: 'Remove roles from permission<br><small>移除此权限下的角色</small>',
        content: 'Are you sure to remove '+roleName+' from '+permissionName+
        '？<br><small>您确定要为'+permissionName+'权限移除'+roleName+'角色吗</small>' +
        '<br><span class="mdui-text-color-red">Warning: Users under this role will lose this permission after removal, please be cautious about the permissions and roles</span>'+
        '<br><span class="mdui-text-color-red"><small>警告：移除后该角色下的用户将失去此权限，请谨慎对权限及角色进行操作</small></span>',
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/permission/remove/role',
                        data: {
                            permissionId:permissionId,
                            roleId:roleId
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

function handleRoleRemovePermission(permissionName,permissionId,roleName,roleId) {
    mdui.dialog({
        title: 'Remove permission from role<br><small>移除此角色下的权限</small>',
        content: 'Are you sure to remove '+permissionName+' from '+roleName+
        '？<br><small>您确定要为'+roleName+'角色移除'+permissionName+'权限吗</small>' +
        '<br><span class="mdui-text-color-red">Warning: Users under this role will lose this permission after removal, please be cautious about the permissions and roles</span>'+
        '<br><span class="mdui-text-color-red"><small>警告：移除后该角色下的用户将失去此权限，请谨慎对权限及角色进行操作</small></span>',

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/role/remove/permission',
                        data: {
                            permissionId:permissionId,
                            roleId:roleId
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
 * 删除权限
 */
function deletePermission(Id,Content) {
    mdui.dialog({
        title: 'Delete Permission<br><small>删除权限</small>',
        content: 'Are you sure you want to delete this Permission?<br><small>您确定要删除此权限吗</small>'+
        '<br><span class="mdui-text-color-red">Warning: Please be cautious about permission operations</span>'+
        '<br><span class="mdui-text-color-red"><small>警告：请谨慎进行权限操作</small></span><br/>'+Content,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/permission/delete',
                        data: {
                            id:Id
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
 * 删除角色
 */
function deleteRole(Id,Content) {
    mdui.dialog({
        title: 'Delete Role<br><small>删除角色</small>',
        content: 'Are you sure you want to delete this Role?<br><small>您确定要删除此角色吗</small>'+
        '<br><span class="mdui-text-color-red">Warning: Please be cautious about role operations</span>'+
        '<br><span class="mdui-text-color-red"><small>警告：请谨慎进行角色操作</small></span><br/>'+Content,

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/role/delete',
                        data: {
                            id:Id
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
 * 删除新闻轮播图
 * @param id
 * @param name
 */
function deleteIndexCarousel(id,name) {
    mdui.dialog({
        title: 'Delete Index Carousel<br><small>删除首页轮播图</small>',
        content: 'Are you sure you want to delete this Index Carousel?<br><small>您确定要删除此首页轮播图吗</small><br>'+name,
        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/index-carousel/delete',
                        data: {
                            id:id
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
                                mdui.snackbar(data.msg,{
                                    position:'top',
                                    timeout:0,
                                    buttonText:'ok'
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
 * 删除首页头条
 * @param id
 * @param name
 */
function deleteIndexHeadline(id,name) {
    mdui.dialog({
        title: 'Delete Index Headline<br><small>删除首页头条</small>',
        content: 'Are you sure you want to delete this Index Headline?<br><small>您确定要删除此首页头条吗</small><br>'+name,

        buttons: [
            {
                text: 'Cancel'
            },
            {
                text: 'OK',
                onClick: function(inst){
                    $$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/admin/index-headline/delete',
                        data: {
                            id:id
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
                                mdui.snackbar(data.msg,{
                                    position:'top',
                                    timeout:0,
                                    buttonText:'ok'
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
 * 处理首页轮播图上传
 * @param obj
 * @param className
 */
function handleIndexCarouselUpdate(obj,className) {
    var coverImg = $$('.'+className);
    var coverInput = $$('input[name="cover_img"]');
    var cover = obj.files[0];
    var id = $$('input[name="userId"]').val();


    ImgToBase64(cover, 1000, function (base64) {
        $$.ajax({
            method: 'POST',
            url: '/admin/index-carousel/upload',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                img_data:base64
            },
            success: function (data) {
                data=JSON.parse(data);
                if (data.status===1){
                    coverImg.attr('src',data.src);
                    coverInput.val(data.src);
                    mdui.snackbar({
                        message:'The Index Carousel has been uploaded successfully<br/>首页轮播图已成功上传',
                        position:'top'
                    });
                }
            }
        });
    });

}

var changeRolesDialog = new mdui.Dialog('#changeRolesDialog');

function handleChangeUserRoles(userName,userId) {
    $$('#changeRolesUserName').text(userName);
    $$('#changeRolesUserId').val(userId);
    changeRolesDialog.open();
}

var changeRolesDialogDom = document.getElementById('changeRolesDialog');
if (changeRolesDialogDom){
    changeRolesDialogDom.addEventListener('confirm.mdui.dialog',function () {
        var role_ids=[];
        $$('input[name="role_id[]"]:checked').each(function(){
            role_ids.push($$(this).val());//向数组中添加元素
        });
        var userId =  $$('#changeRolesUserId').val();

        $$.ajax({
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/admin/user/changeRoles',
            data: {
                userId:userId,
                role_ids:role_ids
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
                    mdui.snackbar(data.msg,{
                        position:'top',
                        timeout:0,
                        buttonText:'ok'
                    });
                }

            }
        });

    });
}



//layui加载form样式
layui.use('form', function(){
    var form = layui.form;
    if (changeRolesDialogDom){
        changeRolesDialogDom.addEventListener('closed.mdui.dialog',function () {
            $$("input[type=checkbox]").each(function(){ //循环checkbox选择或取消
                $$(this).prop("checked",false);
            });
            form.render();
        });
    }
});
