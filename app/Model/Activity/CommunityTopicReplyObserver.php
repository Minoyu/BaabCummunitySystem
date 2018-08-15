<?php

namespace App\Model\Activity;

use App\Model\CommunityTopicReply;
use Illuminate\Support\Facades\Auth;

class CommunityTopicReplyObserver{

    /**
     * 监听话题创建事件
     * @param CommunityTopicReply $reply
     */
    public function created(CommunityTopicReply $reply){
        $userId = Auth::id();
        $userName = Auth::user()->name;
        $replyContent = $reply->content;
        $topicId = $reply->communityTopic->id;
        $topicTitle = $reply->communityTopic->title;
        $event = 'communityTopicReply.created';
        activity()->on($reply)
            ->withProperties(compact('userId','userName','replyContent','topicId','topicTitle','event'))
            ->log('回复了社区话题');
    }
}