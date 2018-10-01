<div class="mdui-list">
    <label class="mdui-list-item mdui-ripple">
        <div class="mdui-list-item-avatar">
            <a href="{{route('showPersonalCenter',$creator->id)}}">
                <img src="{{$creator->info->avatar_url}}"/>
            </a>
        </div>
        <div class="mdui-list-item-content">
            <a href="{{route('showPersonalCenter',$creator->id)}}">
                {{$creator->name}}
            </a>
            <span class="layui-badge layui-bg-blue">Creator</span>
            @if($creator->id == Auth::id())
                <span class="layui-badge">Me</span>
            @endif
        </div>
        {{--<div class="mdui-checkbox">--}}
            {{--<input type="checkbox" name="participants" value="{{$participant->user->id}}" checked/>--}}
            {{--<i class="mdui-checkbox-icon"></i>--}}
        {{--</div>--}}
    </label>

    @foreach($participants as $participant)
        <label class="mdui-list-item mdui-ripple">
            <div class="mdui-list-item-avatar">
                <a href="{{route('showPersonalCenter',$participant->user->id)}}">
                    <img src="{{$participant->user->info->avatar_url}}"/>
                </a>
            </div>
            <div class="mdui-list-item-content">
                <a href="{{route('showPersonalCenter',$participant->user->id)}}">
                    {{$participant->user->name}}
                </a>
                @if($participant->user->id == Auth::id())
                    <span class="layui-badge">Me</span>
                @endif
            </div>
            {{--<div class="mdui-checkbox">--}}
                {{--<input type="checkbox" name="participants" value="{{$participant->user->id}}" checked/>--}}
                {{--<i class="mdui-checkbox-icon"></i>--}}
            {{--</div>--}}
        </label>
    @endforeach
</div>