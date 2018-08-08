<div class="mdui-card mdui-m-t-2">
    @if(Auth::check())
        <div class="news-content-create-comment">
            <div class="title"><i class="mdui-icon material-icons">comment</i>发表你的看法</div>
                <img src="{{\Auth::user()->info->avatar_url}}" class="avatar-img mdui-hoverable">
                <div class="comment-edit-area">
                    <div class="mdui-m-t-1 editor-toolbar mdui-hoverable" id="editorToolbar" type="news-reply"></div>
                    <div class="editor-middle-bar">写点什么</div>
                    <div contenteditable="true" id="editorText" class="editor-text mdui-hoverable" ></div>
                    <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>
                    <button class="mdui-btn mdui-color-pink-400 submit-btn"><i class="mdui-icon material-icons mdui-icon-left">send</i>发射</button>
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
    <div class="side-card-header" style="height: 40px">
        <div class="side-card-header-text">
            共有{{$news->reply_count}}条回复
        </div>
    </div>
    <div class="side-card-content">
        <div class="news-content-comment-list">
            <a href="#"><img src="http://via.placeholder.com/75x75" alt="users" class="news-content-comment-users-img mdui-hoverable"></a>
            <a href="#" class="news-content-comment-username">ss</a>
            {{--<a href="#" class="news-content-comment-dianzan-btn"><i class="mdui-icon material-icons">thumb_up</i></a>--}}
            <div class="news-content-comment-time" ><i class="mdui-icon material-icons">&#xe192;</i> time</div>
            <p class="news-content-comment-p">评论内容评论内容评论内容评容评论内容评论内容论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容</p>
            <a href="#" class="mdui-btn mdui-btn-dense news-content-comment-reply-btn" ><i class="mdui-icon material-icons mdui-icon-left ">comment</i>回复</a>

        </div>
        <li class="mdui-divider-inset mdui-m-y-0" style="margin-left: 80px"></li>
        <div class="news-content-comment-list">
            <a href="#"><img src="http://via.placeholder.com/75x75" alt="users" class="news-content-comment-users-img mdui-hoverable"></a>
            <a href="#" class="news-content-comment-username">ss</a>
            {{--<a href="#" class="news-content-comment-dianzan-btn"><i class="mdui-icon material-icons">thumb_up</i></a>--}}
            {{--<a href="#" class="news-content-comment-reply-btn" ><i class="mdui-icon material-icons ">comment</i>回复</a>--}}
            <p class="news-content-comment-p">评论内容评论内容评论内容评容评论内容评论内容论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容</p>
            <a href="#" class="mdui-btn mdui-btn-dense news-content-comment-reply-btn" ><i class="mdui-icon material-icons mdui-icon-left ">comment</i>回复</a>

        </div>
        <li class="mdui-divider-inset mdui-m-y-0" style="margin-left: 80px"></li>
        <div class="news-content-comment-list">
            <a href="#"><img src="http://via.placeholder.com/75x75" alt="users" class="news-content-comment-users-img mdui-hoverable"></a>
            <a href="#" class="news-content-comment-username">ss</a>
            {{--<a href="#" class="news-content-comment-dianzan-btn"><i class="mdui-icon material-icons">thumb_up</i></a>--}}
            {{--<a href="#" class="news-content-comment-reply-btn" ><i class="mdui-icon material-icons ">comment</i>回复</a>--}}
            <p class="news-content-comment-p">评论内容评论内容评论内容评容评论内容评论内容论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容评论内容</p>
            <a href="#" class="mdui-btn mdui-btn-dense news-content-comment-reply-btn" ><i class="mdui-icon material-icons mdui-icon-left ">comment</i>回复</a>

        </div>
    </div>
</div>
