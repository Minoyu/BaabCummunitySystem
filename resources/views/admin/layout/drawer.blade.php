<div class="mdui-drawer drawer-padding-top" id="admin-drawer">
    <ul class="mdui-list drawer-menu mdui-color-white" id="adminDrawerMenu">

        <li class="mdui-collapse-item mdui-collapse-item-open" id="drawer-newsItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon ion-md-paper mdui-text-color-blue"></i>
                <div class="mdui-list-item-content">新闻管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsList')}}">
                    <li class="mdui-list-item mdui-ripple">新闻列表</li>
                </a>
                <a href="{{route('adminNewsCreate')}}">
                    <li class="mdui-list-item mdui-ripple">创建新闻</li>
                </a>
            </ul>
        </li>

        <li class="mdui-collapse-item" id="drawer-newsCategoryItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon ion-md-paper mdui-text-color-blue"></i>
                <div class="mdui-list-item-content">新闻分类管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsCategoriesList')}}">
                    <li class="mdui-list-item mdui-ripple">新闻分类列表</li>
                </a>
                <a href="{{route('adminNewsCategoriesCreate')}}">
                    <li class="mdui-list-item mdui-ripple">创建新闻分类</li>
                </a>

            </ul>
        </li>

        <li class="mdui-collapse-item" id="drawer-newsReplyItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon ion-md-paper mdui-text-color-blue"></i>
                <div class="mdui-list-item-content">新闻回复管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsList')}}">
                    <li class="mdui-list-item mdui-ripple">检索回复-按新闻列表</li>
                </a>
                <a href="{{route('adminNewsReplyAllList')}}">
                    <li class="mdui-list-item mdui-ripple">全站新闻回复列表</li>
                </a>
            </ul>
        </li>
        <li class="mdui-collapse-item" id="drawer-newsOtherItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon ion-md-paper mdui-text-color-blue"></i>
                <div class="mdui-list-item-content">新闻综合设置</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsCarouselsList')}}">
                    <li class="mdui-list-item mdui-ripple">新闻中心轮播图</li>
                </a>
            </ul>
        </li>

        <div class="mdui-divider"></div>
        <li class="mdui-collapse-item" id="drawer-communityCategoryItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe6dd;</i>
                <div class="mdui-list-item-content">社区分区管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminCommunityZonesAndSectionsShow')}}">
                    <li class="mdui-list-item mdui-ripple">分区及板块列表</li>
                </a>
                <a href="{{route('adminCommunityZoneCreate')}}">
                    <li class="mdui-list-item mdui-ripple">创建新分区</li>
                </a>
                <a href="{{route('adminCommunitySectionCreate')}}">
                    <li class="mdui-list-item mdui-ripple">创建新板块</li>
                </a>
            </ul>
        </li>
        <li class="mdui-collapse-item" id="drawer-communityTopicItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe6dd;</i>
                <div class="mdui-list-item-content">社区话题管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminCommunityTopicListByCategory')}}">
                    <li class="mdui-list-item mdui-ripple">检索话题-按分区</li>
                </a>
                <a href="{{route('adminCommunityTopicList')}}">
                    <li class="mdui-list-item mdui-ripple">全站话题列表</li>
                </a>
                <a href="{{route('adminCommunityTopicCreate')}}">
                    <li class="mdui-list-item mdui-ripple">创建新话题</li>
                </a>
            </ul>
        </li>
        <li class="mdui-collapse-item" id="drawer-communityTopicItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe6dd;</i>
                <div class="mdui-list-item-content">话题回复管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminCommunityTopicListByCategory')}}">
                    <li class="mdui-list-item mdui-ripple">检索话题回复-按分区</li>
                </a>
                <a href="{{route('adminCommunityTopicList')}}">
                    <li class="mdui-list-item mdui-ripple">检索话题回复-按话题</li>
                </a>
                <a href="{{route('adminCommunityTopicReplyAllList')}}">
                    <li class="mdui-list-item mdui-ripple">全站话题回复列表</li>
                </a>
            </ul>
        </li>

        <div class="mdui-divider"></div>

        <li class="mdui-collapse-item" id="drawer-userItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-brown">account_circle</i>
                <div class="mdui-list-item-content">用户及权限管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminShowUsersList')}}">
                    <li class="mdui-list-item mdui-ripple">用户列表</li>
                </a>
                <a href="{{route('adminShowPermissionsList')}}">
                    <li class="mdui-list-item mdui-ripple">权限列表</li>
                </a>
                <a href="{{route('adminCommunityTopicList')}}">
                    <li class="mdui-list-item mdui-ripple">检索话题回复-按话题</li>
                </a>
                <a href="{{route('adminCommunityTopicReplyAllList')}}">
                    <li class="mdui-list-item mdui-ripple">全站话题回复列表</li>
                </a>
            </ul>
        </li>

        <div class="mdui-divider"></div>

        <li class="mdui-collapse-item" id="drawer-indexItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">home</i>
                <div class="mdui-list-item-content">首页设置</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminIndexCarouselsList')}}">
                    <li class="mdui-list-item mdui-ripple">首页轮播图</li>
                </a>
            </ul>
        </li>
        <div class="mdui-divider"></div>

        <a href="{{route('switchLang')}}">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-cyan">translate</i>
                <div class="mdui-list-item-content">{{__('index.switchLang')}}</div>
            </li>
        </a>


    </ul>
</div>