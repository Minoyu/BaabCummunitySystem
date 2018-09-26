<?php
namespace App\Http\Controllers;
use App\Model\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        if ($request->page){
//            $page = $request->page;
//        }else{
//            $page = 1;
//        }
//        $perPage = 2;
        // All threads, ignore deleted/archived participants
        //$threads = Thread::getAllLatest()->get();
        // All threads that user is participating in
         $threads = Thread::forUser(Auth::id())->latest('updated_at')->paginate(10);
        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();
//        dd($threads);

        $thread_collection = collect([]);
        foreach ($threads as $thread){
            $participantsString = $thread->participantsString(Auth::id());
            $participantsCount = $thread->participants()->count();
            $lastMessage = $thread->latestMessage;
            $lastMessageUser = $thread->latestMessage->user()->with('info')->first();
            $lastMessageIsMe = $thread->latestMessage->user_id == Auth::id();
            $isUnread = $thread->isUnread(Auth::id());
            $unreadCount = $thread->userUnreadMessagesCount(Auth::id());
            $thread_collection->push(compact(
                'thread',
                'participantsString',
                'participantsCount',
                'lastMessage',
                'lastMessageUser',
                'lastMessageIsMe',
                'isUnread',
                'unreadCount'
            ));
        }
//        return view('messenger.index', compact('threads'));
        return view('message.message-index', compact('thread_collection','threads'));
    }

    /**
     * Shows a message thread.
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id,Request $request)
    {
        $perPage = 15;
        $userId = Auth::id();
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('messages')->withErrors(['The conversation with ID: ' . $id . ' was not found.']);
        }

        $messageTooMuch = false;
        $messagesCount = $thread->messages()->count();
        $messages = $thread->messages()->with('user.info')->get()->slice($messagesCount-$perPage);

        if ($messagesCount>$perPage){
            $messageTooMuch = true;
        };

        $messages_collection = collect([]);
        foreach ($messages as $message) {
            $senderIsMe = $message->user->id == $userId;
            $messages_collection->push(compact('message', 'senderIsMe'));
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
        // don't show the current user in list


//        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
            $thread->markAsRead($userId);
//        return view('messenger.show', compact('thread', 'users'));
            return view('message.message-content', compact('thread', 'messages_collection','messageTooMuch'));
    }

    /**
     * Shows a message thread.
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showHistory($id,Request $request)
    {
        $perPage = 20;
        $userId = Auth::id();
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('messages')->withErrors(['The conversation with ID: ' . $id . ' was not found.']);
        }

        $messages = $thread->messages()->with('user.info')->paginate($perPage);

        $messages_collection = collect([]);
        foreach ($messages as $message) {
            $senderIsMe = $message->user->id == $userId;
            $messages_collection->push(compact('message', 'senderIsMe'));
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
        // don't show the current user in list


//        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
//        return view('messenger.show', compact('thread', 'users'));
        return view('message.message-history', compact('thread','messages', 'messages_collection'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('messenger.create', compact('users'));
    }
    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();
        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);
        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $input['message'],
        ]);
        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }
        return redirect()->route('messages');
    }

    /**
     * Adds a new message to a current thread.
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function update($id,Request $request)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('messages')->withErrors(['The conversation with ID: ' . $id . ' was not found.']);
        }
        $thread->activateAllParticipants();
        // Message
        $message = Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Input::get('message'),
        ]);
        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        $messages_collection = collect([]);
        $senderIsMe = true;
        $messages_collection->push(compact('message','senderIsMe'));

        if ($request->ajax()) {
            $view = view('message.layout.message-bubble', compact('messages_collection'))->render();
            return response()->json(['html' => $view]);
        }else{
            return redirect()->route('messages.show', $id);
        }
    }
}

// 增加参与者
//if (Input::has('recipients')) {
//    $thread->addParticipant(Input::get('recipients'));
//}