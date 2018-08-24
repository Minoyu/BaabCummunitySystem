<?php

namespace App\Http\Controllers;

use App\Model\IndexHeadline;
use Illuminate\Http\Request;

class IndexHeadlineController extends Controller
{
    //
    /**
     * 展示后台列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShow(){
        $indexHeadlines = IndexHeadline::orderBy('order','DESC')->paginate(12);
        return view('admin.index-headline.list',compact('indexHeadlines'));
    }

    /**
     * 展示后台创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateShow(){
        return view('admin.index-headline.create');
    }

    /**
     * 创建逻辑
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(){
        $this->authorize('create',IndexHeadline::class);

        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'title' => 'required|min:2',
            'subtitle' => 'required|min:2',
            'url' => 'required|url',
            'subUrl' => 'required|url',
            'position' => 'required',
            'order' => 'required',
        ]);
        //逻辑
        $title = \request('title');
        $subtitle = \request('subtitle');
        $url = \request('url');
        $position = \request('position');
        $subUrl = \request('subUrl');
        $order = \request('order');
        $data = compact('title','subtitle','url','position','subUrl','order','status');

        $res=IndexHeadline::create($data);

        //渲染
        if ($res) {
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', ['新闻头条' . $title . '创建成功',]);
            } else {
                return \redirect()->back()->with('tips', ['新闻头条' . $title . '暂存成功',]);
            }
        }else{
            return \redirect()->back()->withErrors('创建/暂存失败,服务器内部错误,请联系管理员');
        }
    }

    /**
     * 展示后台编辑页
     * @param IndexHeadline $indexHeadline
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEditShow(IndexHeadline $indexHeadline){
        return view('admin.index-headline.edit',compact('indexHeadline'));
    }

    /**
     * 编辑逻辑
     * @param IndexHeadline $indexHeadline
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(IndexHeadline $indexHeadline){
        $this->authorize('update',$indexHeadline);

        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'title' => 'required|min:2',
            'subtitle' => 'required|min:2',
            'url' => 'required|url',
            'subUrl' => 'required',
            'position' => 'required',
            'order' => 'required',
        ]);
        //逻辑
        $title = \request('title');
        $subtitle = \request('subtitle');
        $url = \request('url');
        $position = \request('position');
        $subUrl = \request('subUrl');
        $order = \request('order');
        $data = compact('title','subtitle','url','position','subUrl','order','status');

        $res=$indexHeadline->update($data);

        //渲染
        if ($res) {
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', ['新闻轮播图' . $title . '编辑成功',]);
            } else {
                return \redirect()->back()->with('tips', ['新闻轮播图' . $title . '暂存成功',]);
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
        $indexHeadline = IndexHeadline::where('id',$request->id)->first();
        $this->authorize('delete',$indexHeadline);

        $indexHeadline->delete();
        if($indexHeadline->trashed()){
            $status = 1;
            $msg = "The Index Headline has been deleted";
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg'));//ajax


    }

    /**
     * 提高优先级
     * @param IndexHeadline $indexHeadline
     * @return \Illuminate\Http\RedirectResponse
     */
    public function turnUpOrder(IndexHeadline $indexHeadline){
        $this->authorize('manage',$indexHeadline);

        $indexHeadline->increment('order');
        return \redirect()->back()->with('tips', ['优先级已自增1']);
    }

    /**
     * 降低优先级
     * @param IndexHeadline $indexHeadline
     * @return \Illuminate\Http\RedirectResponse
     */
    public function turnDownOrder(IndexHeadline $indexHeadline){
        $this->authorize('manage',$indexHeadline);

        $indexHeadline->decrement('order');
        return \redirect()->back()->with('tips', ['优先级已自减1']);
    }

}
