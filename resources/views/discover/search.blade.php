<!--搜索-->
<span class="search-input mdui-center">
    <input placeholder="搜索话题、新闻及用户" class="search-input-field search-input-field" style="position: relative" type="text" id="search" />
    <button class="mdui-btn mdui-btn-icon mdui-color-red-accent mdui-ripple search-input-button" ><i class="mdui-icon material-icons">search</i></button>
    <label class="search-input-label search-input-label" for="search">
        {{--<span id="searchLabel" class="search-input-label-content search-input-label-content">搜索话题、新闻及用户</span><br/>--}}


        <ul class="mdui-menu mdui-menu-cascade" id="searchTips">
            <div class="mdui-progress searchTipsAjaxProgress" style="margin-top: -16px;margin-bottom: 10px"></div>
            <div id="searchTipsContent">
                <li class="mdui-menu-item search-tips search-tips-null">
                    <a class="mdui-ripple mdui-text-color-grey">
                        : ) 目前 您可以尝试输入您所想要查找的
                    </a>
                </li>
                <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
                    <a class="mdui-ripple mdui-text-color-grey">
                        <i class="mdui-icon material-icons">assignment</i> 方案
                    </a>
                </li>
                <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
                    <a class="mdui-ripple mdui-text-color-grey">
                        <i class="mdui-icon material-icons">view_list</i> 应用领域及方案分类
                    </a>
                </li>
                <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
                    <a class="mdui-ripple mdui-text-color-grey">
                        <i class="mdui-icon material-icons">bubble_chart</i> 应用产品
                    </a>
                </li>
                <li class="mdui-menu-item search-tips search-tips-null" style="margin-left: 20px">
                    <a class="mdui-ripple mdui-text-color-grey">
                        <i class="mdui-icon material-icons">business</i> 厂商
                    </a>
                </li>
            </div>
        </ul>
    </label>
</span>
