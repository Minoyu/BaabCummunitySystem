<div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-toolbar-hide">
    <div class="mdui-toolbar mdui-color-theme-600">
        <button mdui-drawer="{target: '#index-drawer'}" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></button>
        <a href="{{route('showIndex')}}" class="mdui-typo-title">{{ __('index.app_name') }}</a>
        <a href="@yield('subtitleUrl')" class="mdui-typo-subheading mdui-hidden-xs">@yield('title')</a>
        <div class="mdui-toolbar-spacer "></div>
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></a>
        <button id="appbar-right-menu-btn" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">account_circle</i></button>
        @include('layout.appbar-right-menu')
    </div>
    <div class="mdui-tab mdui-tab-centered mdui-color-theme-700 mdui-hidden-xs-down" mdui-tab>
        <a onclick="jumpTo('{{route('showIndex')}}')" href="#" class="mdui-ripple mdui-ripple-white" id="home-tab">{{ __('index.home')}}</a>
        <a onclick="jumpTo('{{route('showNews')}}')" href="#" class="mdui-ripple mdui-ripple-white" id="news-tab">{{ __('index.news')}}</a>
        <a onclick="jumpTo('{{route('showCommunity')}}')" href="#" class="mdui-ripple mdui-ripple-white" id="community-tab">{{ __('index.community')}}</a>
        @if(Auth::check())
            <a onclick="jumpTo('{{route('showPersonalCenter',Auth::user()->id)}}')" href="#" class="mdui-ripple mdui-ripple-white" id="me-tab">{{ __('index.me')}}</a>
        @else
            <a href="#" class="mdui-ripple mdui-ripple-white mdui-hidden" id="me-tab">{{ __('index.me')}}</a>
        @endif
    </div>
</div>
