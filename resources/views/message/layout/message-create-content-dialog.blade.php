<div class="mdui-dialog" id="createMessageContentDialog">
    <div class="mdui-dialog-title" style="padding-bottom: 0">
        <a class="mdui-btn mdui-btn-dense mdui-btn-icon mdui-color-grey-100 mdui-text-color-grey-700 close" mdui-dialog-close>
            <i class="mdui-icon material-icons">close</i>
        </a>
        Create a conversation
    </div>
    <div id="createMessagePage">
        <div class="mdui-dialog-content mdui-p-t-0">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <i class="mdui-icon material-icons">subject</i>
                <label class="mdui-textfield-label">Subject</label>
                <input class="mdui-textfield-input" name="createMessageSubject" type="text" required/>
                <div class="mdui-textfield-error" id="createMessageSubjectError">Subject can't be empty</div>
            </div>

            <i class="mdui-icon material-icons" style="position: absolute;left: 30px;top: 175px;opacity: .8;">chat_bubble_outline</i>
            <textarea name="createMessageContent" placeholder="Say Something..." class="layui-textarea mdui-m-t-2" style="margin-left: 45px;width: calc(100% - 45px);"></textarea>
        </div>
        <div class="mdui-dialog-actions">
            <button id="createMessageContentDialogBtn" class="mdui-btn mdui-ripple">
                <span id="createMessageContentDialogSend">Send</span>
                <div class="mdui-spinner mdui-spinner-colorful" style="display:none" id="createMessageContentDialogloading"></div>
            </button>
        </div>
    </div>
    <div id="createMessageSuccess" class="success mdui-m-b-5" style="display: none">
        <div class="mdui-center">
            <i class="mdui-icon material-icons mdui-text-color-blue mdui-center icon" style="font-size: 90px" id="messageSendSuccessIcon">send</i>
            <h3 class="mdui-center mdui-m-t-2">{{__('message.sendSuccess')}}</h3>
            <div class="btns">
                <button type="button" onclick="window.location.href=GetUrlRelativePath()" class="mdui-btn mdui-btn-dense mdui-btn-raised mdui-ripple">{{__('index.back')}}</button>
                <a href="{{route('messages')}}" class="mdui-btn mdui-btn-dense mdui-btn-raised mdui-ripple mdui-color-pink-400 mdui-m-l-2">{{__('message.notificationCenter')}}</a>
            </div>
        </div>
    </div>
</div>