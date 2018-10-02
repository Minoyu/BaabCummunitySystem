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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
            $participantsCount = $thread->participants()->count();
            $lastMessage = $thread->latestMessage;
            $lastMessageUser = $thread->latestMessage->user()->with('info')->first();
            $lastMessageIsMe = $thread->latestMessage->user_id == Auth::id();
            $isUnread = $thread->isUnread(Auth::id());
            $unreadCount = $thread->userUnreadMessagesCount(Auth::id());
            $thread_collection->push(compact(
                'thread',
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
        $messages = $thread->messages()->with('user.info')->get()->slice($messagesCount>$perPage?$messagesCount-$perPage:0);

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
//        $thread->activateAllParticipants();
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

    /**
     * Adds a new Photo message to a current thread.
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function updatePhoto($id,Request $request)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('messages')->withErrors(['The conversation with ID: ' . $id . ' was not found.']);
        }
//        $thread->activateAllParticipants();
        $user = Auth::user();

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'img_data' => 'required'
            ]);

            $image = $request->img_data;

            $realPath = decodeBase64ImgToFile($image);
            // 获取文件相关信息
            $ext = 'jpeg'; // 扩展名

            // 上传文件
            // 如果宽大于1280 裁剪图片
            $img = Image::make($realPath);
            if ($img->width() > 1280) {
                $img->resize(1280, null, function ($constraint) {        // 调整图像的宽到1280，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }
            $width = $img->width();
            $height = $img->height();
            $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '@' . $width . 'x' . $height . '@' . uniqid() . '.' . $ext;
            //存储大图
            Storage::disk('messageImg')->put($filename, file_get_contents($realPath));

            //图片压缩处理缩略图
            $smallImg = Image::make($realPath);
            if ($smallImg->width() > 300) {
                $smallImg->resize(300, null, function ($constraint) {        // 调整图像的宽到300，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }

            $s_filename = 's-' . $filename;
            // 使用communityTopicImg本地存储空间（目录）
            Storage::disk('messageImg')->put($s_filename, file_get_contents($realPath));

            $img_url = "/uploads/message/img/" . $filename;
            $simg_url = "/uploads/message/img/" . $s_filename;
            $size = $width . 'x' . $height;

            $html = '  
            <div class="photo-gallery">      
                <figure>
                  <a href="'.$img_url.'" data-size="'.$size.'">
                      <img src="'.$simg_url.'" class="message-img animated zoomInRight"/>
                  </a>
                </figure>
            </div>';

            // Message
            $message = Message::create([
                'thread_id' => $thread->id,
                'user_id' => Auth::id(),
                'body' => $html,
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
            $messages_collection->push(compact('message', 'senderIsMe'));

            if ($request->ajax()) {
                $view = view('message.layout.message-bubble', compact('messages_collection'))->render();
                return response()->json(['html' => $view]);
            } else {
                return redirect()->route('messages.show', $id);
            }
        }
    }


    public function getAllParticipant($id){
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('messages')->withErrors(['The conversation with ID: ' . $id . ' was not found.']);
        }

        $creator = $thread->creator()->with('info')->first();
        $participants = $thread->participants()->where('user_id','!=',$creator->id)->with('user.info')->get();
        $view = view('message.layout.message-participant-list', compact('participants','creator'))->render();
        return response()->json(['html' => $view]);
    }

//    public function removeParticipant($id,Request $request){
//        try {
//            $thread = Thread::findOrFail($id);
//        } catch (ModelNotFoundException $e) {
//            return redirect()->route('messages')->withErrors(['The conversation with ID: ' . $id . ' was not found.']);
//        }
//
//        $participants = $request->removeUsers;
//        $thread->removeParticipant($participants);
//        return response()->json(['status' => 1]);
//
//    }
//


    public function addParticipant($id,Request $request){
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('messages')->withErrors(['The conversation with ID: ' . $id . ' was not found.']);
        }

        $participants = $request->addUsers;
        $thread->addParticipant($participants);
        return response()->json(['status' => 1]);

    }

    public function showParticipantToSelect($id){
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('messages')->withErrors(['The conversation with ID: ' . $id . ' was not found.']);
        }

        $participantsIds = [];
        foreach($thread->participants as $participant){
            array_push($participantsIds,$participant->user->id);
        }
        $followings = Auth::user()->followings()->whereNotIn('id', $participantsIds)->get();
        $view = view('message.layout.message-add-participant-list', compact('followings'))->render();
        return response()->json(['html' => $view]);
    }
}
// 增加参与者
//if (Input::has('recipients')) {
//    $thread->addParticipant(Input::get('recipients'));
//}