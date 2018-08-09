<div class="index-carousel">
    <div class="layui-carousel" id="news-carousel">
        <div carousel-item>
            @foreach($newsCarousels as $newsCarousel)
                <a href="{{$newsCarousel->url}}" target="_blank">
                    <div>
                        <div class="mdui-card" style="height: 100%">
                            <div class="mdui-card-media">
                                <img class="mdui-img-fluid index-carousel-img" src="{{$newsCarousel->cover_img}}"/>
                                <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                                    <div class="index-carousel-primary">
                                        <div class="mdui-card-primary-title">{{$newsCarousel->title}}</div>
                                        <div class="mdui-card-primary-subtitle">{{$newsCarousel->subtitle}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
