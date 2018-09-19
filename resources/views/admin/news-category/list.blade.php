@extends('frame.adminframe')
@section('title','新闻分类管理')
@section('subtitleUrl',route('adminNewsCategoriesList'))
@section('adminDrawerActiveVal','drawer-newsCategoryItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin/news.newsCategoriesList')}}</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminNewsCategoriesCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createNewsCat')}}</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>{{__('admin/news.categoryName')}}</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">{{__('admin/news.categoryDescription')}}</th>
                <th class="mdui-table-col-numeric">{{__('news.newsCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('admin.priority')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($newsCategories as $newsCategory)
                <tr class="mdui-table-row" id="{{$newsCategory->id}}" name="{{$newsCategory->name}}">
                    <td>@if($newsCategory->status=='hidden')
                            <i class="mdui-icon material-icons">local_cafe</i><span class="layui-badge mdui-color-pink-accent">{{__('community.saved')}}</span>
                        @endif <i class="mdui-icon material-icons">{{$newsCategory->icon}}</i>{{$newsCategory->name}}</td>
                    <td>{{$newsCategory->id}}</td>
                    <td>{{$newsCategory->description}}</td>
                    <td>
                        <a target="_blank" href="{{route('adminNewsList',['category_id'=>$newsCategory->id])}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense mdui-color-indigo-400 admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">remove_red_eye</i>{{$newsCategory->news_count}}
                        </a>
                    </td>
                    <td>{{$newsCategory->order}}</td>
                    <td>
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
                        <a mdui-tooltip="{content: '{{__('admin.up')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnUpOrder) href="{{route('newsCategoryTurnUpNewsOrder',$newsCategory->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_upward</i>
                        </a>
                        <a mdui-tooltip="{content: '{{__('admin.down')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnDownOrder) href="{{route('newsCategoryTurnDownNewsOrder',$newsCategory->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_downward</i>
                        </a>
                        <a target="_blank" mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" href="{{route('adminNewsCategoriesEdit',$newsCategory->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deleteNewsCategory('{{$newsCategory->id}}','{{$newsCategory->name}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$newsCategories->links()}}
    <div class="mdui-typo-caption mdui-text-color-red mdui-m-t-1">{{__('admin/news.newsCategoryDeleteNote')}}</div>
    <button onclick="deleteNewsCategories()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>{{__('admin.batchDelete')}}</button>

    <!--/内容-->

@endsection