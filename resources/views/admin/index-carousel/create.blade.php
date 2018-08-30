@extends('frame.adminframe')
@section('title',__('admin.indexCarousels'))
@section('subtitleUrl',route('adminIndexCarouselsList'))
@section('adminDrawerActiveVal','drawer-indexItem')

@section('content')
        <form id="createIndexCarouselForm" method="post" action="{{route('adminIndexCarouselStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{__('admin/index.createIndexCarousel')}}</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('admin.carouselTitle')}}</h3>
                    <input class="mdui-textfield-input" name="title" required/>
                </div>
            </div>

            <div class="mdui-textfield ">
                <h3 class="admin-index-title mdui-text-color-indigo">2.{{__('admin.carouselSubtitle')}}</h3>
                <input class="mdui-textfield-input" name="subtitle" required>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">3.{{__('admin.jumpLink')}}
                    <br><small class="show-file-title-sub">{{__('admin.jumpLinkTip')}}</small>
                </h3>
                <input class="mdui-textfield-input" name="url" placeholder="http(s)://" required>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo">4.{{__('admin/index.carouselPosition')}}
            </h3>
            <select name="position" class="mdui-select" required mdui-select>
                <option value="banner">banner // {{__('admin/index.bannerTip')}}</option>
                <option value="headline_left">headline_left // {{__('admin/index.headline_leftTip')}}</option>
                <option value="headline_right">headline_right // {{__('admin/index.headline_rightTip')}}</option>
                <option value="info_top">info_top // {{__('admin/index.info_topTip')}}</option>
                <option value="topic_top">topic_top // {{__('admin/index.topic_topTip')}}</option>
            </select>


            <h3 class="admin-index-title mdui-text-color-indigo">5.{{__('admin.imgUpload')}}
                <br>
                <small class="show-file-title-sub">
                    {{__('admin.clickBelowToUploadNote')}}<br><br>
                    {{__('index.note')}}：<br>
                    <span class="layui-badge-dot"></span> banner<br>{{__('admin/index.bannerTip')}} —— {{__('admin/index.recommendSize')}} 1000*500(2:1)<br>
                    <span class="layui-badge-dot layui-bg-green"></span> headline<br>{{__('admin/index.headlineTip')}} —— {{__('admin/index.recommendSize')}} 200*300(2:3)<br>
                    <span class="layui-badge-dot layui-bg-blue"></span> info_top & topic_top<br>{{__('admin/index.info_topic_topTip')}} —— {{__('admin/index.recommendSize')}} 600*200(3:1)
                </small>
            </h3>
            <label for="indexCoverUploadInput">
                <img src="/imgs/default_news_cover.png" class="avatar mdui-hoverable indexCover" style="max-width: 400px;">
            </label>
            <input class="mdui-hidden" id="indexCoverUploadInput" type="file" onchange="handleIndexCarouselUpdate(this,'indexCover')" accept="image/jpeg,image/png">
            <input class="mdui-hidden" type="text" name="cover_img" required>

            <h3 class="admin-index-title mdui-text-color-indigo">6.{{__('admin.priority')}}
                <br><small class="show-file-title-sub">{{__('admin.carouselPriorityTip1')}}</small>
                <br><small class="show-file-title-sub">{{__('admin.carouselPriorityTip2')}}</small>
            </h3>
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
