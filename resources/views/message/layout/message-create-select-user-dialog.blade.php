<div class="mdui-dialog" id="createMessageSelectReceiversDialog">
    <div class="mdui-dialog-title" style="padding-bottom: 0">
        <a class="mdui-btn mdui-btn-dense mdui-btn-icon mdui-color-grey-100 mdui-text-color-grey-700 close" mdui-dialog-close>
            <i class="mdui-icon material-icons">close</i>
        </a>
        Create a conversation
        <br>
        <small style="opacity: .6">
            Select Receivers from My Followings
        </small>
    </div>
    <div class="mdui-dialog-content" id="createMessageSelectReceiversDialogContent">
        <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
    </div>
    <div class="mdui-dialog-actions">
        <button onclick="handleSelectedReceiversToSendMessage()" class="mdui-btn mdui-ripple">
            <span>{{__('index.next')}}</span>
        </button>
    </div>
</div>