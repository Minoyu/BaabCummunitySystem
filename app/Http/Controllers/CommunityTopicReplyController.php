<?php

namespace App\Http\Controllers;

use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityTopicReplyController extends Controller
{
    //
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
    public function store(CommunityTopic $topic){
        //验证
        $this->validate(\request(), [
            'content' => 'required|min:2',
        ]);
        //逻辑
        $content = \request('content');
        $user_id = Auth::id();
        $data = compact('content','user_id');

        $res=$topic->replies()->create($data);

        //渲染
        if ($res) {
            $topic->increment('reply_count');
            return \redirect()->back()->with('tips', ['回复创建成功',]);
        }else{
            return \redirect()->back()->withErrors('创建失败,服务器内部错误,请联系管理员');
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