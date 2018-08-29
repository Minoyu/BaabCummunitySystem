@extends('frame.adminframe')
@section('title','首页轮播管理')
@section('subtitleUrl',route('adminIndexCarouselsList'))
@section('adminDrawerActiveVal','drawer-indexItem')

@section('content')
        <form id="createIndexCarouselForm" method="post" action="{{route('adminIndexCarouselStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">创建首页轮播图</h3>

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

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-3">4.轮播图位置
            </h3>
            <select name="position" class="mdui-select" required mdui-select>
                <option value="bannar">bannar——首页轮播大图</option>
                <option value="headline_left">headline_left——头条左侧轮播图</option>
                <option value="headline_right">headline_right——头条右侧轮播图</option>
                <option value="info_top">info_top——资讯上方轮播图</option>
                <option value="topic_top">topic_top——话题上方轮播图</option>
            </select>


            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-3 mdui-m-b-1">5.图片上传
                <br>
                <small class="show-file-title-sub">
                    注意：<br>
                    bannar—首页大图——推荐尺寸1000*500(2:1)<br>
                    headline—头条左右侧轮播图——推荐尺寸200*300(2:3)<br>
                    info_top及topic_top—资讯及话题上方轮播图——推荐尺寸600*200(3:1)<br>
                    点击下方图片上传
                </small>
            </h3>
            <label for="indexCoverUploadInput">
                <img src="/imgs/default_news_cover.png" class="avatar mdui-hoverable indexCover" style="max-width: 400px;">
            </label>
            <input class="mdui-hidden" id="indexCoverUploadInput" type="file" onchange="handleIndexCarouselUpdate(this,'indexCover')" accept="image/jpeg,image/png">
            <input class="mdui-hidden" type="text" name="cover_img" required>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">6.优先级
                <br><small class="show-file-title-sub">优先级范围0-20，从左到右递增，推荐默认为0</small>
                <br><small class="show-file-title-sub">轮播图将先依照优先级排序，相同优先级下依照发布时间排序</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="0" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#createIndexCarouselForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#createIndexCarouselForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>{{__('community.save')}}</button>
            <a href="{{route('adminIndexCarouselsList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
