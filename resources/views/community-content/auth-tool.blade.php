<div class="mdui-card mdui-hoverable mdui-m-t-2 side-card">
    <div class="side-card-header">
        <div class="side-card-header-text mdui-center">
            {{__('admin.authToolHeader')}}
        </div>
    </div>
    <div class="side-card-content side-edit-tool-content">
        <div class="mdui-row-xs-2">
            <div class="mdui-col">
                <a target="_blank" href="{{route('communityTopicEdit',$topic->id)}}" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn">
                    <i class="mdui-icon material-icons">edit</i>{{__('admin.edit')}}
                </a>
            </div>
            <div class="mdui-col">
                <button onclick="deleteCommunityTopic('{{$topic->id}}','{{$topic->title}}')" class="mdui-center mdui-btn mdui-ripple mdui-center side-edit-tool-btn mdui-text-color-pink-accent">
                    <i class="mdui-icon material-icons">delete</i>{{__('admin.delete')}}
                </button>
            </div>
        </div>
    </div>
</div>