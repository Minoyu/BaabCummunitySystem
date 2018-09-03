<h2 class="part-title-red">
    <i class="mdui-icon material-icons">&#xe80c;</i>
    {{__('index.school')}}
    <a href="{{route('showCommunityZone',2)}}" class="mdui-btn mdui-btn-dense part-title-more-btn mdui-ripple">{{__('index.more')}}
        <i class="mdui-icon material-icons mdui-icon-right">chevron_right</i>
    </a>
</h2>
<div class="swiper-container index-swiper-container">
    <div class="swiper-wrapper">
        @foreach($indexCarousels as $indexCarousel)
            @if($indexCarousel->position == 'schools_top')
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
<div id="school-tab" class="mdui-tab part-divider-tab">
    @foreach($schoolCollections as $topicC_item)
        <a href="#school-{{$topicC_item['schoolSection']->id}}" class="mdui-ripple">{{$topicC_item['schoolSection']->name}}</a>
    @endforeach
</div>
@foreach($schoolCollections as $topicC_item)
    <div id="school-{{$topicC_item['schoolSection']->id}}">
        <div class="mdui-list index-list">
            @foreach($topicC_item['topics'] as $topic)
                <a href="{{route('showCommunityContent',$topic->id)}}" class="mdui-list-item mdui-ripple index-info-h">{{$topic->title}}</a>
            @endforeach
        </div>
    </div>
@endforeach

