<div class="mdui-list">
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
</div>