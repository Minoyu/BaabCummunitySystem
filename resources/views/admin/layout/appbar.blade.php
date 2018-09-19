<div class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-teal-500">
        <button mdui-drawer="{target: '#admin-drawer'}" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></button>
        <a href="#" class="mdui-typo-title">{{ __('index.app_name') }} {{__('admin.controlPanel')}}</a>
        <a href="@yield('subtitleUrl')" class="mdui-typo-subheading mdui-hidden-xs">@yield('title')</a>
        <div class="mdui-toolbar-spacer "></div>
        <button id="appbar-right-menu-btn" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">account_circle</i></button>
        @include('layout.appbar-right-menu')
    </div>
</div>
