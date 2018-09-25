<ul class="mdui-list mdui-hidden-xs-down">
    <li class="mdui-list-item mdui-ripple">
        <i class="mdui-list-item-avatar mdui-icon material-icons mdui-text-color-white mdui-color-teal">message</i>
        <div class="mdui-list-item-content">{{__('message.messages')}}
        </div>
        <span class="mdui-list-item-icon layui-badge mdui-text-color-white @if($messageUnreadCount == 0) layui-bg-gray @endif" style="height: 20px;line-height: 20px;width: auto;min-width: auto;border-radius: 2px">
            {{$messageUnreadCount}}
        </span>
    </li>
    <li class="mdui-list-item mdui-ripple mdui-list-item-active">
        <i class="mdui-list-item-avatar mdui-icon material-icons mdui-text-color-white mdui-color-blue">notifications_active</i>
        <div class="mdui-list-item-content">{{__('message.notifications')}}</div>
    </li>
</ul>

<div class="mdui-tab mdui-hidden-sm-up" mdui-tab>
    <a href="#example6-tab1" class="mdui-ripple">
        <i class="mdui-icon material-icons">message</i>
        <label>
            {{__('message.messages')}}
            <span class="layui-badge mdui-text-color-white @if($messageUnreadCount == 0) layui-bg-gray @endif" style="height: 14px;line-height: 15px;">
                {{$messageUnreadCount}}
            </span>
        </label>
    </a>
    <a href="#example6-tab2" class="mdui-ripple">
        <i class="mdui-icon material-icons">notifications_active</i>
        <label>{{__('message.notifications')}}</label>
    </a>
</div>