<div class="swiper-container banner-container">
    <div class="swiper-wrapper">
        @foreach($newsCarousels as $newsCarousel)
            <div class="swiper-slide">
                <a href="{{$newsCarousel->url}}" target="_blank">
                    <div class="mdui-card" style="height: 100%">
                        <div class="mdui-card-media">
                            <img class="mdui-img-fluid index-carousel-img" src="{{$newsCarousel->cover_img}}"/>
                            <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                                <div class="index-carousel-primary">
                                    <div class="mdui-card-primary-title">{{$newsCarousel->title}}</div>
                                    <div class="mdui-card-primary-subtitle mdui-hidden-xs-down">{{$newsCarousel->subtitle}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="swiper-button-prev mdui-hidden-sm-down"></div><!--左箭头-->
    <div class="swiper-button-next mdui-hidden-sm-down"></div><!--右箭头-->
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination banner-pagination"></div>

    <div class="swiper-scrollbar mdui-hidden-md-up"></div>
</div>
