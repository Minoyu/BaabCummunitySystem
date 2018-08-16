<?php

namespace App\Model\Activity;

use App\Model\CommunityTopic;
use Illuminate\Support\Facades\Auth;

class CommunityTopicObserver{

    /**
     * 监听话题创建事件
     * @param CommunityTopic $topic
     */
    public function created(CommunityTopic $topic){
        $userId = Auth::id();
        $userName = Auth::user()->name;
        $userAvatar = Auth::user()->info->avatar_url;
        $topicTitle = $topic->title;
        $topicId = $topic->id;
        $topicStatus = $topic->status;
        if ($topicStatus =="publish"){
            $event = 'communityTopic.created';
            activity()->on($topic)
                ->withProperties(compact('userId','userName','userAvatar','topicId','topicTitle','event'))
                ->log('发表了社区话题');
        }
    }
}