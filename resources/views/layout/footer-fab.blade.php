<div class="mdui-fab-wrapper" mdui-fab="{trigger: 'click'}">
    <button class="mdui-fab mdui-ripple mdui-color-pink-accent">
        <!-- 默认显示的图标 -->
        <i class="mdui-icon material-icons">add</i>
        <!-- 在拨号菜单开始打开时，平滑切换到该图标，若不需要切换图标，则可以省略该元素 -->
<i class="mdui-icon mdui-fab-opened material-icons">add</i>
    </button>
    <div class="mdui-fab-dial">
        <button onclick="selectReceiversToCreateMessage()" class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-blue mdui-text-color-white" mdui-tooltip="{content: '{{__('message.newMessages')}}', position: 'left'}"><i class="mdui-icon material-icons">sms</i></button>
        <a href="{{route('communityTopicCreate')}}" class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-pink-accent" mdui-tooltip="{content: '{{__('community.createTopics')}}', position: 'left'}"><i class="mdui-icon material-icons">forum</i></a>
    </div>
</div>