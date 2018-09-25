@extends('message.layout.notifyframe-mini')
@section('right-content')
    <h2 class="mdui-m-t-1">
        <a href="{{route('messages')}}" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-text-color-grey-600">
            <i class="mdui-icon material-icons">chevron_left</i>
        </a>
        <i class="mdui-icon material-icons">chat</i> {{ $thread->subject }}</h2>
    <ul class="message-bubble-list" style="margin-bottom: 65px;max-height: 200px;overflow: scroll;">
        @each('message.layout.message-bubble', $messages_collection, 'messages')
    </ul>

    <div class="message-content-form-div">
        <div class="message-content-form">
            <button type="a" class="mdui-btn mdui-btn-icon message-content-form-textarea-btn">
                <i class="mdui-icon material-icons">add_circle_outline</i>
            </button>
            <div contenteditable="true" id="messageContent" class="message-content-form-textarea" ></div>
            <a id="messageSend" class="mdui-btn mdui-btn-icon message-content-form-submit-btn">
                <i class="mdui-icon material-icons">send</i>
            </a>
        </div>
    </div>
@endsection
