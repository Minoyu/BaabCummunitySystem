@extends('frame.adminframe')
@section('title','首页头条管理')
@section('subtitleUrl',route('adminIndexHeadlinesList'))
@section('adminDrawerActiveVal','drawer-indexItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">首页头条列表</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminIndexHeadlineCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>添加头条图</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>头条标题</th>
                <th>副标题</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">位置</th>
                <th class="mdui-table-col-numeric">优先级</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($indexHeadlines as $indexHeadline)
                <tr class="mdui-table-row" id="{{$indexHeadline->id}}" name="{{str_limit($indexHeadline->title, $limit = 30, $end = '...')}}">
                    <td>@if($indexHeadline->status=='hidden')
                            <span class="mdui-text-color-pink">[<i class="mdui-icon material-icons">local_cafe</i>暂存] </span>
                        @endif
                        <a href="{{$indexHeadline->url}}">{{$indexHeadline->title}}</a>
                    </td>
                    <td>
                        <a href="{{$indexHeadline->subUrl}}">{{$indexHeadline->subtitle}}</a>
                    </td>
                    <td>{{$indexHeadline->id}}</td>
                    <td>{{$indexHeadline->position}}</td>
                    <td>{{$indexHeadline->order}}</td>
                    <td>
                        <a href="{{route('adminIndexHeadlineEdit',$indexHeadline->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteIndexHeadline('{{$indexHeadline->id}}','{{str_limit($indexHeadline->title, $limit = 30, $end = '...')}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                        <br>
                        @php
                            $canTurnUpOrder = false;
                            $canTurnDownOrder = false;
                            if ($indexHeadline->order>=0&&$indexHeadline->order<20){
                                $canTurnUpOrder= true;
                            }
                            if ($indexHeadline->order>0&&$indexHeadline->order<=20){
                                $canTurnDownOrder= true;
                            }
                        @endphp
                        <a @if($canTurnUpOrder) href="{{route('indexHeadlineTurnUpNewsOrder',$indexHeadline->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_upward</i>提高优先级
                        </a>
                        <a @if($canTurnDownOrder) href="{{route('indexHeadlineTurnDownNewsOrder',$indexHeadline->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_downward</i>降低优先级
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$indexHeadlines->links()}}
    <!--/内容-->

@endsection