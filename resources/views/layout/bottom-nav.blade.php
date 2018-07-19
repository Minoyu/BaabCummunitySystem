<div class="mdui-bottom-nav bottom-nav mdui-hidden-sm-up">
    <a id="home-bottom-nav" href="{{route('showIndex')}}" class="mdui-ripple">
        <i class="mdui-icon material-icons">home</i>
        <label>{{__('index.home')}}</label>
    </a>
    <a id="community-bottom-nav" href="{{route('showCommunity')}}" class="mdui-ripple">
        <i class="mdui-icon material-icons">&#xe6dd;</i>
        <label>{{__('index.community')}}</label>
    </a>
    <a id="news-bottom-nav" href="{{route('showNews')}}" class="mdui-ripple">
        <i class="mdui-icon material-icons">explore</i>
        <label>{{__('index.news')}}</label>
    </a>
    <a href="javascript:;" class="mdui-ripple">
        <i class="mdui-icon material-icons">account_circle</i>
        <label>{{__('index.me')}}</label>
    </a>
</div>