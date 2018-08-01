<?php

namespace App\Http\Controllers;

use App\Model\News;
use App\Model\NewsReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsReplyController extends Controller
{
    //
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
            return \redirect()->back()->with('tips', ['回复创建成功',]);
        }else{
            return \redirect()->back()->withErrors('创建失败,服务器内部错误,请联系管理员');
        }
    }
    public function adminEditShow(News $news,NewsReply $newsReply){
        return view('admin.news-reply.edit',compact('news','newsReply'));
    }
    public function update(News $news){
        $status = \request('status');
        //发布验证 暂存不验证
//        if($status=='public') {
        //验证
        $this->validate(\request(), [
            'title' => 'required',
            'content' => 'required',
        ]);
//        }
        //逻辑
        $title = \request('title');
        $content = \request('content');
        $cover_img = \request('cover_img');
        $news_category_id = \request('news_category_id');
        $order = \request('order');
        $invalided_at = \request('invalided_at');
        $user_id = Auth::id();
        $data = compact('title','content','cover_img','user_id','news_category_id','order','invalided_at','status');

//        dd($data);
        $res=News::where('id',$news->id)->update($data);

        //渲染
        if ($res) {
            if ($status == 'public') {
                return \redirect()->back()->with('tips', ['新闻' . $title . '编辑成功',]);
            } else {
                return \redirect()->back()->with('tips', ['新闻' . $title . '暂存成功',]);
            }
        }else{
            return \redirect()->back()->withErrors('编辑/暂存失败,服务器内部错误,请联系管理员');
        }

    }

    /* 删除行为
     * @param Request $companyId
     * @return int 1 success 0 failed
     */
    public function softDelete(Request $request){
        $news = News::where('id',$request->id)->first();
        $news->delete();
        if($news->trashed()){
            $status = 1;
            $msg = "The news has been deleted";
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg'));//ajax

    }


    public function softDeletes(Request $request){
        $failedCount=0;
        for($i=0;$i<count($request->ids);$i++){
            $news = News::where('id',$request->ids[$i])->first();
            $news->delete();
            if(!$news->trashed()){
                $failedCount++;
            }
        }
        if($failedCount==0){
            $status = 1;
            $msg = "The selected news has been deleted";
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
