@extends('message.layout.notifyframe-mini')
@section('right-content')
    <h2 class="mdui-m-t-1" style="border-radius: 8px">
        <a href="{{route('messages')}}" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-text-color-grey-600">
            <i class="mdui-icon material-icons">chevron_left</i>
        </a>
        <i class="mdui-icon material-icons">chat</i> {{ $thread->subject }}
    </h2>
        <ul id="messageContentList" class="message-bubble-list" style="margin-bottom: 65px;height: 410px;overflow-y: scroll;overflow-x: hidden;">
            @if($messageTooMuch)
                <button onclick="jumpTo('{{route('messages.show.history',$thread->id)}}')" class="mdui-btn mdui-btn-dense mdui-center mdui-color-grey-200" style="border-radius: 16px;">
                    <i class="mdui-icon material-icons mdui-icon-left">history</i>
                    {{__('layout.loadMore')}}
                </button>
            @endif
            @include('message.layout.message-bubble')
        </ul>


    <div class="message-content-form-div">
        <div class="message-content-form">

            <div class="mdui-collapse" id="messageContentMoreFunBar" style="margin-bottom: -20px;margin-left: 22px">
                <div class="mdui-collapse-item" id="messageContentMoreFunBarItem">
                    <div class="mdui-collapse-item-body">
                        <div class="mdui-btn-group">
                            <label for="sendPhotoMessage">
                                <a class="mdui-btn"><i class="mdui-icon material-icons">photo</i></a>
                            </label>
                            <input class="mdui-hidden" id="sendPhotoMessage" type="file" onchange="handlePhotoMessagePageSend('{{$thread->id}}',this)" accept="image/jpeg,image/png">
                            <button onclick="handleShowAllParticipants('{{$thread->id}}')" class="mdui-btn"><i class="mdui-icon material-icons">group</i></button>
                            <button onclick="handleGetParticipantsToSelect('{{$thread->id}}')" class="mdui-btn"><i class="mdui-icon material-icons">person_add</i></button>
                            <a href="{{route('messages.show.history',$thread->id)}}" class="mdui-btn"><i class="mdui-icon material-icons">history</i></a>
                        </div>
                    </div>
                </div>
            </div>

            <button onclick="toggleMessageContentMoreFunBar()" id="messageContentMoreFunBtn" class="mdui-btn mdui-btn-icon mdui-btn-dense message-content-form-textarea-btn mdui-color-teal">
                <i class="mdui-icon material-icons" style="left: 16px;">add</i>
            </button>
            <div contenteditable="true" id="messageContent" class="message-content-form-textarea" ></div>
            <button disabled onclick="handleMessagePageSend('{{$thread->id}}')" id="messageSendBtn" class="mdui-btn mdui-btn-icon mdui-btn-dense mdui-color-pink-accent message-content-form-submit-btn">
                <i class="mdui-icon material-icons" style="left: 18px;font-size: 22px;top: 16px;">send</i>
            </button>
            <div id="messageSendLoading" style="display: none" class="mdui-spinner mdui-spinner-colorful message-content-form-submit-btn"></div>
        </div>
    </div>
    @include('message.layout.message-participant-dialog')
    @include('message.layout.message-add-participant-dialog')
@endsection
