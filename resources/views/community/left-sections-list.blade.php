@foreach($zones as $zone)
    <h2 class="part-title-red">
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
                            <img class="index-community-card-header-avatar" src="http://via.placeholder.com/200x200"/>
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
