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
        $userAvatar = Auth::user()->info->avatar_url;
        $replyContent = $reply->content;
        $replyId = $reply->id;
        $newsId = $reply->news->id;
        $newsTitle = $reply->news->title;
        $cover_img = $reply->news->cover_img;
        $event = 'newsReply.created';
        activity()->on($reply)
            ->withProperties(compact('userId','userName','userAvatar','replyId','replyContent','newsId','newsTitle','cover_img','event'))
            ->log('回复了社区话题');
    }
}