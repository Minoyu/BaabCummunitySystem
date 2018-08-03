<div class="mdui-drawer drawer-padding-top" id="admin-drawer">
    <ul class="mdui-list drawer-menu mdui-color-white" id="adminDrawerMenu" mdui-collapse>

        <li class="mdui-collapse-item mdui-panel-item-open">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">settings</i>
                <div class="mdui-list-item-content">新闻管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsList')}}">
                    <li class="mdui-list-item mdui-ripple">新闻列表</li>
                </a>
                <a href="{{route('adminNewsCreate')}}">
                    <li class="mdui-list-item mdui-ripple">创建新闻</li>
                </a>
            </ul>
        </li>

        <li class="mdui-collapse-item">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">settings</i>
                <div class="mdui-list-item-content">新闻回复管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsReplyAllList')}}">
                    <li class="mdui-list-item mdui-ripple">全站回复列表</li>
                </a>
                <a href="{{route('adminNewsList')}}">
                    <li class="mdui-list-item mdui-ripple">新闻列表检索</li>
                </a>
            </ul>
        </li>

        <div class="mdui-divider"></div>

        <a href="{{route('switchLang')}}">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-cyan">translate</i>
                <div class="mdui-list-item-content">{{__('index.switchLang')}}</div>
            </li>
        </a>


    </ul>
</div>