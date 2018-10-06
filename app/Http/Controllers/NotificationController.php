<?php

namespace App\Http\Controllers;

use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
use App\Model\News;
use App\Model\NewsReply;
use App\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function index(){
        $notifications = Auth::user()->notifications()->paginate(10);
        $notify_collections = collect([]);

        foreach ($notifications as $notification){
            switch ($notification->data['type']){
                case 'community.reply.replied':
                    $type = 'community.reply.replied';
                    try {
                        $topic = CommunityTopic::findOrFail($notification->data['topicId']);
                        $reply = CommunityTopicReply::findOrFail($notification->data['replyId']);
                        $replier = User::findOrFail($notification->data['replierId'])->with('info')->first();
                    } catch (ModelNotFoundException $e) {
                        $notification->markAsRead();
                        break;
                    }
                    $isRead = $notification->read();
                    $created_at = $notification->created_at;

                    $notify_collections->push(compact(
                        'type',
                        'topic',
                        'reply',
                        'replier',
                        'isRead',
                        'created_at'
                    ));
                    break;
                case 'community.topic.replied':
                    $type = 'community.topic.replied';
                    try{
                        $topic = CommunityTopic::findOrFail($notification->data['topicId']);
                        $reply = CommunityTopicReply::findOrFail($notification->data['replyId']);
                        $replier = User::findOrFail($notification->data['replierId'])->with('info')->first();
                    } catch (ModelNotFoundException $e) {
                        $notification->markAsRead();
                        break;
                    }
                    $isRead = $notification->read();
                    $created_at = $notification->created_at;

                    $notify_collections->push(compact(
                        'type',
                        'topic',
                        'reply',
                        'replier',
                        'isRead',
                        'created_at'
                    ));
                    break;
                case 'news.reply.replied':
                    $type = 'news.reply.replied';
                    try{
                        $news = News::findOrFail($notification->data['newsId']);
                        $reply = NewsReply::findOrFail($notification->data['replyId']);
                        $replier = User::findOrFail($notification->data['replierId'])->with('info')->first();
                    } catch (ModelNotFoundException $e) {
                        $notification->markAsRead();
                        break;
                    }
                    $isRead = $notification->read();
                    $created_at = $notification->created_at;

                    $notify_collections->push(compact(
                        'type',
                        'news',
                        'reply',
                        'replier',
                        'isRead',
                        'created_at'
                    ));
                    break;
                case 'user.followed':
                    $type = 'user.followed';
                    try{
                        $user = User::findOrFail($notification->data['userId'])->with('info')->first();
                    } catch (ModelNotFoundException $e) {
                        $notification->markAsRead();
                        break;
                    }
                    $isRead = $notification->read();
                    $created_at = $notification->created_at;

                    $notify_collections->push(compact(
                        'type',
                        'user',
                        'isRead',
                        'created_at'
                    ));

                    break;
                case 'user.new.welcome':
                    $type = 'user.new.welcome';
                    $welcomeTopicLink = $notification->data['welcomeTopicLink'];
                    $isRead = $notification->read();
                    $created_at = $notification->created_at;

                    $notify_collections->push(compact(
                        'type',
                        'welcomeTopicLink',
                        'isRead',
                        'created_at'
                    ));
                    break;
            }
        }

        $notifications->markAsRead();
        return view('message.notify-index',['notifications'=>$notify_collections,'notify'=>$notifications]);
    }
}
