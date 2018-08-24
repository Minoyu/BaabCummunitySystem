<div class="mdui-card mdui-hoverable mdui-m-t-2 side-card">
    <div class="side-card-header">
        <div class="side-card-header-text mdui-center">
            作者工具
        </div>
    </div>
    <div class="side-card-content side-edit-tool-content">
        <div class="mdui-row-xs-2">
            <div class="mdui-col">
                <a target="_blank" href="{{route('communityTopicEdit',$topic->id)}}" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn">
                    <i class="mdui-icon material-icons">edit</i>
                    编辑
                </a>
            </div>
            <div class="mdui-col">
                <button onclick="deleteCommunityTopic('{{$topic->id}}','{{$topic->title}}')" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn mdui-text-color-pink-accent">
                    <i class="mdui-icon material-icons">delete</i>
                    删除
                </button>
            </div>
        </div>
    </div>
</div>