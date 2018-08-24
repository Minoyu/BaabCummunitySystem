<div class="mdui-card mdui-hoverable mdui-m-t-2 side-card">
    <div class="side-card-header">
        <div class="side-card-header-text mdui-center">
            管理员工具
        </div>
    </div>
    <div class="side-card-content side-edit-tool-content">
        <div class="mdui-row-xs-2">
            <div class="mdui-col">
                <a target="_blank" href="{{route('adminNewsEdit',$news->id)}}" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn">
                    <i class="mdui-icon material-icons">edit</i>
                    编辑
                </a>
            </div>
            <div class="mdui-col">
                <button onclick="deleteNews('{{$news->id}}','{{$news->title}}')" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn mdui-text-color-pink-accent">
                    <i class="mdui-icon material-icons">delete</i>
                    删除
                </button>
            </div>
        </div>
        <div class="mdui-row-xs-2">
            <div class="mdui-text-center mdui-m-t-1 mdui-m-b-1" style="font-weight: 500">
                <span class="layui-badge"> 当前优先级 {{$news->order}} </span>
                @if($news->status=='hidden')
                    <span class="layui-badge layui-bg-orange"> 暂存 </span>
                @endif
            </div>
            <div class="mdui-col">
                <a href="{{route('newsTurnUpNewsOrder',$news->id)}}" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn mdui-text-color-deep-orange">
                    <i class="mdui-icon material-icons">arrow_upward</i>
                    提高优先级
                </a>
            </div>
            <div class="mdui-col">
                <a href="{{route('newsTurnDownNewsOrder',$news->id)}}" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn mdui-text-color-indigo">
                    <i class="mdui-icon material-icons">arrow_downward</i>
                    降低优先级
                </a>
            </div>
            <div class="mdui-col mdui-m-t-1">
                <a target="_blank" href="{{route('adminNewsReplyList',$news->id)}}" class="mdui-btn mdui-ripple mdui-btn-dense side-edit-tool-btn ">
                    <i class="mdui-icon material-icons mdui-icon-left">comment</i>回复管理
                </a>
            </div>
        </div>
    </div>
</div>