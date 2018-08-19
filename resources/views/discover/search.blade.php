<!--搜索-->
<span class="search-input mdui-center">
    <input id="search" autocomplete="off" placeholder="搜索话题、新闻及用户" class="search-input-field search-input-field" style="position: relative" type="text" />
    <button class="mdui-btn mdui-btn-icon mdui-color-red-accent mdui-ripple search-input-button" ><i class="mdui-icon material-icons">search</i></button>

    <label class="search-input-label search-input-label" for="search">
        {{--<span id="searchLabel" class="search-input-label-content">搜索话题、新闻及用户</span>--}}
    </label>
    <ul class="mdui-menu mdui-menu-cascade" id="searchTips">
        <div class="mdui-progress searchTipsAjaxProgress" style="margin-top: -16px;margin-bottom: 10px"></div>
        @include('discover.search-tips-list')
    </ul>
</span>
