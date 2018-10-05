<?php

namespace App\Http\Controllers;

use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
use App\Model\News;
use App\Model\NewsReply;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function index(){
        $notifications = Auth::user()->notifications;
        $notify_collections = collect([]);

        foreach ($notifications as $notification){
            switch ($notification->data['type']){
                case 'community.reply.replied':
                    $type = 'community.reply.replied';
                    $topic = CommunityTopic::find($notification->data['topicId']);
                    $reply = CommunityTopicReply::find($notification->data['replyId']);
                    $replier = User::where('id',$notification->data['replierId'])->with('info')->first();
                    $isRead = $notification->read();

                    $notify_collections->push(compact(
                        'type',
                        'topic',
                        'reply',
                        'replier',
                        'isRead'
                    ));
                    break;
                case 'community.topic.replied':
                    $type = 'community.topic.replied';
                    $topic = CommunityTopic::find($notification->data['topicId']);
                    $reply = CommunityTopicReply::find($notification->data['replyId']);
                    $replier = User::where('id',$notification->data['replierId'])->with('info')->first();
                    $isRead = $notification->read();

                    $notify_collections->push(compact(
                        'type',
                        'topic',
                        'reply',
                        'replier',
                        'isRead'
                    ));
                    break;
                case 'news.reply.replied':
                    $type = 'news.reply.replied';
                    $news = News::find($notification->data['newsId']);
                    $reply = NewsReply::find($notification->data['replyId']);
                    $replier = User::where('id',$notification->data['replierId'])->with('info')->first();
                    $isRead = $notification->read();

                    $notify_collections->push(compact(
                        'type',
                        'news',
                        'reply',
                        'replier',
                        'isRead'
                    ));
                    break;
                case 'user.followed':
                    $type = 'user.followed';
                    $user = User::where('id',$notification->data['userId'])->with('info')->first();
                    $isRead = $notification->read();

                    $notify_collections->push(compact(
                        'type',
                        'user',
                        'isRead'
                    ));

                    break;
                case 'user.new.welcome':
                    $type = 'user.new.welcome';
                    $welcomeTopicLink = $notification->data['welcomeTopicLink'];
                    $isRead = $notification->read();

                    $notify_collections->push(compact(
                        'type',
                        'welcomeTopicLink',
                        'isRead'
                    ));
                    break;
            }
        }

        return view('message.notify-index',['notifications'=>$notify_collections]);
    }
}
