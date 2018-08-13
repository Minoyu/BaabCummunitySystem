<?php

namespace App\Http\Controllers;

use App\Model\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    //

    /**
     * 展示后台列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShow(){
        $newsCategories = NewsCategory::paginate(5);
        return view('admin.news-category.list',compact('newsCategories'));
    }

    /**
     * 展示后台创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateShow(){
        return view('admin.news-category.create');
    }

    /**
     * 创建逻辑
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(){
        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        //逻辑
        $name = \request('name');
        $description = \request('description');
        $icon = \request('icon');
        $order = \request('order');
        if ($icon!=""){
            $data = compact('name','description','order','icon','status');

        }else{
            $data = compact('name','description','order','status');

        }

        $res=NewsCategory::create($data);

        //渲染
        if ($res) {
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', ['新闻分类' . $name . '创建成功',]);
            } else {
                return \redirect()->back()->with('tips', ['新闻分类' . $name . '暂存成功',]);
            }
        }else{
            return \redirect()->back()->withErrors('创建/暂存失败,服务器内部错误,请联系管理员');
        }
    }

    /**
     * 展示后台编辑页
     * @param NewsCategory $newsCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEditShow(NewsCategory $newsCategory){
        return view('admin.news-category.edit',compact('newsCategory'));
    }

    /**
     * 编辑逻辑
     * @param NewsCategory $newsCategory
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(NewsCategory $newsCategory){
        $status = \request('status');
        //发布验证 暂存不验证
        if($status=='publish') {
            //验证
            $this->validate(\request(), [
                'name' => 'required',
                'description' => 'required',
            ]);
        }
        //逻辑
        $name = \request('name');
        $description = \request('description');
        $icon = \request('icon');
        $order = \request('order');
        $data = compact('name','description','icon','order','status');

        $res=NewsCategory::where('id',$newsCategory->id)->update($data);

        //渲染
        if ($res) {
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', ['新闻分类' . $name . '编辑成功',]);
            } else {
                return \redirect()->back()->with('tips', ['新闻分类' . $name . '暂存成功',]);
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
    $newsCategory = NewsCategory::where('id',$request->id)->first();
    if ($newsCategory->news_count==0){
        $newsCategory->delete();
        if($newsCategory->trashed()){
            $status = 1;
            $msg = "The news category has been deleted";
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
    }else{
        $status = 2;
        $msg = "删除失败，此分类下仍存在新闻";
    }
        return json_encode(compact('status','msg'));//ajax


    }

    /**
     * 批量删除行为
     * @param Request $request
     * @return int 1 success 0 failed
     */
    public function softDeletes(Request $request){
        $failedCount=0;
        for($i=0;$i<count($request->ids);$i++){
            $newsCategory = NewsCategory::where('id',$request->ids[$i])->first();
            if ($newsCategory->news_count==0){
                $newsCategory->delete();
            }else{
                $failedCount++;
            }
        }

        if($failedCount==0){
            $status = 1;
            $msg = "The selected news categories has been deleted";
        }else{
            $status = 0;
            $msg = $failedCount."项分类删除失败:分类下仍存在新闻";
        }
        return json_encode(compact('status','msg'));//ajax
    }

    public function turnUpOrder(NewsCategory $newsCategory){
        $newsCategory->increment('order');
        return \redirect()->back()->with('tips', ['优先级已自增1']);
    }
    public function turnDownOrder(NewsCategory $newsCategory){
        $newsCategory->decrement('order');
        return \redirect()->back()->with('tips', ['优先级已自减1']);
    }

}
