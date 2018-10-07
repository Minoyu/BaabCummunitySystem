<div class="mdui-card">
    <div class="mdui-tab"  id="carousel-right">
        <a href="#newTopics" class="mdui-ripple">
            <i class="mdui-icon material-icons mdui-text-color-teal">&#xe05e;</i>
            <label>{{__('index.whatsNew')}}</label>
        </a>
        <a href="#hotTopics" class="mdui-ripple">
            <i class="mdui-icon material-icons mdui-text-color-red">whatshot</i>
            <label>{{__('index.whatsHot')}}</label>
        </a>
    </div>
    <div id="newTopics">
        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable index-carousel-r-table">
                <tbody>
                @foreach($newTopics as $newTopic)
                    @switch($loop->iteration)
                        @case(1)
                        <tr>
                            <td><i class="mdui-icon material-icons mdui-text-color-teal">looks_one</i><a href="{{route('showCommunityContent',$newTopic->id)}}">{{$newTopic->title}}</a></td>
                        </tr>
                        @break
                        @case(2)
                        <tr>
                            <td><i class="mdui-icon material-icons mdui-text-color-teal-300">looks_two</i><a href="{{route('showCommunityContent',$newTopic->id)}}">{{$newTopic->title}}</a></td>
                        </tr>
                        @break
                        @case(3)
                        <tr>
                            <td><i class="mdui-icon material-icons mdui-text-color-teal-100">looks_3</i><a href="{{route('showCommunityContent',$newTopic->id)}}">{{$newTopic->title}}</a></td>
                        </tr>
                        @break
                        @case(6)
                        @case(7)
                        <tr class="small-pc-hidden">
                            <td><i class="mdui-icon ion-md-arrow-dropright mdui-text-color-teal-100"></i><a href="{{route('showCommunityContent',$newTopic->id)}}">{{$newTopic->title}}</a></td>
                        </tr>
                        @break
                        @default
                        <tr>
                            <td><i class="mdui-icon ion-md-arrow-dropright mdui-text-color-teal-100"></i><a href="{{route('showCommunityContent',$newTopic->id)}}">{{$newTopic->title}}</a></td>
                        </tr>
                @endswitch
                @endforeach
            </table>
        </div>
    </div>
    <div id="hotTopics">
        <div class="">
            <table class="mdui-table mdui-table-hoverable index-carousel-r-table">
                <tbody>
                    @foreach($hotTopics as $hotTopic)
                        @switch($loop->iteration)
                            @case(1)
                                <tr>
                                    <td  class="mdui-text-truncate"><i class="mdui-icon ion-md-flame mdui-text-color-red"></i><a href="{{route('showCommunityContent',$hotTopic->id)}}">{{$hotTopic->title}}</a></td>
                                </tr>
                                @break
                            @case(2)
                                <tr>
                                    <td  class="mdui-text-truncate"><i class="mdui-icon ion-md-flame mdui-text-color-red-300"></i><a href="{{route('showCommunityContent',$hotTopic->id)}}">{{$hotTopic->title}}</a></td>
                                </tr>
                                @break
                            @case(3)
                                <tr>
                                    <td  class="mdui-text-truncate"><i class="mdui-icon ion-md-flame mdui-text-color-red-100"></i><a href="{{route('showCommunityContent',$hotTopic->id)}}">{{$hotTopic->title}}</a></td>
                                </tr>
                                @break
                            @case(6)
                            @case(7)
                                <tr class="small-pc-hidden">
                                    <td  class="mdui-text-truncate"><i class="mdui-icon ion-md-arrow-dropright mdui-text-color-red-100"></i><a href="{{route('showCommunityContent',$hotTopic->id)}}">{{$hotTopic->title}}</a></td>
                                </tr>
                                @break
                            @default
                                <tr>
                                    <td  class="mdui-text-truncate"><i class="mdui-icon ion-md-arrow-dropright mdui-text-color-red-100"></i><a href="{{route('showCommunityContent',$hotTopic->id)}}">{{$hotTopic->title}}</a></td>
                                </tr>
                        @endswitch
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>