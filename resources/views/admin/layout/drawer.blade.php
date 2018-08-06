<div class="mdui-drawer drawer-padding-top" id="admin-drawer">
    <ul class="mdui-list drawer-menu mdui-color-white" id="adminDrawerMenu">

        <li class="mdui-collapse-item mdui-collapse-item-open" id="drawer-newsItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">settings</i>
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
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">settings</i>
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
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">settings</i>
                <div class="mdui-list-item-content">新闻回复管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsReplyAllList')}}">
                    <li class="mdui-list-item mdui-ripple">全站回复列表</li>
                </a>
                <a href="{{route('adminNewsList')}}">
                    <li class="mdui-list-item mdui-ripple">新闻列表检索</li>
                </a>
            </ul>
        </li>
        <div class="mdui-divider"></div>
        <li class="mdui-collapse-item" id="drawer-communityCategoryItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">settings</i>
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
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">settings</i>
                <div class="mdui-list-item-content">话题及回复管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminCommunityTopicListByCategory')}}">
                    <li class="mdui-list-item mdui-ripple">按分区检索话题</li>
                </a>
                <a href="{{route('adminCommunityTopicList')}}">
                    <li class="mdui-list-item mdui-ripple">全站话题列表</li>
                </a>
                <a href="{{route('adminCommunityTopicCreate')}}">
                    <li class="mdui-list-item mdui-ripple">创建新话题</li>
                </a>
                <a href="{{route('adminCommunityTopicReplyAllList')}}">
                    <li class="mdui-list-item mdui-ripple">全站话题回复列表</li>
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