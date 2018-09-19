<h2 class="part-title-blue">
    <i class="mdui-icon ion-md-paper"></i>
    {{__('index.info')}}
    <a href="{{route('showNews')}}" class="mdui-btn mdui-btn-dense part-title-more-btn mdui-ripple">{{__('index.more')}}
        <i class="mdui-icon material-icons mdui-icon-right">chevron_right</i>
    </a>
</h2>
<div class="swiper-container index-swiper-container">
    <div class="swiper-wrapper">
        @foreach($indexCarousels as $indexCarousel)
            @if($indexCarousel->position == 'info_top')
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
<div id="info-tab" class="mdui-tab part-divider-tab">
    @foreach($newsCollections as$newsC_item)
        <a href="#info-{{$newsC_item['newsCategory']->id}}" class="mdui-ripple">{{$newsC_item['newsCategory']->name}}</a>
    @endforeach
</div>
@foreach($newsCollections as$newsC_item)
    <div id="info-{{$newsC_item['newsCategory']->id}}">
        <div class="mdui-list index-list">
            @foreach($newsC_item['newses'] as $news)
                <a href="{{route('showNewsContent',$news->id)}}" class="mdui-list-item mdui-ripple index-info-h">{{$news->title}}</a>
            @endforeach
        </div>
    </div>
@endforeach
