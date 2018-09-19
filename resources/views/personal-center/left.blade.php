
<div class="mdui-panel mdui-panel-gapless mdui-hidden-md-up mdui-m-b-2" mdui-panel>
    <div class="mdui-panel-item">
        <div class="mdui-panel-item-header">
            <div class="mdui-panel-item-title" style="width: auto">{{__('user.viewPersonalInfo')}}</div>
            <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
        </div>
        <div class="mdui-panel-item-body">
            <div class="side-card-content">
                @if($user->info->sex&&$user->info->sex_open=="true")
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">{{__('user.sex')}}</div>
                        @if($user->info->sex)
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
                        @if($user->info->motto)
                            {{$user->info->motto}}
                        @else
                            {{__('user.noMotto')}}
                        @endif
                    </div>
                </div>
                @if($user->info->wechat&&$user->info->wechat_open=="true")
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            {{__('user.wechatId')}}
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->wechat}}
                        </div>
                    </div>
                @endif
                @if($user->info->nation&&$user->info->nation_open=="true")
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            {{__('user.nation')}}
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->nation}}
                        </div>
                    </div>
                @endif
                @if($user->info->living_city&&$user->info->living_city_open=="true")
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            {{__('user.livingCity')}}
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->living_city}}
                        </div>
                    </div>
                @endif
                @if($user->info->engaged_in&&$user->info->engaged_in_open=="true")
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            {{__('user.engagedIn')}}
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->engaged_in}}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@include('admin.layout.msg')
@if($userIsMe && $user->info->help_tip_open)
    @include('personal-center.help-update-info')
@endif
<div class="mdui-card mdui-hidden-md-up">
    <div class="right-focus-info">
        <a onclick="handleShowFollowingsDialog('{{route('userGetFollowings')}}','{{$user->id}}')" class="mdui-btn right-focus-info-item">
            <div class="right-focus-info-item-inner">
                <div class="right-focus-info-item-name">{{__('user.following')}}</div>
                <strong class="right-focus-info-item-value">{{$followingsCount}}</strong>
            </div>
        </a>
        <a onclick="handleShowFollowersDialog('{{route('userGetFollowers')}}','{{$user->id}}')" class="mdui-btn right-focus-info-item">
            <div class="right-focus-info-item-inner">
                <div class="right-focus-info-item-name">{{__('user.followers')}}</div>
                <strong class="right-focus-info-item-value pc-followerCount">{{$followersCount}}</strong>
            </div>
        </a>
    </div>
</div>
<a name="left-list" id="left-list"></a>
<div class="mdui-card">
    <div class="mdui-tab part-divider-tab" mdui-tab>
        <a mdui-tooltip="{content: '{{__('user.activitiesTip')}}', position: 'top'}" onclick="jumpTo('?view=activities#left-list')" href="#" class="mdui-ripple @if($view =='activities') mdui-tab-active  @endif">{{__('user.activities')}}</a>
        <a mdui-tooltip="{content: '{{__('user.topicsTip')}}', position: 'top'}" onclick="jumpTo('?view=topics#left-list')" href="#" class="mdui-ripple @if($view =='topics') mdui-tab-active  @endif">{{__('community.topics')}}</a>
        <a mdui-tooltip="{content: '{{__('user.commentsTip')}}', position: 'top'}" onclick="jumpTo('?view=replies#left-list')" href="#" class="mdui-ripple @if($view =='replies') mdui-tab-active  @endif">{{__('user.comments')}}</a>
        <a mdui-tooltip="{content: '{{__('user.likedTip')}}', position: 'top'}" onclick="jumpTo('?view=voted#left-list')" href="#" class="mdui-ripple @if($view =='voted') mdui-tab-active  @endif">{{__('user.liked')}}</a>
    </div>
    @switch($view)
        @case('topics')
            <div class="community-topic-list">
                @include('personal-center.left-topic-data')
                @if(count($topics)==0)
                    <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 mdui-m-t-2" style="font-size: 40px">bubble_chart</i>
                    <span class="loading-tip-text mdui-m-t-1 mdui-m-b-3" style="font-size: 15px">
                        @if($userIsMe)
                            {{__('user.emptyTopicsMe')}}<br>
                            <a href="{{route('communityTopicCreate')}}" class="mdui-btn mdui-text-color-pink-accent">
                                <i class="mdui-icon material-icons mdui-icon-left">&#xe145;</i>
                                {{__('community.createTopics')}}
                            </a>
                        @else
                            {{__('user.emptyTopics')}}
                        @endif
                    </span>
                @endif
                <div  id="PersonalCenterListData"></div>
            </div>
        @break
        @case('replies')
            <div class="community-topic-list">
                @include('personal-center.left-reply-data')
                @if(count($replies)==0)
                    <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 mdui-m-t-2" style="font-size: 40px">chat_bubble_outline</i>
                    <span class="loading-tip-text mdui-m-t-1 mdui-m-b-3" style="font-size: 15px">
                        @if($userIsMe)
                            {{__('user.emptyCommentsMe')}}
                        @else
                            {{__('user.emptyComments')}}
                        @endif
                    </span>
                @endif
                <div  id="PersonalCenterListData"></div>
            </div>
        @break
        @case('voted')
            <div class="community-topic-list">
                @include('personal-center.left-voted-data')
                @if(count($votes)==0)
                    <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 mdui-m-t-2" style="font-size: 40px">thumb_up</i>
                    <span class="loading-tip-text mdui-m-t-1 mdui-m-b-3" style="font-size: 15px">
                        @if($userIsMe)
                            {{__('user.emptyLikedMe')}}
                        @else
                            {{__('user.emptyLiked')}}
                        @endif
                    </span>
                @endif
                <div id="PersonalCenterListData"></div>
            </div>
        @break
        @default
            @include('personal-center.left-activity-data')
            @if(count($activities)==0)
                <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 mdui-m-t-2" style="font-size: 40px">hot_tub</i>
                <span class="loading-tip-text mdui-m-t-1 mdui-m-b-3" style="font-size: 15px">
                        @if($userIsMe)
                        {{__('user.emptyActivitiesMe')}}
                    @else
                        {{__('user.emptyActivities')}}
                    @endif
                </span>
            @endif
            <div  id="PersonalCenterListData"></div>
    @endswitch

    <div id="PersonalCenterListLoadingTip" class="mdui-m-y-2" style="display:none">
        <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
        <span class="loading-tip-text">{{__('layout.loadingMore')}}</span>
    </div>
    <div id="PersonalCenterListLoadingFailed" class="animated fadeIn faster" style="display:none">
        <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
        <span class="loading-tip-text">{{__('layout.noAnyMore')}}</span>
    </div>


</div>