<?php

namespace App\Http\Controllers;

use App\Model\NewsCarousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsCarouselController extends Controller
{
    //
    /**
     * 展示后台列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShow(){
        $newsCarousels = NewsCarousel::orderBy('order','DESC')->paginate(6);
        return view('admin.news-carousel.list',compact('newsCarousels'));
    }

    /**
     * 展示后台创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateShow(){
        return view('admin.news-carousel.create');
    }

    /**
     * 创建逻辑
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(){
        $this->authorize('create',NewsCarousel::class);

        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'title' => 'required|min:2',
            'subtitle' => 'required|min:2',
            'url' => 'required|url',
            'cover_img' => 'required',
            'order' => 'required',
        ]);
        //逻辑
        $title = \request('title');
        $subtitle = \request('subtitle');
        $url = \request('url');
        $cover_img = \request('cover_img');
        $order = \request('order');
        $data = compact('title','subtitle','url','cover_img','order','status');

        $res=NewsCarousel::create($data);

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
     * @param NewsCarousel $newsCarousel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEditShow(NewsCarousel $newsCarousel){
        return view('admin.news-carousel.edit',compact('newsCarousel'));
    }

    /**
     * 编辑逻辑
     * @param NewsCarousel $newsCarousel
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(NewsCarousel $newsCarousel){
        $this->authorize('update',$newsCarousel);

        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'title' => 'required|min:2',
            'subtitle' => 'required|min:2',
            'url' => 'required|url',
            'cover_img' => 'required',
            'order' => 'required',
        ]);
        //逻辑
        $title = \request('title');
        $subtitle = \request('subtitle');
        $url = \request('url');
        $cover_img = \request('cover_img');
        $order = \request('order');
        $data = compact('title','subtitle','url','cover_img','order','status');

        $res=$newsCarousel->update($data);

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
        $newsCarousel = NewsCarousel::where('id',$request->id)->first();
        $this->authorize('delete',$newsCarousel);

        $newsCarousel->delete();
        if($newsCarousel->trashed()){
            $status = 1;
            $msg = "The news carousel has been deleted";
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
        }
        return json_encode(compact('status','msg'));//ajax


    }

    public function turnUpOrder(NewsCarousel $newsCarousel){
        $this->authorize('manage',$newsCarousel);

        $newsCarousel->increment('order');
        return \redirect()->back()->with('tips', [__('controller.priorityUp1')]);
    }
    public function turnDownOrder(NewsCarousel $newsCarousel){
        $this->authorize('manage',$newsCarousel);

        $newsCarousel->decrement('order');
        return \redirect()->back()->with('tips', [__('controller.priorityDown1')]);
    }

    /**
     * 处理上传的封面
     * @param Request $request
     * @return string
     */
    public function uploadCover(Request $request){
        $this->authorize('uploadImgs',NewsCarousel::class);

        $user = Auth::user();
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'img_data'=>'required'
            ]);

            $image=$request->img_data;

            $realPath = decodeBase64ImgToFile($image);
            // 获取文件相关信息
            $ext = 'jpeg'; // 扩展名

            // 上传文件
            $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
//                // 如果宽大于1280 裁剪图片
            $img=Image::make($realPath);
            if ($img->width()>1000){
                $img->resize(1000, null, function($constraint){		// 调整图像的宽到1280，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }
            // 使用我们新建的uploads本地存储空间（目录）
            // 这里的userCover是配置文件的名称
            $bool = Storage::disk('newsCarousel')->put($filename, file_get_contents($realPath));
            $cover_url = "/uploads/news/carousel/" . $filename;
            if ($bool) {
                return json_encode(["status" => 1, "src" => $cover_url]);//ajax
            }

        }
    }

}
