@extends('frame.adminframe')
@section('title','新闻分类管理')
@section('subtitleUrl',route('adminNewsCategoriesList'))
@section('adminDrawerActiveVal','drawer-newsCategoryItem')

@section('content')
        <form id="editNewsCategoryForm" method="post" action="{{route('adminNewsCategoriesUpdate',$newsCategory->id)}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">编辑新闻分类</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-xs-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.编辑分类名称</h3>
                    <label class="mdui-textfield-label">请输入新闻分类名称</label>
                    <input class="mdui-textfield-input" name="name" value="{{$newsCategory->name}}"/>
                </div>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">2.编辑分类描述</h3>
                <label class="mdui-textfield-label">请输入分类的描述用于展示</label>
                <textarea class="mdui-textfield-input" name="description" required>{{$newsCategory->description}}</textarea>
            </div>

            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo mdui-p-b-1">3.编辑分类图标 </h3><i class="mdui-icon material-icons">{{$newsCategory->icon}}</i>
                    <label class="mdui-textfield-label">请在此输入图标的短代码，如: book </label>
                    <input class="mdui-textfield-input" name="icon" value="{{$newsCategory->icon}}" required/>
                    <div class="mdui-textfield-helper">默认使用谷歌Material图标库，<a href="https://www.mdui.org/docs/material_icon" class="mdui-text-color-red" target="_blank">请前往查找</a></div>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">4.优先级
                <br><small class="show-file-title-sub">优先级范围0-20，从左到右递增，推荐默认为0</small>
                <br><small class="show-file-title-sub">分类将先依照优先级排序，相同优先级下依照发布时间排序</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="{{$newsCategory->order}}" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#editNewsCategoryForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>发布</button>
            <button onclick="formHiddenSubmit('#editNewsCategoryForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>暂存</button>
            <a href="{{route('adminNewsCategoriesList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>返回</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
