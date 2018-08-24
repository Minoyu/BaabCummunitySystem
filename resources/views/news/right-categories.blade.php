<div class="mdui-card mdui-hoverable side-card mdui-m-t-2">
    <div class="side-card-header">
        <div class="side-card-header-text mdui-center">
            新闻版块
        </div>
    </div>
    <div class="side-card-content">
        <ul class="mdui-list">
            @foreach($newsCategories as $newsCategory)
                <a href="{{route('showNewsSec',$newsCategory->id)}}">
                    <li class="mdui-list-item mdui-ripple @if(isset($cat)&&$cat->id == $newsCategory->id) mdui-list-item-active @endif ">
                        <i class="mdui-list-item-icon mdui-icon material-icons">{{$newsCategory->icon}}</i>
                        <div class="mdui-list-item-content">{{$newsCategory->name}}</div>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
</div>