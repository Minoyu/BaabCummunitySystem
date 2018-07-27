<div class="mdui-drawer drawer-padding-top" id="admin-drawer">
    <ul class="mdui-list drawer-menu mdui-color-white" id="adminDrawerMenu" mdui-collapse>

        <a href="/">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-cyan">home</i>
                <div class="mdui-list-item-content">{{__('index.home')}}</div>
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