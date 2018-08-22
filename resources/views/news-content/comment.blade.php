<div id="createComment" class="mdui-card mdui-m-t-2">
    @if(Auth::check())
        <div class="news-content-create-comment">
            <div class="title"><i class="mdui-icon material-icons">comment</i>发表你的看法</div>
                <img src="{{\Auth::user()->info->avatar_url}}" class="avatar-img mdui-hoverable">
                <div class="comment-edit-area">
                    <div class="mdui-m-t-1 editor-toolbar mdui-hoverable" id="editorToolbar" type="news-reply"></div>
                    <div class="editor-middle-bar">写点什么</div>
                    <div id="editorText" class="editor-text mdui-hoverable" ></div>
                    <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>
                    <a onclick="ajaxSubmitNewsCommentForm('{{route('newsReplyStore',$news->id)}}')" class="mdui-btn mdui-color-pink-400 submit-btn"><i class="mdui-icon material-icons mdui-icon-left">send</i>发射</a>
                </div>
        </div>
    @else
        <div class="news-content-create-comment news-content-create-comment-without-login">
            <div class="title"><i class="mdui-icon material-icons">comment</i>发表你的看法</div>
            <i class="mdui-icon material-icons tip-icon">&#xe811;</i>
            <div class="tip-text">
                对不起，你还没有登录
            </div>
            <div class="tip-action">
                <button onclick="openLoginDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-100 mdui-ripple">{{__('index.login')}}</button>
                {{__('index.or')}}
                <button onclick="openRegisterDialog()" class="mdui-btn mdui-btn-dense mdui-color-blue-grey mdui-ripple">{{__('index.register')}}</button>
            </div>
        </div>
    @endif
    <a name="reply-list" id="reply-list"></a>
    <div class="side-card-header" style="height: 40px">
        <div class="side-card-header-text">
            共有{{$news->reply_count}}条回复
        </div>
        <div class="mdui-tab part-divider-tab reply-order-tab" mdui-tab>
            <a mdui-tooltip="{content: '按最近发表排序', position: 'top'}" onclick="jumpTo('?orderBy=default#reply-list')" href="#" class="mdui-ripple">时间</a>
            <a mdui-tooltip="{content: '按赞数排序回复', position: 'top'}" onclick="jumpTo('?orderBy=thumb_up#reply-list')" href="#" class="mdui-ripple @if($orderBy == 'thumb_up') mdui-tab-active @endif">赞数</a>
        </div>

    </div>
    <div class="side-card-content">
        @include('news-content.comment-data')
        <div  id="NewsReplyData"></div>
        <div id="NewsReplyLoadingTip" class="mdui-m-y-2" style="display:none">
            <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
            <span class="loading-tip-text">正在加载更多</span>
        </div>
        <div id="NewsReplyLoadingFailed" class="animated fadeIn faster" style="display:none">
            <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
            <span class="loading-tip-text">没有更多了</span>
        </div>
    </div>
</div>
