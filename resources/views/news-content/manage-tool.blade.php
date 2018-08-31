<div class="mdui-card mdui-hoverable mdui-m-t-2 side-card">
    <div class="side-card-header">
        <div class="side-card-header-text mdui-center">
            {{__('admin.adminToolHeader')}}
        </div>
    </div>
    <div class="side-card-content side-edit-tool-content">
        <div class="mdui-row-xs-2">
            <div class="mdui-col">
                <a target="_blank" href="{{route('adminNewsEdit',$news->id)}}" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn">
                    <i class="mdui-icon material-icons">edit</i>
                    {{__('admin.edit')}}
                </a>
            </div>
            <div class="mdui-col">
                <button onclick="deleteNews('{{$news->id}}','{{$news->title}}')" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn mdui-text-color-pink-accent">
                    <i class="mdui-icon material-icons">delete</i>
                    {{__('admin.delete')}}
                </button>
            </div>
        </div>
        <div class="mdui-row-xs-2">
            <div class="mdui-text-center mdui-m-t-1 mdui-m-b-1" style="font-weight: 500">
                <span class="layui-badge"> {{__('admin.currentPriority')}} {{$news->order}} </span>
                @if($news->status=='hidden')
                    <span class="layui-badge layui-bg-orange"> {{__('community.saved')}} </span>
                @endif
                @if(isset($news->invalided_at) && $news->invalided_at < \Carbon\Carbon::now())
                    <span class="layui-badge layui-bg-black">{{__('news.invalidTip')}}</span>
                @endif
            </div>
            <div class="mdui-col">
                <a href="{{route('newsTurnUpNewsOrder',$news->id)}}" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn mdui-text-color-deep-orange">
                    <i class="mdui-icon material-icons">arrow_upward</i>{{__('admin.up')}} {{__('admin.priority')}}
                </a>
            </div>
            <div class="mdui-col">
                <a href="{{route('newsTurnDownNewsOrder',$news->id)}}" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn mdui-text-color-indigo">
                    <i class="mdui-icon material-icons">arrow_downward</i>{{__('admin.down')}} {{__('admin.priority')}}
                </a>
            </div>
            <div class="mdui-col mdui-m-t-1">
                <a target="_blank" href="{{route('adminNewsReplyList',$news->id)}}" class="mdui-btn mdui-ripple mdui-btn-dense side-edit-tool-btn ">
                    <i class="mdui-icon material-icons">comment</i>{{__('admin.manageComment')}}
                </a>
            </div>
        </div>
    </div>
</div>