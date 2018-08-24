@foreach($topics as $topic)
<a href="{{route('showCommunityContent',$topic->id)}}">
    <li class="mdui-list-item mdui-ripple">
        <div class="mdui-list-item-avatar"><img src="{{$topic->user->info->avatar_url}}"/></div>
        <div class="mdui-list-item-content mdui-list-item-three-line">
            @if($topic->order >0)
                <span class="layui-badge">置顶</span>
            @endif
            @if($topic->is_excellent)
                <span class="layui-badge layui-bg-blue">精华</span>
            @endif
            @if($topic->order <0)
                <span class="layui-badge layui-bg-black">下沉</span>
            @endif
            {{$topic->title}}
        </div>
        <div class="item-info mdui-hidden-xs">
            <span style="color: #8700ff;" mdui-tooltip="{content: '点赞数'}">{{numForHuman($topic->thumb_up_count)}}</span> /
            <span mdui-tooltip="{content: '评论数'}">{{numForHuman($topic->reply_count)}}</span> /
            <span mdui-tooltip="{content: '访问数'}">{{numForHuman($topic->view_count)}}</span>
            <br>
            @if(isset($topic->last_reply_at))
                {{\Carbon\Carbon::parse($topic->last_reply_at)->diffForHumans()}}
            @else
                {{$topic->created_at->diffForHumans()}}
            @endif
        </div>
    </li>
</a>
@endforeach
