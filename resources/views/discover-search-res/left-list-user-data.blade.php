@foreach($user_collection as $user_item)
    <a href="{{route('showPersonalCenter',$user_item['user']->id)}}">
        <div class="user-search-res-item">
            <img src="{{$user_item['user']->info->avatar_url}}">
            <div class="user-name">
                {{$user_item['user']->name}}
                {{--关注按钮--}}
                @if((Auth::check() && $user_item['user']->id != Auth::id()) || !Auth::check())
                    @if( Auth::check() && $user_item['user']->isFollowedBy(Auth::user()))
                        <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$user_item['user']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-color-pink-accent mdui-btn-raised">
                            <i class="mdui-icon material-icons mdui-icon-left">&#xe87d;</i>
                            <span>已关注</span>
                        </a>
                    @else
                        <a onclick="ajaxHandleFollowUser('{{route('userFollowOther')}}','{{route('userUnfollowOther')}}','{{$user_item['user']->id}}',this)" class="mdui-btn mdui-btn-dense mdui-text-color-pink-accent mdui-btn-raised">
                            <i class="mdui-icon material-icons mdui-icon-left">&#xe87e;</i>
                            <span>关注</span>
                        </a>
                    @endif
                @endif
            </div>
            <div class="user-info">
                关注了 {{$user_item['followingsCount']}} · 关注者 {{$user_item['followersCount']}}
                <span class="mdui-hidden-xs"> · {{$user_item['user']->info->motto}}</span>
            </div>
        </div>
    </a>
@endforeach