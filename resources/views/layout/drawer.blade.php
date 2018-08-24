<div class="mdui-drawer drawer-padding-top @if(!$isDrawerOpen) mdui-drawer-close @endif" id="index-drawer">
    <ul class="mdui-list drawer-menu mdui-color-white" id="drawerMenu" mdui-collapse>

        <div class="mdui-m-b-1 drawer-top">
            @if(Auth::check())
                <img class="mdui-img-fluid drawer-top-img coverDrawerImg" src="{{Auth::user()->info->cover_bg_url}}"/>
                <a href="{{route('showPersonalCenter',Auth::user()->id)}}"><img class="drawer-top-profile mdui-hoverable userAvatar" src="{{Auth::user()->info->avatar_url}}" /></a>
                <span class="drawer-top-title mdui-text-color-white">{{Auth::user()->name}}</span>
                <span class="drawer-top-subtitle mdui-text-color-white">{{__('index.top-subtitle')}}</span>
            @else
                <img class="mdui-img-fluid drawer-top-img" src="/imgs/drawer_top.png"/>
                <a onclick="openLoginDialog()"><img class="drawer-top-profile mdui-hoverable" src="/imgs/user_profile.png" /></a>
                <span class="drawer-top-title mdui-text-color-white username">
                    <button onclick="openLoginDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-100 mdui-ripple">{{__('index.login')}}</button>
                    {{__('index.or')}}
                    <button onclick="openRegisterDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-grey mdui-ripple">{{__('index.register')}}</button>
                </span>
                <span class="drawer-top-subtitle mdui-text-color-white">{{__('index.top-subtitle')}}</span>
            @endif
            <button @if(!Auth::check()||empty(Auth::user()->info->is_drawer_open)) onclick="handleDrawerDefaultStatus()"@else mdui-drawer-close @endif class="mdui-hidden-sm-down mdui-btn mdui-btn-icon drawer-top-close mdui-text-color-white mdui-ripple">
                <i class="mdui-icon material-icons">clear_all</i>
            </button>

            <button class="mdui-hidden-md-up mdui-btn mdui-btn-icon drawer-top-close mdui-text-color-white mdui-ripple" mdui-drawer-close>
                <i class="mdui-icon material-icons">clear_all</i>
            </button>
        </div>

        <a href="/">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-cyan">home</i>
                <div class="mdui-list-item-content">{{__('index.home')}}</div>
            </li>
        </a>

        <a href="{{route('showCommunity')}}">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe6dd;</i>
                <div class="mdui-list-item-content">{{__('index.community')}}</div>
            </li>
        </a>

        <a href="{{route('showDiscover')}}">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-purple">explore</i>
                <div class="mdui-list-item-content">{{__('index.discover')}}</div>
            </li>
        </a>

        <div class="mdui-divider"></div>
        @if(Auth::check())
            <a href="{{route('showPersonalCenter',Auth::user()->id)}}">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">beach_access</i>
                    <div class="mdui-list-item-content">{{__('index.personalCenter')}}</div>
                </li>
            </a>
            <a href="{{route('userLogout')}}" class="mdui-hidden-md-up">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue-grey">exit_to_app</i>
                    <div class="mdui-list-item-content">{{__('auth.logout')}}</div>
                </li>
            </a>
        @endif
        <a href="{{route('switchLang')}}">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-cyan">translate</i>
                <div class="mdui-list-item-content">{{__('index.switchLang')}}</div>
            </li>
        </a>

        {{--<li class="mdui-collapse-item">--}}
            {{--<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">--}}
                {{--<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">settings</i>--}}
                {{--<div class="mdui-list-item-content">设置</div>--}}
                {{--<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>--}}
            {{--</div>--}}
            {{--<ul class="mdui-collapse-item-body mdui-list mdui-list-dense">--}}
                {{--<a href="#">--}}
                    {{--<li class="mdui-list-item mdui-ripple">任务分类管理</li>--}}
                {{--</a>--}}

            {{--</ul>--}}
        {{--</li>--}}

    </ul>
</div>

<div class="mdui-dialog" id="handleDrawerStatusDialog">
    <div class="mdui-dialog-title">厌烦了悬浮的抽屉栏?</div>
    <div class="mdui-dialog-content">
        你可以选择将抽屉栏默认隐藏，此后抽屉栏将不再自动弹出。
        <br>若已登录，你的喜好将永久保留。
    </div>
    <div class="mdui-dialog-actions">
        <button class="mdui-btn mdui-ripple" mdui-dialog-cancel>保留抽屉栏并不再提醒</button>
        <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>默认隐藏</button>
    </div>
</div>