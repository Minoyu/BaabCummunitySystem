@extends('frame.adminframe')
@section('title',__('admin.newsManage'))
@section('subtitleUrl',route('adminNewsList'))
@section('adminDrawerActiveVal','drawer-newsItem')

@section('content')
    @if($selectedCategory)
        <h3 class="admin-title mdui-text-color-indigo">{{$newsCategory->name}}——{{__('admin/news.newsList')}}</h3>
    @else
        <h3 class="admin-title mdui-text-color-indigo">{{__('admin/news.newsList')}}</h3>
    @endif

    @include('admin.layout.msg')
    <a href="{{route('adminNewsCreate')}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">add</i>{{__('admin.createNews')}}</a>
    <div class="mdui-table-fluid">
        <table id="listTable" class="mdui-table mdui-table-selectable mdui-table-hoverable" style="min-width: 1000px">
            <thead>
            <tr>
                <th>{{__('admin/news.newsTitle')}}</th>
                <th class="">{{__('admin/news.newsCategory')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.author')}}</th>
                <th class="mdui-table-col-numeric">{{__('community.visitedCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('community.commentCount')}}</th>
                <th class="mdui-table-col-numeric">{{__('admin.priority')}}</th>
                <th class="mdui-table-col-numeric">{{__('index.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($newses as $news)
                <tr class="mdui-table-row" id="{{$news->id}}" name="{{$news->title}}">
                    <td>
                        @if($news->status=='hidden')
                            <span class="layui-badge mdui-color-pink-accent">{{__('community.saved')}}</span>
                        @endif
                        @if(isset($news->invalided_at) && $news->invalided_at < \Carbon\Carbon::now())
                            <span class="layui-badge layui-bg-black">{{__('news.invalidTip')}}</span>
                        @endif
                        <a href="{{route('showNewsContent',$news->id)}}" target="_blank">{{$news->title}}
                            <br>
                            <small style="opacity: 0.8">{{$news->created_at}}</small>
                        </a>
                    </td>
                    <td>
                        <a target="_blank" href="{{route('adminNewsList',['category_id'=>$news->newsCategory->id])}}">
                            {{$news->newsCategory->name}}
                        </a>
                    </td>
                    <td>{{$news->user->name}}</td>
                    <td>{{$news->view_count}}</td>
                    <td>
                        <a href="{{route('adminNewsReplyList',$news->id)}}" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-dense mdui-color-indigo-400 admin-table-btn">
                            <i class="mdui-icon material-icons mdui-icon-left">comment</i>{{$news->reply_count}}
                        </a>
                    </td>
                    <td>{{$news->order}}</td>
                    <td>
                        <a mdui-tooltip="{content: '{{__('admin.view')}}', position: 'top'}" href="{{route('showNewsContent',$news->id)}}" target="_blank" class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">remove_red_eye</i>
                        </a>
                        @php
                            $canTurnUpOrder = false;
                            $canTurnDownOrder = false;
                            if ($news->order>=0&&$news->order<20){
                                $canTurnUpOrder= true;
                            }
                            if ($news->order>0&&$news->order<=20){
                                $canTurnDownOrder= true;
                            }
                        @endphp
                        <a mdui-tooltip="{content: '{{__('admin.up')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnUpOrder) href="{{route('newsTurnUpNewsOrder',$news->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-deep-orange" @if(!$canTurnUpOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_upward</i>
                        </a>
                        <a mdui-tooltip="{content: '{{__('admin.down')}} {{__('admin.priority')}}', position: 'top'}" @if($canTurnDownOrder) href="{{route('newsTurnDownNewsOrder',$news->id)}}" @endif class="mdui-btn mdui-btn-icon mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-text-color-blue" @if(!$canTurnDownOrder) disabled @endif>
                            <i class="mdui-icon material-icons">arrow_downward</i>
                        </a>
                        <a target="_blank" mdui-tooltip="{content: '{{__('admin.edit')}}', position: 'top'}" href="{{route('adminNewsEdit',$news->id)}}" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon">
                            <i class="mdui-icon material-icons">edit</i>
                        </a>
                        <button mdui-tooltip="{content: '{{__('admin.delete')}}', position: 'top'}" onclick="deleteNews('{{$news->id}}','{{$news->title}}')" class="mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-btn-dense admin-table-btn-icon mdui-color-pink-accent">
                            <i class="mdui-icon material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if($selectedCategory)
        {{$newses->appends(['category_id'=>$newsCategory->id])->links()}}
    @else
        {{$newses->links()}}
    @endif
    <button onclick="deleteNewses()" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-red-accent admin-btn"><i class="mdui-icon material-icons mdui-icon-left">delete</i>{{__('admin.batchDelete')}}</button>

    <!--/内容-->

@endsection