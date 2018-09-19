@extends('frame.adminframe')
@section('title',__('admin.newsCatManage'))
@section('subtitleUrl',route('adminNewsCategoriesList'))
@section('adminDrawerActiveVal','drawer-newsCategoryItem')

@section('content')
        <form id="createNewsCategoryForm" method="post" action="{{route('adminNewsCategoriesStore')}}">
            {{csrf_field()}}
            <h3 class="admin-title mdui-text-color-indigo">{{__('admin.createNewsCat')}}</h3>

            @include('admin.layout.msg')
            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">1.{{__('admin/news.categoryName')}}</h3>
                    <input class="mdui-textfield-input" name="name"/>
                </div>
            </div>

            <div class="mdui-textfield mdui-textfield-floating-label ">
                <h3 class="admin-index-title mdui-text-color-indigo">2.{{__('admin/news.categoryDescription')}}</h3>
                <label class="mdui-textfield-label">{{__('admin/news.categoryDescriptionTip')}}</label>
                <textarea class="mdui-textfield-input" name="description" required></textarea>
            </div>

            <div class="mdui-row">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-6">
                    <h3 class="admin-index-title mdui-text-color-indigo">3.{{__('admin/news.categoryIcon')}}</h3>
                    <label class="mdui-textfield-label">{{__('admin/news.categoryIconTip1')}}</label>
                    <input class="mdui-textfield-input" name="icon" value="send"/>
                    <div class="mdui-textfield-helper">{!! __('admin/news.categoryIconTip2') !!}</div>
                </div>
            </div>

            <h3 class="admin-index-title mdui-text-color-indigo">4.{{__('admin.priority')}}
                <br><small class="show-file-title-sub">{{__('admin/news.newsCatPriorityTip1')}}</small>
                <br><small class="show-file-title-sub">{{__('admin/news.newsCatPriorityTip2')}}</small></h3>
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
