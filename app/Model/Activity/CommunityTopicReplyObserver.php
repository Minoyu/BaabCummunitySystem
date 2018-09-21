<?php

namespace App\Model\Activity;

use App\Model\CommunityTopicReply;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class CommunityTopicReplyObserver
{

    /**
     * xss防护
     * @param CommunityTopicReply $reply
     */
    public function saving(CommunityTopicReply $reply){
        $reply->content = clean($reply->content, 'topic_content');
    }

    /**
     * 监听话题回复创建事件
     * @param CommunityTopicReply $reply
     */
    public function created(CommunityTopicReply $reply)
    {
        $userId = Auth::id();
        $userName = Auth::user()->name;
        $userAvatar = Auth::user()->info->avatar_url;
        $replyContent = $reply->content;
        $replyId = $reply->id;
        $topicId = $reply->communityTopic->id;
        $topicTitle = $reply->communityTopic->title;
        $event = 'communityTopicReply.created';
        activity()->on($reply)
            ->withProperties(compact('userId', 'userName', 'userAvatar', 'replyId', 'replyContent', 'topicId', 'topicTitle', 'event'))
            ->log('回复了社区话题');

//        $reply->communityTopic->user->notify(new CommunityTopicReplied($reply));
    }

    public function deleted(CommunityTopicReply $reply)
    {
        Activity::where([
            ['subject_id', $reply->id],
            ['subject_type', 'App\Model\CommunityTopicReply'],
        ])
            ->delete();

        DB::table('votes')
            ->where([
                ['votable_id',$reply->id],
                ['votable_type','App\Model\CommunityTopicReply'],
            ])
            ->delete();
    }
}