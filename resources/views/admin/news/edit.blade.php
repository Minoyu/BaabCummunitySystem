@extends('frame.adminframe')
@section('title',__('admin.newsManage'))
@section('subtitleUrl',route('adminNewsList'))
@section('adminDrawerActiveVal','drawer-newsItem')

@section('content')
        <form id="editNewsForm" method="post" action="{{route('adminNewsUpdate',$news->id)}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{__('admin/news.editNews')}}</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('admin/news.newsTitle')}}</h3>
                    <input class="mdui-textfield-input" name="title" value="{{$news->title}}"/>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo">2.{{__('admin/news.newsCategory')}}</h3>
            <select name="news_category_id" class="mdui-select" mdui-select="{position: 'bottom'}">
                <option value="null">{{__('admin/news.newsCategoryP')}}</option>
                @foreach($newsCategories as $newsCategory)
                    @if($newsCategory->id==$news->news_category_id)
                        <option value="{{$newsCategory->id}}" selected>当前：{{$newsCategory->name}}</option>
                    @else
                        <option value="{{$newsCategory->id}}">{{$newsCategory->name}}</option>
                    @endif
                @endforeach
            </select>

            <h3 class="admin-index-title mdui-text-color-indigo">3.{{__('admin/news.newsContent')}}</h3>
            <div class="mdui-m-t-1 admin-editor-toolbar mdui-hoverable" id="editorToolbar" type="news"></div>
            <div class="admin-editor-middle-bar">{{__('admin.editArea')}}</div>
            <div id="editorText" class="admin-editor-text mdui-hoverable" >{!!$news->content!!}</div>
            <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>
            <div class="mdui-progress">
                <div class="mdui-progress-indeterminate" id="editor-progress" style="display: none"></div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo">4.{{__('admin/news.coverImg')}}
            <br><small class="show-file-title-sub">{!! __('admin/news.coverImgTip') !!}</small></h3>
            <label for="newsCoverUploadInput">
                <img @if($news->cover_img) src="{{$news->cover_img}}" @else src="/imgs/default_news_cover.png" @endif class="avatar mdui-hoverable newsCover" style="width: 300px; height: 200px">
            </label>
            <input class="mdui-hidden" id="newsCoverUploadInput" type="file" onchange="handleNewsCoverUpdate(this,'newsCover')" accept="image/jpeg,image/png">
            <input class="mdui-hidden" value="{{$news->cover_img}}" type="text" name="cover_img">

            <h3 class="admin-index-title mdui-text-color-indigo">5.{{__('admin/news.invalidTime')}}
            <br><small class="show-file-title-sub">{{__('admin/news.invalidTimeTip')}}</small></h3>
            <input type="text" class="layui-input" name="invalided_at" style="max-width: 300px" value="{{$news->invalided_at}}" id="selInvalidedAt">

            <h3 class="admin-index-title mdui-text-color-indigo">6.{{__('admin.priority')}}
                <br><small class="show-file-title-sub">{{__('admin/news.newsPriorityTip1')}}</small>
                <br><small class="show-file-title-sub">{{__('admin/news.newsPriorityTip2')}}</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="{{$news->order}}" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#editNewsForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#editNewsForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>{{__('community.save')}}</button>
            <a href="{{route('adminNewsList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
