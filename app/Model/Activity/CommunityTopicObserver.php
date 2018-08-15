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
        $topicTitle = $topic->title;
        $topicStatus = $topic->status;
        if ($topicStatus =="publish"){
            $event = 'communityTopic.created';
            activity()->on($topic)
                ->withProperties(compact('userId','userName','topicTitle','event'))
                ->log('发表了社区话题');
        }else{
            $event = 'communityTopic.saved';
            activity()->on($topic)
                ->withProperties(compact('userId','userName','topicTitle','event'))
                ->log('暂存了社区话题');

        }
    }
}