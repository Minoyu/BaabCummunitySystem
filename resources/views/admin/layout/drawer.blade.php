<div class="mdui-drawer drawer-padding-top" id="admin-drawer">
    <ul class="mdui-list drawer-menu mdui-color-white" id="adminDrawerMenu">

        <li class="mdui-collapse-item mdui-collapse-item-open" id="drawer-newsItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon ion-md-paper mdui-text-color-blue"></i>
                <div class="mdui-list-item-content">{{__('admin.newsManage')}}</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.newsList')}}</li>
                </a>
                <a href="{{route('adminNewsCreate')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.createNews')}}</li>
                </a>
            </ul>
        </li>

        <li class="mdui-collapse-item" id="drawer-newsCategoryItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon ion-md-paper mdui-text-color-blue"></i>
                <div class="mdui-list-item-content">{{__('admin.newsCatManage')}}</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsCategoriesList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.newsCatList')}}</li>
                </a>
                <a href="{{route('adminNewsCategoriesCreate')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.createNewsCat')}}</li>
                </a>

            </ul>
        </li>

        <li class="mdui-collapse-item" id="drawer-newsReplyItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon ion-md-paper mdui-text-color-blue"></i>
                <div class="mdui-list-item-content">{{__('admin.newsReplyManage')}}</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.findReplyByNews')}}</li>
                </a>
                <a href="{{route('adminNewsReplyAllList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.newsReplyList')}}</li>
                </a>
            </ul>
        </li>
        <li class="mdui-collapse-item" id="drawer-newsOtherItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon ion-md-paper mdui-text-color-blue"></i>
                <div class="mdui-list-item-content">{{__('admin.newsComplexSettings')}}</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminNewsCarouselsList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.newsCenterCarousel')}}</li>
                </a>
            </ul>
        </li>

        <div class="mdui-divider"></div>
        <li class="mdui-collapse-item" id="drawer-communityCategoryItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe6dd;</i>
                <div class="mdui-list-item-content">{{__('admin.communityCatManage')}}</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminCommunityZonesAndSectionsShow')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.communityCatList')}}</li>
                </a>
                <a href="{{route('adminCommunityZoneCreate')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.createZones')}}</li>
                </a>
                <a href="{{route('adminCommunitySectionCreate')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.createSections')}}</li>
                </a>
            </ul>
        </li>
        <li class="mdui-collapse-item" id="drawer-communityTopicItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe6dd;</i>
                <div class="mdui-list-item-content">{{__('admin.communityTopicsManage')}}</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminCommunityTopicList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.communityTopicsList')}}</li>
                </a>
                <a href="{{route('adminCommunityTopicListByCategory')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.findTopicsBySections')}}</li>
                </a>
                <a href="{{route('adminCommunityTopicCreate')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.createTopics')}}</li>
                </a>
            </ul>
        </li>
        <li class="mdui-collapse-item" id="drawer-communityTopicReplyItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe6dd;</i>
                <div class="mdui-list-item-content">{{__('admin.topicRepliesManage')}}</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminCommunityTopicReplyAllList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.topicRepliesList')}}</li>
                </a>
                <a href="{{route('adminCommunityTopicListByCategory')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.findRepliesBySections')}}</li>
                </a>
                <a href="{{route('adminCommunityTopicList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.findRepliesByTopics')}}</li>
                </a>
            </ul>
        </li>

        <div class="mdui-divider"></div>

        <li class="mdui-collapse-item" id="drawer-indexItem">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">home</i>
                <div class="mdui-list-item-content">{{__('admin.indexSettings')}}</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="{{route('adminIndexCarouselsList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.indexCarousels')}}</li>
                </a>
                <a href="{{route('adminIndexHeadlinesList')}}">
                    <li class="mdui-list-item mdui-ripple">{{__('admin.indexHeadlines')}}</li>
                </a>
            </ul>
        </li>


        @role('Founder')
            <div class="mdui-divider"></div>

            <li class="mdui-collapse-item" id="drawer-userItem">
                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-brown">account_circle</i>
                    <div class="mdui-list-item-content">{{__('admin.usersAndPermissionsManage')}}</div>
                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                    <a href="{{route('adminShowUsersList')}}">
                        <li class="mdui-list-item mdui-ripple">{{__('admin.usersList')}}</li>
                    </a>
                    <a href="{{route('adminShowRolesList')}}">
                        <li class="mdui-list-item mdui-ripple">{{__('admin.rolesList')}}</li>
                    </a>
                    <a href="{{route('adminShowPermissionsList')}}">
                        <li class="mdui-list-item mdui-ripple">{{__('admin.permissionsList')}}</li>
                    </a>
                </ul>
            </li>
        @endrole

        <div class="mdui-divider"></div>

        <a target="_blank" href="{{route('showIndex')}}">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue-grey">exit_to_app</i>
                <div class="mdui-list-item-content">{{__('admin.backToFront')}}</div>
            </li>
        </a>
        <a href="{{route('switchLang')}}">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-cyan">translate</i>
                <div class="mdui-list-item-content">{{__('index.switchLang')}}</div>
            </li>
        </a>


    </ul>
</div>