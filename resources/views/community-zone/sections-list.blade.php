<h1 class="part-title-with-bg">Sections</h1>
@foreach($sections as $section)
    <a href="{{route('showCommunitySection',$section->id)}}">
        <div class="community-sec-top-card mdui-hoverable">
            <div class="community-sec-top-card-header">
                <img class="community-sec-top-card-header-avatar" src="{{$section->img_url}}"/>
                <div class="community-sec-top-card-header-title">{{$section->name}}</div>
                <div class="community-sec-top-card-header-count mdui-text-color-indigo">{{__('index.postsCount')}} {{$section->topic_count}} </div>
                <div class="community-sec-top-card-header-subtitle">
                    @if(isset($section->communityTopics[0]))
                        {{__('community.latest')}}： <a href="{{route('showCommunityContent',$section->communityTopics[0]->id)}}">{{$section->communityTopics[0]->title}}</a>
                        <br>{{\Illuminate\Support\Carbon::parse($section->communityTopics[0]->last_reply_at)->diffForHumans()}}
                    @else
                        {{__('community.noReplyInSection')}}
                        <br>{{__('community.SectionCreatedAt')}}{{$section->created_at->diffForHumans()}}
                    @endif
                </div>
            </div>
        </div>
    </a>
@endforeach