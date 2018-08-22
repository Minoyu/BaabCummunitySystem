<h2 class="part-title-blue">
    <i class="mdui-icon ion-md-paper"></i>
    {{__('index.info')}}
    <a href="{{route('showNews')}}" class="mdui-btn mdui-btn-dense part-title-more-btn mdui-ripple">{{__('index.more')}}
        <i class="mdui-icon material-icons mdui-icon-right">chevron_right</i>
    </a>
</h2>
<div id="info-tab" class="mdui-tab part-divider-tab">
    @foreach($newsCategories as$newsCategory)
        <a href="#info-{{$newsCategory->id}}" class="mdui-ripple">{{$newsCategory->name}}</a>
    @endforeach
</div>
<div class="swiper-container index-swiper-container">
    <div class="swiper-wrapper">
        @foreach($indexCarousels as $indexCarousel)
            @if($indexCarousel->position == 'info_top')
                <div class="swiper-slide">
                    <a href="{{$indexCarousel->url}}">
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
                    </a>
                </div>
            @endif
        @endforeach
    </div>
    <div class="swiper-scrollbar"></div>
</div>
@foreach($newsCategories as$newsCategory)
    <div id="info-{{$newsCategory->id}}">
        <div class="mdui-list index-list">
            @foreach($newsCategory->news as $news_item)
                <a href="{{route('showNewsContent',$news_item->id)}}" class="mdui-list-item mdui-ripple index-info-h">{{$news_item->title}}</a>
            @endforeach
        </div>
    </div>
@endforeach
