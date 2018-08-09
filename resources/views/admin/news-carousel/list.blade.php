@extends('frame.adminframe')
@section('title','新闻轮播管理')
@section('subtitleUrl',route('adminNewsCarouselsList'))
@section('adminDrawerActiveVal','drawer-newsOtherItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">新闻轮播图列表</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminNewsCarouselCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>添加轮播图</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>轮播标题</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">缩略图</th>
                <th class="mdui-table-col-numeric">优先级</th>
                <th class="mdui-table-col-numeric">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($newsCarousels as $newsCarousel)
                <tr class="mdui-table-row" id="{{$newsCarousel->id}}" name="{{str_limit($newsCarousel->title, $limit = 30, $end = '...')}}">
                    <td>@if($newsCarousel->status=='hidden')<span class="mdui-text-color-pink">[<i class="mdui-icon material-icons">local_cafe</i>暂存] </span>@endif <a href="{{$newsCarousel->url}}">{{$newsCarousel->title}}</a></td>
                    <td>{{$newsCarousel->id}}</td>
                    <td><img src="{{$newsCarousel->cover_img}}" style="width: 200px;height: 100px"></td>
                    <td>{{$newsCarousel->order}}</td>
                    <td>
                        <a href="{{route('adminNewsCarouselEdit',$newsCarousel->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">edit</i>编辑
                        </a>
                        <button onclick="deleteNewsCarousel('{{$newsCarousel->id}}','{{str_limit($newsCarousel->title, $limit = 30, $end = '...')}}')" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-color-pink-accent">
                            <i class="mdui-icon material-icons mdui-icon-left">delete</i>删除
                        </button>
                        <br>
                        @php
                            $canTurnUpOrder = false;
                            $canTurnDownOrder = false;
                            if ($newsCarousel->order>=0&&$newsCarousel->order<20){
                                $canTurnUpOrder= true;
                            }
                            if ($newsCarousel->order>0&&$newsCarousel->order<=20){
                                $canTurnDownOrder= true;
                            }
                        @endphp
                        <a @if($canTurnUpOrder) href="{{route('newsCarouselTurnUpNewsOrder',$newsCarousel->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_upward</i>提高优先级
                        </a>
                        <a @if($canTurnDownOrder) href="{{route('newsCarouselTurnDownNewsOrder',$newsCarousel->id)}}" @endif class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons mdui-icon-left">arrow_downward</i>降低优先级
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$newsCarousels->links()}}
    <!--/内容-->

@endsection