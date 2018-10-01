<div class="mdui-dialog" id="addParticipantDialog">
    <div class="mdui-dialog-title">Add Participants
    <br>
        <small style="opacity: .6">
            From my followings
        </small>
    </div>
    <div class="mdui-dialog-content" id="addParticipantDialogContent">
        <div class="mdui-spinner mdui-spinner-colorful mdui-center"></div>
    </div>
    <div class="mdui-dialog-actions">
        <button onclick="handleAddParticipants('{{$thread->id}}')" class="mdui-btn mdui-ripple">
            <span id="addParticipantDialogOK">OK</span>
            <div class="mdui-spinner mdui-spinner-colorful" style="display:none" id="addParticipantDialogloading"></div>
        </button>
    </div>
</div>