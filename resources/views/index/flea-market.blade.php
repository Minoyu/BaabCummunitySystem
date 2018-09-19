<h2 class="part-title-red">
    <i class="mdui-icon material-icons">&#xe8f6;</i>
    {{__('index.fleaMarket')}}
    <a href="{{route('showCommunityZone',1)}}" class="mdui-btn mdui-btn-dense part-title-more-btn mdui-ripple">{{__('index.more')}}
        <i class="mdui-icon material-icons mdui-icon-right">chevron_right</i>
    </a>
</h2>
<div class="swiper-container index-swiper-container">
    <div class="swiper-wrapper">
        @foreach($indexCarousels as $indexCarousel)
            @if($indexCarousel->position == 'flea_market_top')
                <div class="swiper-slide">
                    <a href="{{$indexCarousel->url}}">
                        <div class="mdui-card">
                            <div class="mdui-card-media index-small-top-carousel">
                                <img class="mdui-img-fluid" src="{{$indexCarousel->cover_img}}"/>
                                <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                                    <div class="topnews-img-primary">
                                        <div class="mdui-card-primary-title">{{$indexCarousel->title}}</div>
                                        <div class="mdui-card-primary-subtitle">{{$indexCarousel->subtitle}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
    <div class="swiper-scrollbar"></div>
</div>

<div id="flea-market-tab" class="mdui-tab part-divider-tab">
    @foreach($businessCollections as $topicC_item)
        <a href="#business-{{$topicC_item['businessSection']->id}}" class="mdui-ripple">{{$topicC_item['businessSection']->name}}</a>
    @endforeach
</div>
@foreach($businessCollections as $topicC_item)
    <div id="business-{{$topicC_item['businessSection']->id}}">
        <div class="mdui-list index-list">
            @foreach($topicC_item['topics'] as $topic)
                <a href="{{route('showCommunityContent',$topic->id)}}" class="mdui-list-item mdui-ripple index-info-h">{{$topic->title}}</a>
            @endforeach
        </div>
    </div>
@endforeach

