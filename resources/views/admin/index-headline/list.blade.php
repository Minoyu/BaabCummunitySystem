@extends('frame.adminframe')
@section('title',__('admin.indexHeadlines'))
@section('subtitleUrl',route('adminIndexHeadlinesList'))
@section('adminDrawerActiveVal','drawer-indexItem')

@section('content')
    <h3 class="admin-title mdui-text-color-indigo">{{__('admin/index.indexHeadlinesList')}}</h3>
    @include('admin.layout.msg')
    <a href="{{route('adminIndexHeadlineCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin/index.createIndexHeadline')}}</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>{{__('admin/index.headlineTitle')}}</th>
                <th>{{__('admin/index.headlineSubtitle')}}</th>
                <th class="mdui-table-col-numeric">ID</th>
                <th class="mdui-table-col-numeric">{{__('admin/index.headlinePosition')}}</th>
                <th class="mdui-table-col-numeric">{{__('admin.priority')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($indexHeadlines as $indexHeadline)
                <tr class="mdui-table-row" id="{{$indexHeadline->id}}" name="{{str_limit($indexHeadline->title, $limit = 30, $end = '...')}}">
                    <td>@if($indexHeadline->status=='hidden')
                            <i class="mdui-icon material-icons mdui-color-pink-accent">local_cafe</i><span class="layui-badge mdui-color-pink-accent">{{__('community.saved')}}</span>
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
                        <a  mdui-tooltip="{content: '{{__('admin.up')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnUpOrder) href="{{route('indexHeadlineTurnUpNewsOrder',$indexHeadline->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_upward</i>
                        </a>
                        <a  mdui-tooltip="{content: '{{__('admin.down')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnDownOrder) href="{{route('indexHeadlineTurnDownNewsOrder',$indexHeadline->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_downward</i>
                        </a>
                        <a target="_blank" mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" href="{{route('adminIndexHeadlineEdit',$indexHeadline->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deleteIndexHeadline('{{$indexHeadline->id}}','{{str_limit($indexHeadline->title, $limit = 30, $end = '...')}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$indexHeadlines->links()}}
    <!--/内容-->

@endsection