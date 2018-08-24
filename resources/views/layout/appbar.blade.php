<div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-toolbar-hide">
    <div class="mdui-toolbar mdui-color-theme-600">
        <button id="barMenu" onclick="toggleIndexDrawer()" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></button>
        <a id="barTitle" href="{{route('showIndex')}}" class="mdui-typo-title">{{ __('index.app_name') }}</a>
        <a id="barSubTitle" href="@yield('subtitleUrl')" class="mdui-typo-subheading mdui-hidden-xs">@yield('title')</a>
        <div class="mdui-toolbar-spacer "></div>
        <div class="mdui-textfield mdui-textfield-expandable mdui-float-right mdui-color-theme-600" style="max-width:400px">
            <form id="barSearchForm" action="{{route('showSearchRes')}}" method="get">
                <button id="barSearchBtn" type="button" onclick="hideBarTitle()"  class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                <label id="barSearchLabel">
                    <input id="barSearch" name="keywords" autocomplete="off" class="mdui-textfield-input" style="color:white;border-bottom-color: white" type="text" placeholder="Search"/>
                </label>
                <button type="button" onclick="showBarTitle()" class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
                {{--应用栏搜索提示框--}}
                <ul class="mdui-menu mdui-menu-cascade" style="margin-top: 10px;margin-left: 37px" id="barSearchTips">
                    <div class="mdui-progress barSearchTipsAjaxProgress" style="margin-top: -16px;margin-bottom: 10px"></div>
                    <div id="barSearchTipsContent" class="bar-search-tips-content">
                        <li class="mdui-menu-item bar-search-tips search-tips-null">
                            <a class="mdui-ripple mdui-text-color-grey-700">
                                : ) 目前 您可以尝试输入您所想要查找的
                            </a>
                        </li>
                        <li class="mdui-menu-item bar-search-tips search-tips-null" style="margin-left: 20px">
                            <a class="mdui-ripple mdui-text-color-grey-700">
                                <i class="mdui-icon ion-md-paper"></i> 新闻
                            </a>
                        </li>
                        <li class="mdui-menu-item bar-search-tips search-tips-null" style="margin-left: 20px">
                            <a class="mdui-ripple mdui-text-color-grey-700">
                                <i class="mdui-icon material-icons">bubble_chart</i> 社区话题
                            </a>
                        </li>
                        <li class="mdui-menu-item bar-search-tips search-tips-null" style="margin-left: 20px">
                            <a class="mdui-ripple mdui-text-color-grey-700">
                                <i class="mdui-icon material-icons">account_circle</i> 用户
                            </a>
                        </li>
                        <li class="mdui-menu-item bar-search-tips search-tips-null" style="margin-left: 20px">
                            <a class="mdui-ripple mdui-text-color-grey-700">
                                <i class="mdui-icon material-icons">view_list</i> 新闻版块、社区分区及板块
                            </a>
                        </li>
                    </div>
                </ul>

            </form>
        </div>
        <button id="appbar-right-menu-btn" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">account_circle</i></button>
        @include('layout.appbar-right-menu')
    </div>

    <div class="mdui-tab mdui-tab-centered mdui-color-theme-700 mdui-hidden-xs-down" mdui-tab>
        <a onclick="jumpTo('{{route('showIndex')}}')" href="#" class="mdui-ripple mdui-ripple-white" id="home-tab">{{ __('index.home')}}</a>
        <a onclick="jumpTo('{{route('showNews')}}')" href="#" class="mdui-ripple mdui-ripple-white" id="news-tab">{{ __('index.news')}}</a>
        <a onclick="jumpTo('{{route('showCommunity')}}')" href="#" class="mdui-ripple mdui-ripple-white" id="community-tab">{{ __('index.community')}}</a>
        <a onclick="jumpTo('{{route('showDiscover')}}')" href="#" class="mdui-ripple mdui-ripple-white" id="discover-tab">{{ __('index.discover')}}</a>
        @if(Auth::check())
            <a onclick="jumpTo('{{route('showPersonalCenter',Auth::user()->id)}}')" href="#" class="mdui-ripple mdui-ripple-white" id="me-tab">{{ __('index.me')}}</a>
        @else
            <a href="#" class="mdui-ripple mdui-ripple-white mdui-hidden" id="me-tab">{{ __('index.me')}}</a>
        @endif
    </div>
</div>
