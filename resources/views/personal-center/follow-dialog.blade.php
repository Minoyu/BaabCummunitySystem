<div class="mdui-dialog follow-dialog" id="follow-dialog" style="border-radius: 10px;min-height: 300px">
    <div class="mdui-dialog-title mdui-color-theme dialog-bg">
        <a class="mdui-btn mdui-btn-icon mdui-text-color-white close mdui-ripple" mdui-dialog-close>
            <i class="mdui-icon material-icons">&#xe5cb;</i>
        </a>
        <span class="mdui-text-color-white" id="FollowDialogTitle"></span>
    </div>
    <div class="mdui-dialog-content">
        <ul class="mdui-list" id="FollowDialogData"></ul>
        <div id="FollowDialogLoadingTip" class="mdui-m-y-5" style="display:none;font-size: 18px">
            <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
            <span class="loading-tip-text">正在加载</span>
        </div>
        <div id="FollowDialogLoadingFailed" class="mdui-m-y-5 animated fadeIn faster" style="display:none;">
            <i class="mdui-icon material-icons mdui-center mdui-text-color-grey-600 loading-tip-icon" >mood_bad</i>
            <span class="loading-tip-text" id="FollowDialogLoadingFailedText"></span>
        </div>
    </div>
</div>