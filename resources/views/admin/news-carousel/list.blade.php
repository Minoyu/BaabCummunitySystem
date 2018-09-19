@extends('frame.adminframe')
@section('title','新闻轮播管理')
@section('subtitleUrl',route('adminNewsCarouselsList'))
@section('adminDrawerActiveVal','drawer-newsOtherItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin/news.newsCarouselList')}}</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminNewsCarouselCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createCarousel')}}</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>{{__('admin.carouselTitle')}}</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">{{__('index.img')}}</th>
                <th class="mdui-table-col-numeric">{{__('admin.priority')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}</th>
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
                        <a mdui-tooltip="{content: '{{__('admin.up')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnUpOrder) href="{{route('newsCarouselTurnUpNewsOrder',$newsCarousel->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_upward</i>
                        </a>
                        <a mdui-tooltip="{content: '{{__('admin.down')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnDownOrder) href="{{route('newsCarouselTurnDownNewsOrder',$newsCarousel->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_downward</i>
                        </a>
                        <a target="_blank" mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" href="{{route('adminNewsCarouselEdit',$newsCarousel->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deleteNewsCarousel('{{$newsCarousel->id}}','{{str_limit($newsCarousel->title, $limit = 30, $end = '...')}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$newsCarousels->links()}}
    <!--/内容-->

@endsection