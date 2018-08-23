<h2 class="part-title-blue">
    <i class="mdui-icon material-icons">&#xe0b7;</i>
    {{__('community.topics')}}
    <a href="{{route('showCommunity')}}" class="mdui-btn mdui-btn-dense part-title-more-btn mdui-ripple">{{__('index.more')}}
        <i class="mdui-icon material-icons mdui-icon-right">chevron_right</i>
    </a>
</h2>
<div class="swiper-container index-swiper-container">
    <div class="swiper-wrapper">
        @foreach($indexCarousels as $indexCarousel)
            @if($indexCarousel->position == 'topic_top')
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
<div id="regional-tab" class="mdui-tab part-divider-tab">
    @foreach($communitySections as $communitySection)
        <a href="#topic-{{$communitySection->id}}" class="mdui-ripple">{{$communitySection->name}}</a>
    @endforeach
</div>
@foreach($communitySections as $communitySection)
    <div id="topic-{{$communitySection->id}}">
        {{--<div class="mdui-row">--}}
        {{--<div class="mdui-col-xs-4 mdui-col-sm-3 mdui-col-md-4 mdui-col-lg-3">--}}
        {{--<img class="mdui-img-fluid info-first-img" src="http://via.placeholder.com/300x200"/>--}}
        {{--</div>--}}
        {{--<div class="mdui-col-xs-8 mdui-col-sm-9 mdui-col-md-8 mdui-col-lg-9 ">--}}
        {{--<a href="" class="index-info-img-h">hahhahahahahhahahahahahahhaha</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="mdui-list index-list">
            @foreach($communitySection->communityTopics as $topic)
                <a href="{{route('showCommunityContent',$topic->id)}}" class="mdui-list-item mdui-ripple index-info-h">{{$topic->title}}</a>
            @endforeach
        </div>
    </div>
@endforeach
