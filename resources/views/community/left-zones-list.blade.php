<h1 class="part-title-red mdui-m-b-4" style="background: #fff;line-height: 28px;margin-top: 10px;font-size: 24px">
    <i class="mdui-icon material-icons" style="font-size: 28px;margin-top: -5px;">bubble_chart</i>
    {{__('community.zonesOfCommunity')}}
    <a href="{{route('communityTopicCreate')}}" class="mdui-btn mdui-text-color-pink-accent mdui-float-right">
        <i class="mdui-icon material-icons mdui-icon-left">&#xe145;</i>
        {{__('community.createTopics')}}
    </a>
</h1>
@foreach($zones as $zone)
    <a href="{{route('showCommunityZone',$zone->id)}}">
        <div class="community-zones-card">
            <img class="community-zones-card-icon" src="{{$zone->img_url}}"/>
            <span class="community-zones-card-title">{{$zone->name}}</span>
        </div>
    </a>
@endforeach

