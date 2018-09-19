<h2 class="part-title-blue" style="background: #fff">
    <i class="mdui-icon material-icons">&#xe6dd;</i>
    {{__('index.community')}}
    <a href="{{route('showCommunity')}}" class="mdui-btn mdui-btn-dense part-title-more-btn mdui-ripple" style="float: none !important;">{{__('index.more')}}
        <i class="mdui-icon material-icons mdui-icon-right">chevron_right</i>
    </a>
</h2>
@foreach($communityZones as $zone)
    <h2 class="part-title-with-bg mdui-m-t-3 mdui-text-center">
        {{$zone->name}}
        <a href="{{route('showCommunityZone',$zone->id)}}" class="mdui-btn mdui-btn-dense part-title-more-btn mdui-ripple">{{__('index.more')}}
            <i class="mdui-icon material-icons mdui-icon-right">chevron_right</i>
        </a>
    </h2>
    <div class="mdui-row-md-3 mdui-row-sm-2 mdui-row-xs-1 ">
        @foreach($zone->communitySections as $communitySection)
            <div class="mdui-col">
                <a href="{{route('showCommunitySection',$communitySection->id)}}">
                    <div class="index-community-card mdui-hoverable">
                        <div class="index-community-card-header">
                            <img class="index-community-card-header-avatar" src="{{$communitySection->img_url}}"/>
                            <div class="index-community-card-header-title">{{$communitySection->name}}</div>
                            <div class="index-community-card-header-count">{{__('index.postsCount')}}：{{$communitySection->topic_count}}</div>
                            <div class="index-community-card-header-subtitle">{{$communitySection->description}}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endforeach