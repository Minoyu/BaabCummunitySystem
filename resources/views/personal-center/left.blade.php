
<div class="mdui-panel mdui-panel-gapless mdui-hidden-sm-up mdui-m-b-1" mdui-panel>
    <div class="mdui-panel-item">
        <div class="mdui-panel-item-header">
            <div class="mdui-panel-item-title" style="width: auto">查看个人资料</div>
            <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
        </div>
        <div class="mdui-panel-item-body">
            <div class="side-card-content">
                @if($user->info->sex&&$user->info->sex_open)
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">性别</div>
                        @if($user->info->sex)
                            <div class="side-card-content-item-c"><i class="mdui-icon ion-md-male mdui-text-color-blue"></i></div>
                        @else
                            <div class="side-card-content-item-c"><i class="mdui-icon ion-md-female mdui-text-color-red"></i></div>
                        @endif
                    </div>
                @endif

                <div class="side-card-content-item">
                    <div class="side-card-content-item-h">
                        一句话介绍
                    </div>
                    <div class="side-card-content-item-c">
                        @if($user->info->motto)
                            {{$user->info->motto}}
                        @else
                            此用户还未添加一句话介绍
                        @endif
                    </div>
                </div>
                @if($user->info->wechat&&$user->info->wechat_open)
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            微信号
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->wechat}}
                        </div>
                    </div>
                @endif
                @if($user->info->nation&&$user->info->nation_open)
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            国家
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->nation}}
                        </div>
                    </div>
                @endif
                @if($user->info->living_city&&$user->info->living_city_open)
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            现居城市
                        </div>
                        <div class="side-card-content-item-c">
                            {{$user->info->living_city}}
                        </div>
                    </div>
                @endif
                @if($user->info->engaged_in&&$user->info->engaged_in_open)
                    <div class="side-card-content-item">
                        <div class="side-card-content-item-h">
                            职业/从事行业
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
<div class="mdui-card mdui-hidden-sm-up">
    <div class="right-focus-info">
        <a class="mdui-btn right-focus-info-item">
            <div class="right-focus-info-item-inner">
                <div class="right-focus-info-item-name">关注了</div>
                <strong class="right-focus-info-item-value">51</strong>
            </div>
        </a>
        <a class="mdui-btn right-focus-info-item">
            <div class="right-focus-info-item-inner">
                <div class="right-focus-info-item-name">关注者</div>
                <strong class="right-focus-info-item-value">51</strong>
            </div>
        </a>
    </div>
</div>
<div class="mdui-card">
    <div class="mdui-tab" mdui-tab>
        <a href="#example1-tab1" class="mdui-ripple">动态</a>
        <a href="#example1-tab2" class="mdui-ripple">帖子</a>
        <a href="#example1-tab3" class="mdui-ripple">回复</a>
    </div>
    <div id="example1-tab1" class="mdui-p-a-2">web content</div>
    <div id="example1-tab2" class="mdui-p-a-2">shopping content</div>
    <div id="example1-tab3" class="mdui-p-a-2">images content</div>
</div>