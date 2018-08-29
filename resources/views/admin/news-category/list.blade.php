@extends('frame.adminframe')
@section('title','新闻分类管理')
@section('subtitleUrl',route('adminNewsCategoriesList'))
@section('adminDrawerActiveVal','drawer-newsCategoryItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">新闻分类列表</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminNewsCategoriesCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>创建新闻分类</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>分类名称</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">介绍</th>
                <th class="mdui-table-col-numeric">新闻数</th>
                <th class="mdui-table-col-numeric">优先级</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($newsCategories as $newsCategory)
                <tr class="mdui-table-row" id="{{$newsCategory->id}}" name="{{$newsCategory->name}}">
                    <td>@if($newsCategory->status=='hidden')<span class="mdui-text-color-pink">[<i class="mdui-icon material-icons">local_cafe</i>暂存] </span>@endif <i class="mdui-icon material-icons">{{$newsCategory->icon}}</i>{{$newsCategory->name}}</td>
                    <td>{{$newsCategory->id}}</td>
                    <td>{{$newsCategory->description}}</td>
                    <td>{{$newsCategory->news_count}}</td>
                    <td>{{$newsCategory->order}}</td>
                    <td>
                        <a href="{{route('adminNewsCategoriesEdit',$newsCategory->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteNewsCategory('{{$newsCategory->id}}','{{$newsCategory->name}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                        <br>
                        @php
                            $canTurnUpOrder = false;
                            $canTurnDownOrder = false;
                            if ($newsCategory->order>=0&&$newsCategory->order<20){
                                $canTurnUpOrder= true;
                            }
                            if ($newsCategory->order>0&&$newsCategory->order<=20){
                                $canTurnDownOrder= true;
                            }
                        @endphp
                        <a @if($canTurnUpOrder) href="{{route('newsCategoryTurnUpNewsOrder',$newsCategory->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_upward</i>提高优先级
                        </a>
                        <a @if($canTurnDownOrder) href="{{route('newsCategoryTurnDownNewsOrder',$newsCategory->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_downward</i>降低优先级
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$newsCategories->links()}}
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">注意:含有新闻的父分类无法被删除,请先删除其下所有新闻.</div>
    <button onclick="deleteNewsCategories()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>{{__('admin.batchDelete')}}</button>

    <!--/内容-->

@endsection