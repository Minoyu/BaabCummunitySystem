<ul class="mdui-menu appbar-menu" style="width: auto" id="appbar-right-menu">
    <div class="user-div">
        @if(Auth::check())
            <a href="{{route('showPersonalCenter',Auth::user()->id)}}"><img class="user-profile mdui-hoverable userAvatar" src="{{Auth::user()->info->avatar_url}}" /></a>
            <h2 class="appbar-menu-title">{{Auth::user()->name}}</h2>
            <h3 class="appbar-menu-subtitle">{{Auth::user()->info->motto}}</h3>
        @else
            <a onclick="openLoginDialog()"><img class="user-profile mdui-hoverable" src="/imgs/user_profile.png" /></a>
            <h2 class="appbar-menu-title">{{__('index.welcome')}}</h2>
            <h3 class="appbar-menu-subtitle">
                <button onclick="openLoginDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-100 mdui-ripple">{{__('index.login')}}</button>
                {{__('index.or')}}
                <button onclick="openRegisterDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-grey mdui-ripple">{{__('index.register')}}</button>
            </h3>
        @endif

    </div>
    <div class="mdui-divider"></div>
    @if(Auth::check())
        <li class="mdui-menu-item">
            <a href="{{route('showPersonalCenter',Auth::user()->id)}}" class="mdui-ripple">
                <i class="mdui-menu-item-icon mdui-icon material-icons">beach_access</i>{{__('index.personalCenter')}}
            </a>
        </li>
        <li class="mdui-menu-item">
            <a href="{{route('userLogout')}}" class="mdui-ripple">
                <i class="mdui-menu-item-icon mdui-icon material-icons">exit_to_app</i>{{__('auth.logout')}}
            </a>
        </li>
    @endif
    @role('Founder')
        <li class="mdui-menu-item">
            <a href="{{route('showAdmin')}}" class="mdui-ripple">
                <i class="mdui-menu-item-icon mdui-icon material-icons">settings</i>管理后台 <span class="layui-badge">站长</span>
            </a>
        </li>
    @endrole
    @role('Maintainer')
        <li class="mdui-menu-item">
            <a href="{{route('showAdmin')}}" class="mdui-ripple">
                <i class="mdui-menu-item-icon mdui-icon material-icons">settings</i>管理后台 <span class="layui-badge">管理员</span>
            </a>
        </li>
    @endrole
    <li class="mdui-menu-item">
        <a href="{{route('switchLang')}}" class="mdui-ripple">
            <i class="mdui-menu-item-icon mdui-icon material-icons">translate</i>{{__('index.switchLang')}}
        </a>
    </li>
    {{--<li class="mdui-menu-item">--}}
        {{--<a href="javascript:;" class="mdui-ripple">--}}
            {{--<i class="mdui-menu-item-icon mdui-icon material-icons">file_download</i>Download--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--<li class="mdui-divider"></li>--}}
    {{--<li class="mdui-menu-item">--}}
        {{--<a href="javascript:;" class="mdui-ripple">--}}
            {{--<i class="mdui-menu-item-icon mdui-icon material-icons">delete</i>Remove--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--<li class="mdui-menu-item">--}}
        {{--<a href="javascript:;" class="mdui-ripple">--}}
            {{--<i class="mdui-menu-item-icon"></i>Empty--}}
        {{--</a>--}}
    {{--</li>--}}
</ul>