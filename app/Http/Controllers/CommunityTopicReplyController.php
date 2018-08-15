<?php

namespace App\Http\Controllers;

use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityTopicReplyController extends Controller
{
    //
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
            $replyContent = $reply->title;
            $topicId = $reply->communityTopic->id;
            $topicTitle = $reply->communityTopic->title;
            $event = 'communityTopicReply.voted';
            activity()->on($reply)
                ->withProperties(compact('userId','userName','topicId','topicTitle','replyContent','event'))
                ->log('点赞了社区回复');

        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg','thumb_up_count'));//ajax
    }

    public function handleAjaxCancelVote(Request $request){
        //验证
        $this->validate($request, [
            'replyId' => 'required|exists:community_topic_replies,id',
        ]);
        $reply = CommunityTopicReply::find($request->replyId);
        if (Auth::user()->cancelVote($reply)){
            $thumb_up_count = $reply->countVoters();
            $reply->update(compact('thumb_up_count'));
            $status = 1;
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg','thumb_up_count'));//ajax

    }

    public function adminListShowAll(){
        $replies=CommunityTopicReply::with(['user','communityTopic'])->paginate(15);
        return view('admin.community-topic-reply.all-list',compact('replies'));
    }

    public function adminListShow(CommunityTopic $topic){
        $replies=$topic->replies()->paginate(15);
        return view('admin.community-topic-reply.list',compact('topic','replies'));
    }
    public function adminCreateShow(CommunityTopic $topic){
        return view('admin.community-topic-reply.create',compact('topic'));
    }
    public function store(CommunityTopic $topic,Request $request){
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
                $msg = "Reply Successfully";
            }else{
                $status = 0;
                $msg = "Server internal error";
            }
            return json_encode(compact('status','msg'));//ajax
        }else{
            //渲染
            if ($res) {
                $reply_count = $topic->reply_count + 1;
                $last_reply_at = Carbon::now();
                $last_reply_id = $res->id;
                $topic->update(compact('reply_count','last_reply_at','last_reply_id'));
                return \redirect()->back()->with('tips', ['回复创建成功',]);
            }else{
                return \redirect()->back()->withErrors('创建失败,服务器内部错误,请联系管理员');
            }
        }
    }

    public function adminEditShow(CommunityTopic $topic,CommunityTopicReply $reply){
        return view('admin.community-topic-reply.edit',compact('topic','reply'));
    }

    public function update(CommunityTopic $topic,CommunityTopicReply $reply){
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
            return \redirect()->back()->with('tips', ['回复编辑成功',]);
        }else{
            return \redirect()->back()->withErrors('编辑/暂存失败,服务器内部错误,请联系管理员');
        }

    }

    /* 删除行为
     * @param Request $companyId
     * @return int 1 success 0 failed
     */
    public function softDelete(Request $request){
        $reply = CommunityTopicReply::where('id',$request->id)->first();
        $reply->delete();
        if($reply->trashed()){
            $reply->communityTopic()->decrement('reply_count');
            $status = 1;
            $msg = "The reply has been deleted";
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg'));//ajax

    }


    public function softDeletes(Request $request){
        $failedCount=0;
        for($i=0;$i<count($request->ids);$i++){
            $reply = CommunityTopicReply::where('id',$request->ids[$i])->first();
            $reply->delete();
            if(!$reply->trashed()){
                $failedCount++;
            }else{
                $reply->communityTopic()->decrement('reply_count');
            }
        }
        if($failedCount==0){
            $status = 1;
            $msg = "The selected replies has been deleted";
        }else{
            $status = 0;
            $msg = $failedCount."Server internal error";
        }
        return json_encode(compact('status','msg'));//ajax
    }

}
