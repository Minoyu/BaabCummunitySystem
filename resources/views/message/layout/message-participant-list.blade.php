<div class="mdui-list">
    @foreach($participants as $participant)
        <label class="mdui-list-item mdui-ripple">
            <div class="mdui-list-item-avatar"><img src="{{$participant->user->info->avatar_url}}"/></div>
            <div class="mdui-list-item-content">{{$participant->user->name}}</div>
            <div class="mdui-checkbox">
                <input type="checkbox" name="participants" value="{{$participant->user->id}}" checked/>
                <i class="mdui-checkbox-icon"></i>
            </div>
        </label>
    @endforeach
</div>