<div class="mdui-bottom-nav bottom-nav mdui-hidden-sm-up">
    <a id="home-bottom-nav" onclick="jumpTo('{{route('showIndex')}}')" class="mdui-ripple">
        <i class="mdui-icon material-icons">home</i>
        <label>{{__('index.home')}}</label>
    </a>
    <a id="community-bottom-nav" onclick="jumpTo('{{route('showCommunity')}}')" class="mdui-ripple">
        <i class="mdui-icon material-icons">&#xe6dd;</i>
        {{--<i class="mdui-icon material-icons">&#xe0bf;</i>--}}
        <label>{{__('index.community')}}</label>
    </a>
    <a id="discover-bottom-nav" onclick="jumpTo('{{route('showDiscover')}}')" class="mdui-ripple">
        <i class="mdui-icon material-icons">explore</i>
        <label>{{__('index.discover')}}</label>
    </a>
    <a id="news-bottom-nav" onclick="jumpTo('{{route('showNews')}}')" class="mdui-ripple">
        <i class="mdui-icon ion-md-paper"></i>
        <label>{{__('index.news')}}</label>
    </a>
    @if(Auth::check())
        <a id="me-bottom-nav" onclick="jumpTo('{{route('showPersonalCenter',Auth::user()->id)}}')" class="mdui-ripple">
            <i class="mdui-icon material-icons">account_circle</i>
            <label>{{__('index.me')}}</label>
        </a>
    @else
        <a id="me-bottom-nav" onclick="jumpTo('{{route('notLogin')}}')" class="mdui-ripple">
            <i class="mdui-icon material-icons">account_circle</i>
            <label>{{__('index.me')}}</label>
        </a>
    @endif
</div>