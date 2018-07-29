@extends('frame.adminframe')
@section('title','新闻管理')
@section('subtitleUrl',route('adminNewsList'))

@section('content')
        <form id="createNewsForm" method="post" action="{{route('adminNewsStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">创建新闻</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.新闻标题</h3>
                    <label class="mdui-textfield-label">请输入新闻标题</label>
                    <input class="mdui-textfield-input" name="title"/>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2">2.新闻分类</h3>
            <select name="news_category_id" class="mdui-select" mdui-select="{position: 'bottom'}">
                <option value="null">请选择分类</option>
                @foreach($newsCategories as $newsCategory)
                    <option value="{{$newsCategory->id}}">{{$newsCategory->name}}</option>
                @endforeach
            </select>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2">3.新闻内容</h3>
            <div class="mdui-m-t-1 admin-editor-toolbar mdui-hoverable" id="newsEditorToolbar"></div>
            <div class="admin-editor-middle-bar">编辑区域</div>
            <div id="newsEditorText" class="admin-editor-text mdui-hoverable" ><p>在此添加新闻内容</p></div>
            <textarea id="newsContentTextArea" name="content" class="mdui-hidden"></textarea>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">4.封面图片
            <br><small class="show-file-title-sub">点击下方图片上传,留空则无封面</small></h3>
            <label for="newsCoverUploadInput">
                <img src="/imgs/default_news_cover.png" class="avatar mdui-hoverable newsCover" style="width: 300px; height: 200px">
            </label>
            <input class="mdui-hidden" id="newsCoverUploadInput" type="file" onchange="handleNewsCoverUpdate(this,'newsCover')" accept="image/jpeg,image/png">
            <input class="mdui-hidden" type="text" name="cover_img">

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">5.失效日期
            <br><small class="show-file-title-sub">超过失效日期的文章将不在列表中显示，留空则不设置失效日期</small></h3>
            <input type="text" class="layui-input" name="invalided_at" style="max-width: 300px" id="selInvalidedAt">

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">6.优先级
            <br><small class="show-file-title-sub">优先级范围0-50，从左到右递增，默认为0</small>
            <br><small class="show-file-title-sub">文章将先依照优先级排序，相同优先级下依照发布时间排序</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="50" value="0" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="createNewsSubmit()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>发布</button>
            <button onclick="saveNewsSubmit()" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>暂存</button>
            <a href="{{route('adminNewsList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>返回</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
