<div class="mdui-card news-content-card" style="border-radius: 10px;padding-top: 0px">

    @if(Auth::check())
        <div class="mdui-tab part-divider-tab" mdui-tab>
            <a mdui-tooltip="{content: '{{__('discover.followingTabTip')}}', position: 'top'}" onclick="jumpTo('?view=following')" href="#" class="mdui-ripple @if($view =='following') mdui-tab-active  @endif">{{__('discover.followingTab')}}</a>
            <a mdui-tooltip="{content: '{{__('discover.allTabTip')}}', position: 'top'}" onclick="jumpTo('?view=all')" href="#" class="mdui-ripple @if($view =='all') mdui-tab-active  @endif">{{__('discover.allTab')}}</a>
            <a mdui-tooltip="{content: '{{__('discover.mineTabTip')}}', position: 'top'}" onclick="jumpTo('?view=mine')" href="#" class="mdui-ripple @if($view =='mine') mdui-tab-active  @endif">{{__('discover.mineTab')}}</a>
        </div>
        @if($dataTooLittle)
            <div class=" mdui-color-green-50 admin-error-tip">
                <div>
                    <ul>
                        {{__('discover.tooLittleActivitiesTip')}}
                    </ul>
                </div>
            </div>
        @endif
        @include('discover.left-list-data')
        @if(count($activities)==0)
            <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 mdui-m-t-2" style="font-size: 40px">directions_walk</i>
            <span class="loading-tip-text mdui-m-t-1 mdui-m-b-2" style="font-size: 15px">
                {{__('discover.noActivities')}}
                <br>{{__('discover.noActivitiesTip')}}
            </span>
        @endif
        <div  id="ActivityListData"></div>
        <div id="ActivityListLoadingTip" class="mdui-m-y-2" style="display:none">
            <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
            <span class="loading-tip-text">{{__('layout.loadingMore')}}</span>
        </div>
        <div id="ActivityListLoadingFailed" class="animated fadeIn faster" style="display:none">
            <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
            <span class="loading-tip-text">{{__('layout.noAnyMore')}}</span>
        </div>
    @else
        <div class="mdui-tab part-divider-tab" mdui-tab>
            <a mdui-tooltip="{content: '{{__('discover.allTabTip')}}', position: 'top'}" onclick="jumpTo('?view=all')" href="#" class="mdui-ripple @if($view =='all') mdui-tab-active  @endif">{{__('discover.allTab')}}</a>
            <a mdui-tooltip="{content: '{{__('discover.followingTabTip')}}', position: 'top'}" onclick="jumpTo('?view=following')" href="#" class="mdui-ripple @if($view =='following') mdui-tab-active  @endif">{{__('discover.followingTab')}}</a>
            <a mdui-tooltip="{content: '{{__('discover.mineTabTip')}}', position: 'top'}" onclick="jumpTo('?view=mine')" href="#" class="mdui-ripple @if($view =='mine') mdui-tab-active  @endif">{{__('discover.mineTab')}}</a>
        </div>
        @if($view =='all'||!$view)
            @include('discover.left-list-data')
            @if(count($activities)==0)
                <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 mdui-m-t-2" style="font-size: 40px">directions_walk</i>
                <span class="loading-tip-text mdui-m-t-1 mdui-m-b-2" style="font-size: 15px">{{__('discover.noActivities')}}</span>
            @endif
            <div  id="ActivityListData"></div>
            <div id="ActivityListLoadingTip" class="mdui-m-y-2" style="display:none">
                <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
                <span class="loading-tip-text">{{__('layout.loadingMore')}}</span>
            </div>
            <div id="ActivityListLoadingFailed" class="animated fadeIn faster" style="display:none">
                <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
                <span class="loading-tip-text">{{__('layout.noAnyMore')}}</span>
            </div>
        @else
            <div class="activity-list-not-logged mdui-valign">
                <div class="mdui-center">
                    <i class="mdui-icon material-icons tip-icon">face</i>
                    <div class="tip-text">
                        {{__('discover.notLoggedTip')}}
                    </div>
                    <div class="tip-action">
                        <button onclick="openLoginDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-100 mdui-ripple">{{__('index.login')}}</button>
                        {{__('index.or')}}
                        <button onclick="openRegisterDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-grey mdui-ripple">{{__('index.register')}}</button>
                    </div>
                </div>

            </div>
        @endif
    @endif
</div>
