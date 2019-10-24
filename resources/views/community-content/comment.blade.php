<a name="reply-list" id="reply-list"></a>
<div id="createComment" class="mdui-card mdui-m-t-2">
    @if(Auth::check())
        <div class="news-content-create-comment">
            <div class="title"><i class="mdui-icon material-icons">comment</i>{{__('layout.createCommentHeader')}}</div>
            <img src="{{\Auth::user()->info->avatar_url}}" class="avatar-img mdui-hoverable">
            <div class="comment-edit-area">
                <div class="editor-toolbar-container">
                    <div class="mdui-m-t-1 editor-toolbar mdui-hoverable" id="editorToolbar" type="community-reply"></div>
                </div>
                <div class="editor-middle-bar">{{__('layout.saySomething')}}</div>
                <div id="editorText" class="editor-text mdui-hoverable" ></div>
                <textarea id="editorTextArea" name="content" class="mdui-hidden"></textarea>
                <div class="mdui-progress">
                    <div class="mdui-progress-indeterminate" id="editor-progress" style="display: none"></div>
                </div>

                <a onclick="ajaxSubmitTopicCommentForm('{{route('communityTopicReplyStore',$topic->id)}}')" class="mdui-btn mdui-color-pink-400 submit-btn"><i class="mdui-icon material-icons mdui-icon-left">send</i>{{__('layout.send')}}</a>
            </div>
        </div>
    @else
        <div class="news-content-create-comment news-content-create-comment-without-login">
            <div class="title"><i class="mdui-icon material-icons">comment</i>{{__('layout.createCommentHeader')}}</div>
            <i class="mdui-icon material-icons tip-icon">&#xe811;</i>
            <div class="tip-text">
                {{__('auth.notLoggedTip')}}
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
            {!! __('layout.commentCountTip',['num'=>$topic->reply_count])!!}
        </div>
        <div class="mdui-tab part-divider-tab reply-order-tab " mdui-tab>
            <a mdui-tooltip="{content: '{{__('layout.orderByTime')}}', position: 'top'}" onclick="jumpTo('?orderBy=default#reply-list')" href="#" class="mdui-ripple">{{__('index.time')}}</a>
            <a mdui-tooltip="{content: '{{__('layout.orderByLike')}}', position: 'top'}" onclick="jumpTo('?orderBy=thumb_up#reply-list')" href="#" class="mdui-ripple @if($orderBy == 'thumb_up') mdui-tab-active @endif">{{__('layout.hot')}}</a>
        </div>
    </div>
    <div class="side-card-content" id="replies">
        @include('community-content.comment-data')
        @if(count($replies)==0)
            <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 mdui-m-t-2" style="font-size: 40px">hot_tub</i>
            <span class="loading-tip-text mdui-m-t-1 mdui-m-b-3" style="font-size: 15px">{{__('layout.beFirstComment')}}</span>
        @endif
        <div  id="TopicRepliesData"></div>
        <div id="TopicRepliesLoadingBtn" class="mdui-m-y-1" style="">
            <button onclick="ajaxLoadTopicReplies()" class="mdui-btn mdui-color-pink-a200 mdui-ripple mdui-center">
                <i class="mdui-icon material-icons mdui-icon-left">&#xe627;</i>
                {{__('layout.loadMore')}}
            </button>
        </div>
        <div id="TopicRepliesLoadingTip" class="mdui-m-y-1" style="display:none">
            <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
            <span class="loading-tip-text">{{__('layout.loadingMore')}}</span>
        </div>
        <div id="TopicRepliesLoadingFailed" class="animated fadeIn faster" style="display:none">
            <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600">mood_bad</i>
            <span class="loading-tip-text">{{__('layout.noAnyMore')}}</span>
        </div>
    </div>
</div>
