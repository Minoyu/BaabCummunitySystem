<div class="layui-carousel" id="index-carousel">
    <div carousel-item>
        @foreach($indexCarousels as $indexCarousel)
            @if($indexCarousel->position == 'bannar')
                <a href="{{$indexCarousel->url}}" target="_blank">
                    <div>
                        <div class="mdui-card" style="height: 100%">
                            <div class="mdui-card-media">
                                <img class="mdui-img-fluid index-carousel-img" src="{{$indexCarousel->cover_img}}"/>
                                <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                                    <div class="index-carousel-primary">
                                        <div class="mdui-card-primary-title">{{$indexCarousel->title}}</div>
                                        <div class="mdui-card-primary-subtitle">{{$indexCarousel->subtitle}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</div>