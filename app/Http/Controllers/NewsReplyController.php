<?php

namespace App\Http\Controllers;

use App\Model\News;
use App\Model\NewsReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class NewsReplyController extends Controller
{
    //

    /**
     * 赞逻辑
     * @param Request $request
     * @return string
     */
    public function handleAjaxVote(Request $request){
        //验证
        $this->validate($request, [
            'replyId' => 'required',
        ]);
        $reply = NewsReply::find($request->replyId);
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
            $newsId = $reply->news->id;
            $newsTitle = $reply->news->title;
            $cover_img = $reply->news->cover_img;
            $event = 'newsReply.voted';
            activity()->on($reply)
                ->withProperties(compact('userId','userName','userAvatar','newsId','newsTitle','replyId','replyContent','event','cover_img'))
                ->log('点赞了新闻回复');

        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg','thumb_up_count'));//ajax
    }

    /**
     * 取消赞逻辑
     * @param Request $request
     * @return string
     */
    public function handleAjaxCancelVote(Request $request){
        //验证
        $this->validate($request, [
            'replyId' => 'required',
        ]);
        $reply = NewsReply::find($request->replyId);
        if (Auth::user()->cancelVote($reply)){
            //删除动态
            Activity::where([
                ['subject_id', $reply->id],
                ['subject_type', 'App\Model\NewsReply'],
                ['causer_id', Auth::id()],
                ['description', '点赞了新闻回复'],
            ])
                ->delete();
            $thumb_up_count = $reply->countVoters();
            $reply->update(compact('thumb_up_count'));
            $status = 1;
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg','thumb_up_count'));//ajax

    }

    /**
     * 后台全部回复列表显示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShowAll(){
        $replies=NewsReply::paginate(20);
        return view('admin.news-reply.all-list',compact('replies'));
    }

    /**
     * 后台按新闻显示回复列表
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShow(News $news){
        $replies=$news->replies()->paginate(15);
        return view('admin.news-reply.list',compact('news','replies'));
    }

    /**
     * 后台创建页
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateShow(News $news){
        return view('admin.news-reply.create',compact('news'));
    }

    /**
     * 评论创建逻辑
     * @param News $news
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|string
     */
    public function store(News $news,Request $request){
        $this->authorize('create',NewsReply::class);

        //验证
        $this->validate(\request(), [
            'content' => 'required|min:2',
        ]);
        //逻辑
        $content = \request('content');
        $user_id = Auth::id();
        $data = compact('content','user_id');
        $res=$news->replies()->create($data);

        if ($request->ajax()) {
            //渲染
            if ($res) {
                $news->increment('reply_count');
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
                $news->increment('reply_count');
                return \redirect()->back()->with('tips', ['回复成功',]);
            }else{
                return \redirect()->back()->withErrors('创建失败,服务器内部错误,请联系管理员');
            }
        }
    }

    /**
     * @param News $news
     * @param NewsReply $reply
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEditShow(News $news,NewsReply $reply){
        return view('admin.news-reply.edit',compact('news','reply'));
    }

    /**
     * @param News $news
     * @param NewsReply $reply
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(News $news,NewsReply $reply){
        $this->authorize('update',$reply);

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

    /**
     * @param Request $request
     * @return string
     */
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

}
