<h2 class="part-title-red">
    <i class="mdui-icon material-icons">explore</i>
    {{__('index.topNews')}}
    <a href="{{route('showNews')}}" class="mdui-btn mdui-btn-dense part-title-more-btn mdui-ripple">{{__('index.more')}}
        <i class="mdui-icon material-icons mdui-icon-right">chevron_right</i>
    </a>
</h2>
<div class="mdui-row">
    <div class="mdui-col-md-6 mdui-col-xs-12">
        {{--左侧头条--}}
        <div class="mdui-row">
            <div class="mdui-col-xs-4">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($indexCarousels as $indexCarousel)
                            @if($indexCarousel->position == 'headline_left')
                                <div class="swiper-slide">
                                    <div class="mdui-card topnews-img-card">
                                        <div class="mdui-card-media">
                                            <img class="mdui-img-fluid" src="{{$indexCarousel->cover_img}}"/>
                                            <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                                                <div class="topnews-img-primary">
                                                    <div class="mdui-card-primary-title">{{$indexCarousel->title}}</div>
                                                    <div class="mdui-card-primary-subtitle">{{$indexCarousel->subtitle}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <!-- 如果需要滚动条 -->
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>

            <div class="mdui-col-xs-8">
                <a href="#" class="topnews-h1">测试头条1测试头条1测试头条1</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条2测试头条2测试头条2</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条3测试头条3测试头条3</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条4测试头条4测试头条4</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条5测试头条5测试头条5</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条6测试头条6测试头条6</a>
                <a href="#" class="topnews-part-name">测试板块</a>
            </div>
        </div>
    </div>
    <div class="mdui-col-md-6 mdui-col-xs-12">
        <div class="mdui-divider mdui-m-t-1 mdui-m-b-1 mdui-hidden-md-up"></div>
        {{--右侧头条--}}
        <div class="mdui-row">
            <div class="mdui-col-xs-4">
                @foreach($indexCarousels as $indexCarousel)
                    @if($indexCarousel->position == 'headline_right')
                        <div class="swiper-slide">
                            <div class="mdui-card">
                                <div class="mdui-card-media">
                                    <img class="mdui-img-fluid" src="{{$indexCarousel->cover_img}}"/>
                                    <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                                        <div class="topnews-img-primary">
                                            <div class="mdui-card-primary-title">{{$indexCarousel->title}}</div>
                                            <div class="mdui-card-primary-subtitle">{{$indexCarousel->subtitle}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="mdui-col-xs-8">
                <a href="#" class="topnews-h1">测试头条1测试头条1测试头条1</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条2测试头条2测试头条2</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条3测试头条3测试头条3</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条4测试头条4测试头条4</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条5测试头条5测试头条5</a>
                <a href="#" class="topnews-part-name">测试板块</a>
                <a href="#" class="topnews-h2">测试头条6测试头条6测试头条6</a>
                <a href="#" class="topnews-part-name">测试板块</a>

            </div>
        </div>
    </div>
</div>