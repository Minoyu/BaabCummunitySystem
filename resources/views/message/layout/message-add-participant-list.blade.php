<div class="mdui-list">
    @if(count($followings)>0)
        @foreach($followings as $following)
            <label class="mdui-list-item mdui-ripple">
                <div class="mdui-list-item-avatar"><img src="{{$following->info->avatar_url}}"/></div>
                <div class="mdui-list-item-content">{{$following->name}}</div>
                <div class="mdui-checkbox">
                    <input type="checkbox" name="participants_to_add" value="{{$following->id}}" />
                    <i class="mdui-checkbox-icon"></i>
                </div>
            </label>
        @endforeach
    @else
        <span class="loading-tip-text mdui-m-t-1 mdui-m-b-3" style="font-size: 15px">
            <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 mdui-m-t-5 mdui-m-b-3" style="font-size: 50px">supervisor_account</i>
            {!! __('message.emptyFollowings') !!}
            <br>
        </span>
    @endif
</div>