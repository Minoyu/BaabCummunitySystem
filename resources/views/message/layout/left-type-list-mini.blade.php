<ul class="mdui-list mdui-hidden-xs-down">
    <a href="{{route('messages')}}">
        <li class="mdui-list-item mdui-ripple @yield('message-list-item-class')">
            <i class="mdui-list-item-avatar mdui-icon material-icons mdui-text-color-white mdui-color-teal">message</i>
            <div class="mdui-list-item-content">{{__('message.messages')}}
            </div>
            <span class="mdui-list-item-icon layui-badge mdui-text-color-white @if($messageUnreadCount == 0) layui-bg-gray @endif" style="height: 20px;line-height: 20px;width: auto;min-width: auto;border-radius: 2px">
            {{$messageUnreadCount}}
        </span>
        </li>
    </a>
    <a href="{{route('notifications')}}">
        <li class="mdui-list-item mdui-ripple @yield('notification-list-item-class')">
            <i class="mdui-list-item-avatar mdui-icon material-icons mdui-text-color-white mdui-color-blue">notifications_active</i>
            <div class="mdui-list-item-content">{{__('message.notifications')}}</div>
            <span class="mdui-list-item-icon layui-badge mdui-text-color-white @if($notificationUnreadCount == 0) layui-bg-gray @endif" style="height: 20px;line-height: 20px;width: auto;min-width: auto;border-radius: 2px">
            {{$notificationUnreadCount}}
            </span>
        </li>
    </a>
</ul>

<div class="mdui-tab mdui-hidden-sm-up" mdui-tab>
    <a onclick="jumpTo('{{route('messages')}}')" href="#" class="mdui-ripple @yield('message-tab-class')">
        <label>
            {{__('message.messages')}}
            <span class="layui-badge mdui-text-color-white @if($messageUnreadCount == 0) layui-bg-gray @endif" style="height: 14px;line-height: 15px;">
                {{$messageUnreadCount}}
            </span>
        </label>
    </a>
    <a onclick="jumpTo('{{route('notifications')}}')" href="#" class="mdui-ripple @yield('notification-tab-class')">
        <label>
            {{__('message.notifications')}}
            <span class="layui-badge mdui-text-color-white @if($notificationUnreadCount == 0) layui-bg-gray @endif" style="height: 14px;line-height: 15px;">
                {{$notificationUnreadCount}}
            </span>
        </label>
    </a>
</div>