@extends('frame.adminframe')
@section('title','首页轮播管理')
@section('subtitleUrl',route('adminIndexCarouselsList'))
@section('adminDrawerActiveVal','drawer-indexItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">首页轮播图列表</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminIndexCarouselCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>添加轮播图</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>轮播标题</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">位置</th>
                <th class="mdui-table-col-numeric">缩略图</th>
                <th class="mdui-table-col-numeric">优先级</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($indexCarousels as $indexCarousel)
                <tr class="mdui-table-row" id="{{$indexCarousel->id}}" name="{{str_limit($indexCarousel->title, $limit = 30, $end = '...')}}">
                    <td>@if($indexCarousel->status=='hidden')<span class="mdui-text-color-pink">[<i class="mdui-icon material-icons">local_cafe</i>暂存] </span>@endif <a href="{{$indexCarousel->url}}">{{$indexCarousel->title}}</a></td>
                    <td>{{$indexCarousel->id}}</td>
                    <td>{{$indexCarousel->position}}</td>
                    <td><img src="{{$indexCarousel->cover_img}}" style="width: 200px;height: 100px"></td>
                    <td>{{$indexCarousel->order}}</td>
                    <td>
                        <a href="{{route('adminIndexCarouselEdit',$indexCarousel->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteIndexCarousel('{{$indexCarousel->id}}','{{str_limit($indexCarousel->title, $limit = 30, $end = '...')}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                        <br>
                        @php
                            $canTurnUpOrder = false;
                            $canTurnDownOrder = false;
                            if ($indexCarousel->order>=0&&$indexCarousel->order<20){
                                $canTurnUpOrder= true;
                            }
                            if ($indexCarousel->order>0&&$indexCarousel->order<=20){
                                $canTurnDownOrder= true;
                            }
                        @endphp
                        <a @if($canTurnUpOrder) href="{{route('indexCarouselTurnUpNewsOrder',$indexCarousel->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_upward</i>提高优先级
                        </a>
                        <a @if($canTurnDownOrder) href="{{route('indexCarouselTurnDownNewsOrder',$indexCarousel->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_downward</i>降低优先级
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$indexCarousels->links()}}
    <!--/内容-->

@endsection