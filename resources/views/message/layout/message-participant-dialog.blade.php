<div class="mdui-dialog" id="messageParticipantDialog">
    <div class="mdui-dialog-title">All Participants</div>
    <div class="mdui-dialog-content" id="messageParticipantDialogContent">
        <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
    </div>
    <div class="mdui-dialog-actions">
        <button onclick="handleRemoveParticipants('{{$thread->id}}')" class="mdui-btn mdui-ripple">
            <span id="messageParticipantDialogOK">OK</span>
            <div class="mdui-spinner mdui-spinner-colorful" style="display:none" id="messageParticipantDialogloading"></div>
        </button>
    </div>
</div>