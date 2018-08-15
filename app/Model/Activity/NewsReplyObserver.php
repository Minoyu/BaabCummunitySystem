<?php

namespace App\Model\Activity;

use App\Model\NewsReply;
use Illuminate\Support\Facades\Auth;

class NewsReplyObserver{

    /**
     * 监听话题创建事件
     * @param NewsReply $reply
     */
    public function created(NewsReply $reply){
        $userId = Auth::id();
        $userName = Auth::user()->name;
        $replyContent = $reply->content;
        $newsId = $reply->news->id;
        $newsTitle = $reply->news->title;
        $event = 'newsReply.created';
        activity()->on($reply)
            ->withProperties(compact('userId','userName','replyContent','newsId','newsTitle','event'))
            ->log('回复了社区话题');
    }
}