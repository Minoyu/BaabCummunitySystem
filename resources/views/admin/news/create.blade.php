@extends('frame.adminframe')
@section('title','新闻管理')
@section('subtitleUrl',route('adminNewsList'))

@section('content')
        <form id="createNewsCategoryForm" method="post" action="{{route('adminNewsCategoriesStore')}}">
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

            <h3 class="admin-index-title mdui-text-color-indigo mdui-m-t-2">3.新分类图标</h3>
            <div class="mdui-m-t-1" id="newsEditor">
                <p>在此输入新闻内容</p>
            </div>
            <textarea id="newsContentTextArea" name="detail" class="mdui-hidden"></textarea>


            <div class="mdui-divider" style="margin-top: 50px"></div>
            <button onclick="createNewsCategorySubmit()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>发布</button>
            <button onclick="saveNewsCategorySubmit()" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">local_cafe</i>暂存</button>
            <a href="{{route('adminNewsCategoriesList')}}" class="mdui-btn mdui-btn-raised mdui-ripple admin-btn"><i class="mdui-icon material-icons mdui-icon-left">arrow_back</i>返回</a>
            <div class="mdui-divider" style="margin-bottom: 200px"></div>



        </form>
        <!--/内容-->
@endsection
