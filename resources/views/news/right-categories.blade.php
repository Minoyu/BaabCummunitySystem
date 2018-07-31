<div class="mdui-card mdui-hoverable">
    <div class="side-card-header">
        <div class="side-card-header-text mdui-center">
            新闻版块
        </div>
    </div>
    <div class="side-card-content">
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