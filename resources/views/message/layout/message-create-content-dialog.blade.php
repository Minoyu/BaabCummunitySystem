<div class="mdui-dialog" id="createMessageContentDialog">
    <div class="mdui-dialog-title" style="padding-bottom: 0">
        <a class="mdui-btn mdui-btn-dense mdui-btn-icon mdui-color-grey-100 mdui-text-color-grey-700 close" mdui-dialog-close>
            <i class="mdui-icon material-icons">close</i>
        </a>
        Create a conversation
    </div>
    <div class="mdui-dialog-content">
        <div class="mdui-textfield mdui-textfield-floating-label">
            <i class="mdui-icon material-icons">subject</i>
            <label class="mdui-textfield-label">Subject</label>
            <input class="mdui-textfield-input" type="text"/>
        </div>

        <i class="mdui-icon material-icons" style="position: absolute;left: 30px;top: 150px;opacity: .8;">chat_bubble_outline</i>
        <textarea name="desc" placeholder="Say Something..." class="layui-textarea mdui-m-t-2" style="margin-left: 45px;width: calc(100% - 45px);"></textarea>
    </div>
    <div class="mdui-dialog-actions">
        <button onclick="" class="mdui-btn mdui-ripple">
            <span id="createMessageContentDialogOK">Send</span>
            <div class="mdui-spinner mdui-spinner-colorful" style="display:none" id="createMessageContentDialogloading"></div>
        </button>
    </div>
</div>