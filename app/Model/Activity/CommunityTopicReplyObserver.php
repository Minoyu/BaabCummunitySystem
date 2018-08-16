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
        $userAvatar = Auth::user()->info->avatar_url;
        $replyContent = $reply->content;
        $replyId = $reply->id;
        $topicId = $reply->communityTopic->id;
        $topicTitle = $reply->communityTopic->title;
        $event = 'communityTopicReply.created';
        activity()->on($reply)
            ->withProperties(compact('userId','userName','userAvatar','replyId','replyContent','topicId','topicTitle','event'))
            ->log('回复了社区话题');
    }
}