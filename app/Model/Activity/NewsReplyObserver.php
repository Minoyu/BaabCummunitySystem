<?php

namespace App\Model\Activity;

use App\Model\NewsReply;
use App\Model\User;
use App\Notifications\NewsReplyReplied;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class NewsReplyObserver{

    /**
     * xss防护
     * @param NewsReply $reply
     */
    public function saving(NewsReply $reply){
        $reply->content = clean($reply->content, 'topic_content');
    }

    /**
     * 监听新闻评论创建事件
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

        //不回复本人和话题作者时通知原回复者
        if (preg_match('/@(.*?)-/',$replyContent,$replyToId)){
            if (($replyTo = User::find($replyToId[1]))&& ($replyTo !=Auth::user())){
                $replyTo->notify(new NewsReplyReplied($reply));
            }
        };
    }

    public function deleted(NewsReply $reply)
    {
        Activity::where([
            ['subject_id', $reply->id],
            ['subject_type', 'App\Model\NewsReply'],
        ])
            ->delete();

        DB::table('votes')
            ->where([
                ['votable_id',$reply->id],
                ['votable_type','App\Model\NewsReply'],
            ])
            ->delete();
    }

}