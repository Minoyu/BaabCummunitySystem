<div class="swiper-container banner-container">
    <div class="swiper-wrapper">
        @foreach($indexCarousels as $indexCarousel)
            @if($indexCarousel->position == 'banner')
                <div class="swiper-slide">
                    <a href="{{$indexCarousel->url}}" target="_blank">
                        <div class="mdui-card" style="height: 100%">
                            <div class="mdui-card-media">
                                <img class="mdui-img-fluid index-carousel-img" src="{{$indexCarousel->cover_img}}"/>
                                <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                                    <div class="index-carousel-primary">
                                        <div class="mdui-card-primary-title">{{$indexCarousel->title}}</div>
                                        <div class="mdui-card-primary-subtitle mdui-hidden-xs-down">{{$indexCarousel->subtitle}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
    <div class="swiper-button-prev mdui-hidden-sm-down"></div><!--左箭头-->
    <div class="swiper-button-next mdui-hidden-sm-down"></div><!--右箭头-->
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination banner-pagination"></div>

    <div class="swiper-scrollbar mdui-hidden-md-up"></div>

</div>