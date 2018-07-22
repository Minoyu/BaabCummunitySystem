<div class="mdui-drawer drawer-padding-top" id="index-drawer">
    <ul class="mdui-list drawer-menu" id="drawerMenu" mdui-collapse>

        <div class="mdui-m-b-1 drawer-top">
            <img class="mdui-img-fluid drawer-top-img" src="/imgs/drawer_top.png"/>
            @if(Auth::check())
                <a href="#"><img class="drawer-top-profile mdui-hoverable" src="{{Auth::user()->avatar_url}}" /></a>
                <span class="drawer-top-title mdui-text-color-white">{{Auth::user()->name}}</span>
                <span class="drawer-top-subtitle mdui-text-color-white">{{__('index.top-subtitle')}}</span>
            @else
                <a onclick="openLoginDialog()"><img class="drawer-top-profile mdui-hoverable" src="/imgs/user_profile.png" /></a>
                <span class="drawer-top-title mdui-text-color-white">{{__('index.top-title')}} <a onclick="openLoginDialog()">{{__('index.login')}}</a> {{__('index.or')}} <a onclick="openRegisterDialog()">{{__('index.register')}}</a></span>
                <span class="drawer-top-subtitle mdui-text-color-white">{{__('index.top-subtitle')}}</span>
            @endif
            <button class="mdui-btn mdui-btn-icon drawer-top-close mdui-text-color-white mdui-ripple" mdui-drawer-close>
                <i class="mdui-icon material-icons">clear_all</i>
            </button>
        </div>

        <a href="/">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-cyan">home</i>
                <div class="mdui-list-item-content">{{__('index.home')}}</div>
            </li>
        </a>

        <a href="#">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe6dd;</i>
                <div class="mdui-list-item-content">{{__('index.community')}}</div>
            </li>
        </a>

        <div class="mdui-divider"></div>

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