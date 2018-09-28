<div class="mdui-card news-content-card" style="border-radius: 10px">
    <div class="mdui-card-header topic-mobile-user-top mdui-hidden-md-up">
        <a href="{{route('showPersonalCenter',$topic->user->id)}}">
            <img class="mdui-card-header-avatar" src="{{$topic->user->info->avatar_url}}"/>
        </a>
        <a href="{{route('showPersonalCenter',$topic->user->id)}}">
            <div class="mdui-card-header-title">
                {{$topic->user->name}}
                @foreach($topic->user->roles as $role)
                    @switch($role->name)
                        @case('Founder')
                        <span class="layui-badge">{{$role->name}}</span>
                        @break
                        @case('Maintainer')
                        <span class="layui-badge layui-bg-blue">{{$role->name}}</span>
                        @break
                        @case('BanedUser')
                        <span class="layui-badge layui-bg-black">Banned</span>
                        @break
                    @endswitch
                @endforeach
            </div>
        </a>
        <div class="mdui-card-header-subtitle">
            @if($topic->user->info->motto)
                {{$topic->user->info->motto}}
            @else
                {{__('user.noMotto')}}
            @endif
        </div>
        <button onclick="toggleMobileTopicUserInfoTop()" id="mobileTopicUserInfoTopBtn" class="mdui-btn mdui-btn-icon topic-mobile-user-info-btn">
            <i class="mdui-icon material-icons mdui-panel-item-arrow">keyboard_arrow_down</i>
        </button>
        <div class="mdui-collapse" id="mobileTopicUserInfoTop">
            <div class="mdui-collapse-item" id="mobileTopicUserInfoTopItem">
                <div class="mdui-collapse-item-body">
                    <div style="margin-top: 10px;"></div>
                    @if($topic->user->info->sex&&$topic->user->info->sex_open=="true")
                        <div class="side-card-content-item">
                            <div class="side-card-content-item-h">{{__('user.sex')}}</div>
                            @if($topic->user->info->sex)
                                <div class="side-card-content-item-c"><i class="mdui-icon ion-md-male mdui-text-color-blue"></i></div>
                            @else
                                <div class="side-card-content-item-c"><i class="mdui-icon ion-md-female mdui-text-color-red"></i></div>
                            @endif
                        </div>
                    @endif

                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            {{__('user.motto')}}
                        </div>
                        <div class="side-card-content-item-c">
                            @if($topic->user->info->motto)
                                {{$topic->user->info->motto}}
                            @else
                                {{__('user.noMotto')}}
                            @endif
                        </div>
                    </div>
                    @if($topic->user->info->wechat&&$topic->user->info->wechat_open=="true")
                        <div class="side-card-content-item">
                            <div class="side-card-content-item-h">
                                {{__('user.wechatId')}}
                            </div>
                            <div class="side-card-content-item-c">
                                {{$topic->user->info->wechat}}
                            </div>
                        </div>
                    @endif
                    @if($topic->user->info->nation&&$topic->user->info->nation_open=="true")
                        <div class="side-card-content-item">
                            <div class="side-card-content-item-h">
                                {{__('user.nation')}}
                            </div>
                            <div class="side-card-content-item-c">
                                {{$topic->user->info->nation}}
                            </div>
                        </div>
                    @endif
                    @if($topic->user->info->living_city&&$topic->user->info->living_city_open=="true")
                        <div class="side-card-content-item">
                            <div class="side-card-content-item-h">
                                {{__('user.livingCity')}}
                            </div>
                            <div class="side-card-content-item-c">
                                {{$topic->user->info->living_city}}
                            </div>
                        </div>
                    @endif
                    @if($topic->user->info->engaged_in&&$topic->user->info->engaged_in_open=="true")
                        <div class="side-card-content-item">
                            <div class="side-card-content-item-h">
                                {{__('user.engagedIn')}}
                            </div>
                            <div class="side-card-content-item-c">
                                {{$topic->user->info->engaged_in}}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @include('admin.layout.msg')
    <h1 class="topic-content-primary-title">
        @if($topic->status=='hidden')
            <span class="mdui-text-color-pink">
                <i class="mdui-icon material-icons">&#xe541;</i>
            </span>
        @endif
        {{$topic->title}}
        <br>
        <small>
            <span>
            @if($topic->status=='hidden')
                <span class="mdui-text-color-pink">
                    · <i class="mdui-icon material-icons">&#xe541;</i> {{__('community.saved')}}
                </span>
            @endif
            @if($topic->order >0)
                <span class="layui-badge">{{__('community.sticky')}}</span>
            @endif
            @if($topic->is_excellent)
                <span class="layui-badge layui-bg-blue">{{__('community.excellent')}}</span>
            @endif
            @if($topic->order <0)
                <span class="layui-badge">{{__('community.sink')}}</span>
            @endif
            · <i class="mdui-icon material-icons" style="padding-bottom: 3px">&#xe2c7;</i> <a href="{{route('showCommunitySection',$topic->communitySection->id)}}">{{$topic->communitySection->name}}</a>
            · <i class="mdui-icon material-icons" style="padding-bottom: 3px">&#xe417;</i> <span class="mdui-hidden-xs">{{__('community.visitedCount')}}</span> {{$topic->view_count}}
            · <i class="mdui-icon material-icons">&#xe0b9;</i> <span class="mdui-hidden-xs">{{__('community.commentCount')}}</span> {{$topic->reply_count}}
            · <i class="mdui-icon material-icons">&#xe192;</i> <span class="mdui-hidden-xs">{{__('community.createdAt')}}</span> {{$topic->created_at->diffForHumans()}}
            </span>
        </small>
    </h1>

    <div class="topic-content-primary-text">
        <div class="photo-gallery">
            {!! $topic->content !!}
        </div>
    </div>
</div>
