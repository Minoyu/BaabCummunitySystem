@extends('frame.adminframe')
@section('title','新闻分类管理')
@section('subtitleUrl',route('adminNewsCategoriesList'))
@section('adminDrawerActiveVal','drawer-newsCategoryItem')

@section('content')
        <form id="createNewsCategoryForm" method="post" action="{{route('adminNewsCategoriesStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">创建新闻分类</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.新分类名称</h3>
                    <label class="mdui-textfield-label">请输入新闻分类名称</label>
                    <input class="mdui-textfield-input" name="name"/>
                </div>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">2.新分类描述</h3>
                <label class="mdui-textfield-label">请输入分类的描述用于展示</label>
                <textarea class="mdui-textfield-input" name="description" required></textarea>
            </div>

            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">3.新分类图标</h3>
                    <label class="mdui-textfield-label">请在此输入图标的短代码，如: book。留空则默认send </label>
                    <input class="mdui-textfield-input" name="icon"/>
                    <div class="mdui-textfield-helper">默认使用谷歌Material图标库，<a href="https://www.mdui.org/docs/material_icon" class="mdui-text-color-red" target="_blank">请前往查找</a></div>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2 mdui-m-b-1">4.优先级
                <br><small class="show-file-title-sub">优先级范围0-20，从左到右递增，推荐默认为0</small>
                <br><small class="show-file-title-sub">分类将先依照优先级排序，相同优先级下依照发布时间排序</small></h3>
            <label class="mdui-slider mdui-slider-discrete">
                <input type="range" step="1" min="0" max="20" value="0" name="order"/>
            </label>

            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="formPublicSubmit('#createNewsCategoryForm')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.publish')}}</button>
            <button onclick="formHiddenSubmit('#createNewsCategoryForm')" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>{{__('community.save')}}</button>
            <a href="{{route('adminNewsCategoriesList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>{{__('index.back')}}</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
