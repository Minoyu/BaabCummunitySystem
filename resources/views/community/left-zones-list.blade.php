<h1 class="part-h mdui-m-b-4">{{__('community.zonesOfCommunity')}}</h1>
@foreach($zones as $zone)
    <a href="{{route('showCommunityZone',$zone->id)}}">
        <div class="community-zones-card">
            <img class="community-zones-card-icon" src="{{$zone->img_url}}"/>
            <span class="community-zones-card-title">{{$zone->name}}</span>
        </div>
    </a>
@endforeach

