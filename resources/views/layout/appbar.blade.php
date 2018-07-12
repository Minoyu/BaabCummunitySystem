<div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-toolbar-hide">
    <div class="mdui-toolbar mdui-color-theme-600">
        <button mdui-drawer="{target: '#index-drawer'}" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></button>
        <a href="javascript:;" class="mdui-typo-title">{{ env('APP_NAME','留学生网站') }}</a>
        <div class="mdui-toolbar-spacer "></div>
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></a>
        <button id="appbar-right-menu-btn" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">account_circle</i></button>
        @include('layout.appbar-right-menu')
    </div>
    <div class="mdui-tab mdui-tab-centered mdui-color-theme-700" mdui-tab>
        <a href="#example3-tab1" class="mdui-ripple mdui-ripple-white">{{ __('index.home')}}</a>
        <a href="#example3-tab1" class="mdui-ripple mdui-ripple-white">{{ __('index.community')}}</a>
    </div>
</div>
