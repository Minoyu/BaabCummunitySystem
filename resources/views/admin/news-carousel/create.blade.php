@extends('frame.adminframe')
@section('title','新闻轮播管理')
@section('subtitleUrl',route('adminNewsCarouselsList'))
@section('adminDrawerActiveVal','drawer-newsOtherItem')

@section('content')
        <form id="createNewsCarouselForm" method="post" action="{{route('adminNewsCarouselStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">创建新闻中心轮播图</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.轮播图标题</h3>
                    <label class="mdui-textfield-label">请输入轮播图的标题</label>
                    <input class="mdui-textfield-input" name="title" required/>
                </div>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">2.轮播图副标题</h3>
                <label class="mdui-textfield-label">请输入轮播图副标题用于展示</label>
                <input class="mdui-textfield-input" name="subtitle" required>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">3.跳转链接
                    <br><small class="show-file-title-sub">请输入链接用于跳转</small>
                </h3>
                <input class="mdui-textfield-input" name="url" placeholder="http(s)://" required>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">4.图片上传
                <br><small class="show-file-title-sub">点击下方图片上传,推荐尺寸1000*500(2:1)</small></h3>
            <label for="newsCoverUploadInput">
                <img src="/imgs/default_news_cover.png" class="avatar mdui-hoverable newsCover" style="width: 400px; height: 200px">
            </label>
            <input class="mdui-hidden" id="newsCoverUploadInput" type="file" onchange="handleNewsCarouselUpdate(this,'newsCover')" accept="image/jpeg,image/png">
            <input class="mdui-hidden" type="text" name="cover_img" required>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">5.优先级
                <br><small class="show-file-title-sub">优先级范围0-20，从左到右递增，推荐默认为0</small>
                <br><small class="show-file-title-sub">轮播图将先依照优先级排序，相同优先级下依照发布时间排序</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="0" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#createNewsCarouselForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#createNewsCarouselForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>{{__('community.save')}}</button>
            <a href="{{route('adminNewsCarouselsList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
