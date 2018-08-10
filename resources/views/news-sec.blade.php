@extends('frame.indexframe')
@section('title',__('index.news'))
@section('subtitleUrl',route('showNews'))
@section('tabActiveVal','news-tab')
@section('bottomNavActiveVal','news-bottom-nav')

@section('content')
    <div class="mdui-row">
        {{--二级新闻页主列表--}}
        <div class="mdui-panel mdui-hidden-md-up" mdui-panel>
            <div class="mdui-panel-item news-sec-cat-panel-mobile">
                <div class="mdui-panel-item-header">
                    <div class="mdui-panel-item-title" style="width: auto">查看新闻版块</div>
                    <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <div class="mdui-panel-item-body">
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
        </div>

        <div class="mdui-col-md-9 mdui-col-xs-12" style="padding-top: 20px">
            @include('news-sec.lists')
        </div>
        {{--侧边栏，板块切换,小屏隐藏--}}
        <div class="mdui-col-md-3 mdui-hidden-sm-down" style="padding-top: 20px">
            @include('news-sec.side-clumn')
        </div>
    </div>
@endsection