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
                return \redirect()->back()->with('tips', [__('controller.createSuccess',['name'=>$title]),]);
            } else {
                return \redirect()->back()->with('tips', [__('controller.saveSuccess',['name'=>$title]),]);
            }
        }else{
            return \redirect()->back()->withErrors(__('controller.failedServerError'));
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
                return \redirect()->back()->with('tips', [__('controller.editSuccess',['name'=>$title]),]);
            } else {
                return \redirect()->back()->with('tips', [__('controller.saveSuccess',['name'=>$title]),]);
            }
        }else{
            return \redirect()->back()->withErrors(__('controller.failedServerError'));
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
            $msg = __('controller.deleteSuccess');
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
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
        return \redirect()->back()->with('tips', [__('controller.priorityUp1')]);
    }

    /**
     * 降低优先级
     * @param IndexHeadline $indexHeadline
     * @return \Illuminate\Http\RedirectResponse
     */
    public function turnDownOrder(IndexHeadline $indexHeadline){
        $this->authorize('manage',$indexHeadline);

        $indexHeadline->decrement('order');
        return \redirect()->back()->with('tips', [__('controller.priorityDown1')]);
    }

}
