<?php

namespace App\Http\Controllers;

use App\Model\News;
use App\Model\NewsReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsReplyController extends Controller
{
    //
    public function adminListShowAll(){
        $replies=NewsReply::paginate(20);
        return view('admin.news-reply.all-list',compact('replies'));
    }
    public function adminListShow(News $news){
        $replies=$news->replies()->paginate(15);
        return view('admin.news-reply.list',compact('news','replies'));
    }
    public function adminCreateShow(News $news){
        return view('admin.news-reply.create',compact('news'));
    }
    public function store(News $news){
        //验证
        $this->validate(\request(), [
            'content' => 'required|min:2',
        ]);
        //逻辑
        $content = \request('content');
        $user_id = Auth::id();
        $data = compact('content','user_id');

        $res=$news->replies()->create($data);

        //渲染
        if ($res) {
            $news->increment('reply_count');
            return \redirect()->back()->with('tips', ['回复创建成功',]);
        }else{
            return \redirect()->back()->withErrors('创建失败,服务器内部错误,请联系管理员');
        }
    }
    public function adminEditShow(News $news,NewsReply $reply){
        return view('admin.news-reply.edit',compact('news','reply'));
    }
    public function update(News $news,NewsReply $reply){
        //验证
        $this->validate(\request(), [
            'content' => 'required|min:2',
        ]);
        //逻辑
        $content = \request('content');
        $data = compact('content');

        $res=NewsReply::where('id',$reply->id)->update($data);

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
        $newsReply = NewsReply::where('id',$request->id)->first();
        $newsReply->delete();
        if($newsReply->trashed()){
            $newsReply->news()->decrement('reply_count');
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
            $newsReply = NewsReply::where('id',$request->ids[$i])->first();
            $newsReply->delete();
            if(!$newsReply->trashed()){
                $failedCount++;
            }else{
                $newsReply->news()->decrement('reply_count');
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

    public function turnUpOrder(News $news){
        $news->increment('order');
        return \redirect()->back()->with('tips', ['优先级已自增1']);
    }
    public function turnDownOrder(News $news){
        $news->decrement('order');
        return \redirect()->back()->with('tips', ['优先级已自减1']);
    }

}
