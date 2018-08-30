@extends('frame.adminframe')
@section('title',__('admin.indexCarousels'))
@section('subtitleUrl',route('adminIndexCarouselsList'))
@section('adminDrawerActiveVal','drawer-indexItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin/index.indexCarouselsList')}}</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminIndexCarouselCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createCarousel')}}</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>{{__('admin.carouselTitle')}}</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">{{__('admin/index.carouselPosition')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.img')}}</th>
                <th class="mdui-table-col-numeric">{{__('admin.priority')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($indexCarousels as $indexCarousel)
                <tr class="mdui-table-row" id="{{$indexCarousel->id}}" name="{{str_limit($indexCarousel->title, $limit = 30, $end = '...')}}">
                    <td>@if($indexCarousel->status=='hidden')
                            <i class="mdui-icon material-icons mdui-color-pink-accent">local_cafe</i><span class="layui-badge mdui-color-pink-accent">{{__('community.saved')}}</span>
                        @endif <a href="{{$indexCarousel->url}}">{{$indexCarousel->title}}</a></td>
                    <td>{{$indexCarousel->id}}</td>
                    <td>{{$indexCarousel->position}}</td>
                    <td><img src="{{$indexCarousel->cover_img}}" style="width: 200px;height: 100px"></td>
                    <td>{{$indexCarousel->order}}</td>
                    <td>
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
                        <a mdui-tooltip="{content: '{{__('admin.up')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnUpOrder) href="{{route('indexCarouselTurnUpNewsOrder',$indexCarousel->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_upward</i>
                        </a>
                        <a mdui-tooltip="{content: '{{__('admin.down')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnDownOrder) href="{{route('indexCarouselTurnDownNewsOrder',$indexCarousel->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_downward</i>
                        </a>

                        <a target="_blank" mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" href="{{route('adminIndexCarouselEdit',$indexCarousel->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deleteIndexCarousel('{{$indexCarousel->id}}','{{str_limit($indexCarousel->title, $limit = 30, $end = '...')}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$indexCarousels->links()}}
    <!--/内容-->

@endsection