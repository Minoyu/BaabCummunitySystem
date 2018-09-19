<?php

namespace App\Http\Controllers;

use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class CommunityTopicReplyController extends Controller
{
    //

    /**
     * 处理赞逻辑
     * @param Request $request
     * @return string
     */
    public function handleAjaxVote(Request $request){
        //验证
        $this->validate($request, [
            'replyId' => 'required|exists:community_topic_replies,id',
        ]);
        $reply = CommunityTopicReply::find($request->replyId);
        if (Auth::user()->upVote($reply)){
            $thumb_up_count = $reply->countVoters();
            $reply->update(compact('thumb_up_count'));
            $status = 1;

            //记录动态
            $userId = Auth::id();
            $userName = Auth::user()->name;
            $userAvatar = Auth::user()->info->avatar_url;
            $replyContent = $reply->content;
            $replyId = $reply->id;
            $topicId = $reply->communityTopic->id;
            $topicTitle = $reply->communityTopic->title;
            $event = 'communityTopicReply.voted';
            activity()->on($reply)
                ->withProperties(compact('userId','userName','userAvatar','topicId','topicTitle','replyId','replyContent','event'))
                ->log('点赞了社区回复');

        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
        }
        return json_encode(compact('status','msg','thumb_up_count'));//ajax
    }

    /**
     * 处理取消赞逻辑
     * @param Request $request
     * @return string
     */
    public function handleAjaxCancelVote(Request $request){
        //验证
        $this->validate($request, [
            'replyId' => 'required|exists:community_topic_replies,id',
        ]);
        $reply = CommunityTopicReply::find($request->replyId);
        if (Auth::user()->cancelVote($reply)){

            //删除动态
            Activity::where([
                ['subject_id', $reply->id],
                ['subject_type', 'App\Model\CommunityTopicReply'],
                ['causer_id', Auth::id()],
                ['description', '点赞了社区回复'],
            ])->delete();

            $thumb_up_count = $reply->countVoters();
            $reply->update(compact('thumb_up_count'));
            $status = 1;
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
        }
        return json_encode(compact('status','msg','thumb_up_count'));//ajax

    }

    /**
     * 后台显示全站回复列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShowAll(){
        $replies=CommunityTopicReply::with(['user','communityTopic'])->paginate(15);
        return view('admin.community-topic-reply.all-list',compact('replies'));
    }

    /**
     * 后台显示话题下的回复列表
     * @param CommunityTopic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShow(CommunityTopic $topic){
        $replies=$topic->replies()->paginate(15);
        return view('admin.community-topic-reply.list',compact('topic','replies'));
    }

    /**
     * 后台显示创建回复页面
     * @param CommunityTopic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateShow(CommunityTopic $topic){
        return view('admin.community-topic-reply.create',compact('topic'));
    }

    /**
     * 回复创建逻辑
     * @param CommunityTopic $topic
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|string
     */
    public function store(CommunityTopic $topic,Request $request){
        $this->authorize('create',CommunityTopicReply::class);

        //验证
        $this->validate(\request(), [
            'content' => 'required|min:2',
        ]);
        //逻辑
        $content = \request('content');
        $user_id = Auth::id();
        $data = compact('content','user_id');

        $res=$topic->replies()->create($data);

        if ($request->ajax()) {
            //渲染
            if ($res) {
                $reply_count = $topic->reply_count + 1;
                $last_reply_at = Carbon::now();
                $last_reply_id = $res->id;
                $topic->update(compact('reply_count','last_reply_at','last_reply_id'));
                $status = 1;
                $msg = __('controller.replySuccess');
            }else{
                $status = 0;
                $msg = __('controller.failedServerError');
            }
            return json_encode(compact('status','msg'));//ajax
        }else{
            //渲染
            if ($res) {
                $reply_count = $topic->reply_count + 1;
                $last_reply_at = Carbon::now();
                $last_reply_id = $res->id;
                $topic->update(compact('reply_count','last_reply_at','last_reply_id'));
                return \redirect()->back()->with('tips', [__('controller.replySuccess'),]);
            }else{
                return \redirect()->back()->withErrors(__('controller.failedServerError'));
            }
        }
    }

    /**
     * 显示后台编辑页面
     * @param CommunityTopic $topic
     * @param CommunityTopicReply $reply
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEditShow(CommunityTopic $topic,CommunityTopicReply $reply){
        return view('admin.community-topic-reply.edit',compact('topic','reply'));
    }

    /**
     * 回复更新逻辑
     * @param CommunityTopic $topic
     * @param CommunityTopicReply $reply
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(CommunityTopic $topic,CommunityTopicReply $reply){
        $this->authorize('update',$reply);
        //验证
        $this->validate(\request(), [
            'content' => 'required|min:2',
        ]);
        //逻辑
        $content = \request('content');
        $data = compact('content');

        $res=CommunityTopicReply::where('id',$reply->id)->update($data);

        //渲染
        if ($res) {
            return \redirect()->back()->with('tips', [__('controller.replySuccess'),]);
        }else{
            return \redirect()->back()->withErrors(__('controller.failedServerError'));
        }

    }

    /* 删除行为
     * @param Request $companyId
     * @return int 1 success 0 failed
     */
    public function softDelete(Request $request){
        $reply = CommunityTopicReply::where('id',$request->id)->first();
        $this->authorize('delete',$reply);

        $reply->delete();
        if($reply->trashed()){
            $reply_count = $reply->communityTopic->replies->count();
            $reply->communityTopic->update(compact('reply_count'));
            $status = 1;
            $msg = __('controller.deleteSuccess');
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
        }
        return json_encode(compact('status','msg'));//ajax

    }

    /**
     * 批量删除行为
     * @param Request $request
     * @return string
     */
    public function softDeletes(Request $request){
        $failedCount=0;
        for($i=0;$i<count($request->ids);$i++){
            $reply = CommunityTopicReply::where('id',$request->ids[$i])->first();
            $this->authorize('delete',$reply);

            $reply->delete();
            if(!$reply->trashed()){
                $failedCount++;
            }else{
                $reply_count = $reply->communityTopic->replies->count();
                $reply->communityTopic->update(compact('reply_count'));
            }
        }
        if($failedCount==0){
            $status = 1;
            $msg = __('controller.deleteSuccess');
        }else{
            $status = 0;
            $msg = $failedCount.__('controller.failedServerError');
        }
        return json_encode(compact('status','msg'));//ajax
    }

}
