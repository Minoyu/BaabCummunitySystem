<div class="mdui-panel mdui-hidden-md-up" mdui-panel>
    <div class="mdui-panel-item">
        <div class="mdui-panel-item-header">
            <div class="mdui-panel-item-title" style="width: auto">新闻版块</div>
            <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
        </div>
        <div class="mdui-panel-item-body">
            <ul class="mdui-list">
                @foreach($newsCategories as $newsCategory)
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">{{$newsCategory->icon}}</i>
                        <div class="mdui-list-item-content">{{$newsCategory->name}}</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="mdui-card mdui-m-y-2">
    <a href="#">
        <div class="news-list-item mdui-hoverable">
            <img class="news-list-item-img" src="http://via.placeholder.com/150x150">
            <div class="news-list-item-title mdui-text-color-indigo">测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻测试新闻</div>
            <a href="#" class="news-list-item-part-name">测试板块</a>
        </div>
    </a>
    <a href="#">
        <div class="news-list-item mdui-hoverable">
            <img class="news-list-item-img" src="http://via.placeholder.com/150x150">
            <div class="news-list-item-title mdui-text-color-indigo">新闻测试新闻测试新闻测试新闻测试新闻</div>
            <a href="#" class="news-list-item-part-name">测试板块</a>
        </div>
    </a>
    <a href="#">
        <div class="news-list-item-without-img mdui-hoverable">
            <div class="news-list-item-title mdui-text-color-indigo">无图新闻测试新闻测试新闻测试新闻测试新闻</div>
            <div class="news-list-item-content mdui-hidden-xs">测试新闻内容简略测试新闻内容简略</div>
            <a href="#1" class="news-list-item-part-name">测试板块</a>

        </div>
    </a>
    <a href="#">
        <div class="news-list-item-without-img mdui-hoverable">
            <div class="news-list-item-title mdui-text-color-indigo">无图新闻测试新闻测试新闻测试新闻测试新闻</div>
            <div class="news-list-item-content mdui-hidden-xs">测试新闻内容简略测试新闻内容简略</div>
            <a href="#" class="news-list-item-part-name">测试板块</a>

        </div>
    </a>
</div>