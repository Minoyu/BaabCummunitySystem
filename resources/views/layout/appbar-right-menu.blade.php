<ul class="mdui-menu appbar-menu" style="width: auto" id="appbar-right-menu">
    <div class="user-div">
        <a onclick="openLoginDialog()"><img class="user-profile mdui-hoverable" src="/imgs/user_profile.png" /></a>
        <h2 class="appbar-menu-title">{{__('index.welcome')}}</h2>
        <h3 class="appbar-menu-subtitle">
            <button onclick="openLoginDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-100 mdui-ripple">{{__('index.login')}}</button>
            {{__('index.or')}}
            <button onclick="openRegisterDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-grey mdui-ripple">{{__('index.register')}}</button>
        </h3>
    </div>
    <div class="mdui-divider"></div>
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