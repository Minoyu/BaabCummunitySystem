<?php

namespace App\Http\Controllers;

use App\Model\News;
use App\Model\NewsCarousel;
use App\Model\NewsCategory;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    //

    /**
     * 显示新闻首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function showNews(Request $request){
        $newses = News::where('status','publish')
            ->where('invalided_at',null)
            ->orWhere('invalided_at','>',Carbon::now())
            ->orderBy('order','desc')
            ->with('newsCategory')
            ->paginate(10);

        if ($request->ajax()) {
            $view = view('news.left-list-data',compact('newses'))->render();
            return response()->json(['html'=>$view]);
        }else{
            $newsCategories = NewsCategory::where('status','publish')
                ->orderBy('order','desc')
                ->get();
            $newsCarousels = NewsCarousel::where('status','publish')
                ->orderBy('order','desc')
                ->get();
            return view('news',compact('newsCategories','newses','newsCarousels'));
        }
    }

    /**
     * 显示新闻二级页
     * @param NewsCategory $cat
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function showNewsSec(NewsCategory $cat,Request $request)
    {
        $newses = $cat->news()
            ->where('status','publish')
            ->where('invalided_at',null)
            ->orWhere('invalided_at','>',Carbon::now())
            ->orderBy('order','desc')
            ->paginate(15);
        if ($request->ajax()) {
            $view = view('news-sec.list-data', compact('newses'))->render();
            return response()->json(['html' => $view]);
        }else{
            $newsCategories = NewsCategory::where('status','publish')
                ->orderBy('order','desc')
                ->get();
            return view('news-sec', compact('newses','cat','newsCategories'));
        }
    }


    /**
     * 显示新闻内容
     * @param News $news
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function showNewsContent(News $news,Request $request){
        $news->increment('view_count');
        $cat = $news->newsCategory;
        $newsCategories = NewsCategory::all();
        $orderBy = $request->input('orderBy');
        switch ($orderBy){
            case 'thumb_up':
                $replies = $news->replies()
                    ->orderBy('thumb_up_count','desc')
                    ->orderBy('created_at','desc')
                    ->with('user.info')
                    ->paginate(10);;
                break;
            default:
                $replies = $news->replies()
                    ->orderBy('created_at','desc')
                    ->with('user.info')
                    ->paginate(10);;
                break;
        }

        if ($request->ajax()) {
            $view = view('news-content.comment-data', compact('replies','news'))->render();
            return response()->json(['html' => $view]);
        }
        return view('news-content',compact('news','cat','newsCategories','replies','orderBy'));
        }


    /**
     * 后台新闻列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShow(Request $request){
        $selectedCategory = false;
        if($request->input('category_id')){
            $newsCategory = NewsCategory::findOrFail($request->input('category_id'));
            $newses=$newsCategory->news()
                ->with('user','newsCategory')
                ->orderBy('order','desc')
                ->orderBy('created_at','desc')
                ->paginate(15);
            $selectedCategory = true;
        }else{
            $newses=News::with('user','newsCategory')
                ->orderBy('order','desc')
                ->orderBy('created_at','desc')
                ->paginate(15);
        }
        return view('admin.news.list',compact('newses','selectedCategory','newsCategory'));
    }

    /**
     * 后台创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateShow(){
        $newsCategories = NewsCategory::all();
        return view('admin.news.create',compact('newsCategories'));
    }

    /**
     * 后台存储
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(){
        $this->authorize('create',News::class);

        $status = \request('status');
        //发布验证 暂存不验证
//        if($status=='publish') {
            //验证
        $this->validate(\request(), [
            'title' => 'required',
            'content' => 'required',
            'news_category_id' => 'required|integer|exists:news_categories,id',
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
        $res=News::create($data);

        //渲染
        if ($res) {
            $res->newsCategory->update(['news_count'=>$res->newsCategory->news()->count()]);
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
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEditShow(News $news){
        $newsCategories = NewsCategory::all();
        return view('admin.news.edit',compact('news','newsCategories'));
    }

    /**
     * @param News $news
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(News $news){
        $oldCategory = $news->newsCategory;
        $this->authorize('update',$news);

        $status = \request('status');
        //发布验证 暂存不验证
//        if($status=='publish') {
        //验证
        $this->validate(\request(), [
            'title' => 'required',
            'content' => 'required',
            'news_category_id' => 'required|integer|exists:news_categories,id',
        ]);
//        }
        //逻辑
        $title = \request('title');
        $content = \request('content');
        $cover_img = \request('cover_img');
        $news_category_id = \request('news_category_id');
        $order = \request('order');
        $invalided_at = \request('invalided_at');
        $data = compact('title','content','cover_img','news_category_id','order','invalided_at','status');

//        dd($data);
        $res=News::where('id',$news->id)->update($data);

        //渲染
        if ($res) {
            $oldCategory->update(['news_count'=>$oldCategory->news()->count()]);
            $news->newsCategory->update(['news_count'=>$news->newsCategory->news()->count()]);
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
        $news = News::where('id',$request->id)->first();

        $this->authorize('delete',$news);
        $news->delete();
        if($news->trashed()){
            $news->newsCategory->update(['news_count'=>$news->newsCategory->news()->count()]);
            $status = 1;
            $msg = __('controller.deleteSuccess');
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
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
            $news = News::where('id',$request->ids[$i])->first();
            $this->authorize('delete',$news);
            $news->delete();
            $news->newsCategory->update(['news_count'=>$news->newsCategory->news()->count()]);
            if(!$news->trashed()){
                $failedCount++;
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

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function turnUpOrder(News $news){
        $this->authorize('manage',$news);

        $news->increment('order');
        return \redirect()->back()->with('tips', [__('controller.priorityUp1')]);
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function turnDownOrder(News $news){
        $this->authorize('manage',$news);

        $news->decrement('order');
        return \redirect()->back()->with('tips', [__('controller.priorityDown1')]);
    }


    /**
     * uploadImg
     * @param Request $request
     * @return false|string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function uploadImg(Request $request)
    {
        $this->authorize('uploadImgs',News::class);

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
            // 如果宽大于1280 裁剪图片
            $img=Image::make($realPath);
            if ($img->width()>1280){
                $img->resize(1280, null, function($constraint){		// 调整图像的宽到1280，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }
            $width = $img ->width();
            $height = $img ->height();
            $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '@'.$width.'x'.$height .'@' . uniqid() . '.' . $ext;
            //存储大图
            Storage::disk('newsImg')->put($filename, file_get_contents($realPath));

            //图片压缩处理缩略图
            $smallImg = Image::make($realPath);
            if ($smallImg->width()>400) {
                $smallImg->resize(400, null, function ($constraint) {        // 调整图像的宽到400，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }

            $s_filename = 's-'.$filename;
            // 使用communityTopicImg本地存储空间（目录）
            Storage::disk('newsImg')->put($s_filename, file_get_contents($realPath));

            $img_url = "/uploads/news/img/" . $filename;
            $simg_url = "/uploads/news/img/" . $s_filename;
            $size = $width . 'x' . $height ;
            return json_encode(["status" => 1, "link" => $img_url, "slink" => $simg_url, "size" => $size]);//ajax
        }
    }

    /**
     * uploadReplyImg
     * @param Request $request
     * @return false|string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function uploadReplyImg(Request $request)
    {
        $this->authorize('uploadReplyImgs',News::class);

        $user = Auth::user();
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'img_data'=>'required'
            ]);

            $image=$request->img_data;
            $imageName = "tmpImg-".$user->id . '-' . date('Y-m-d-H-i-s') . '-' . uniqid() .'.jpeg';
            if (strstr($image,",")){
                $image = explode(',',$image);
                $image = $image[1];
            }
            Storage::disk('base64ImgTmp')->put($imageName, base64_decode($image));
            $realPath= public_path()."/uploads/tmp/base64Img/". $imageName;  //图片名字

            // 获取文件相关信息
            $ext = 'jpeg'; // 扩展名

            // 上传文件
            // 如果宽大于1280 裁剪图片
            $img=Image::make($realPath);
            if ($img->width()>1280){
                $img->resize(1280, null, function($constraint){		// 调整图像的宽到1280，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }
            $width = $img ->width();
            $height = $img ->height();
            $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '@'.$width.'x'.$height .'@' . uniqid() . '.' . $ext;
            //存储大图
            Storage::disk('newsReplyImg')->put($filename, file_get_contents($realPath));

            //图片压缩处理缩略图
            $smallImg = Image::make($realPath);
            if ($smallImg->width()>400) {
                $smallImg->resize(400, null, function ($constraint) {        // 调整图像的宽到400，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }

            $s_filename = 's-'.$filename;
            // 使用communityTopicImg本地存储空间（目录）
            Storage::disk('newsReplyImg')->put($s_filename, file_get_contents($realPath));

            $img_url = "/uploads/news/reply/img/" . $filename;
            $simg_url = "/uploads/news/reply/img/" . $s_filename;
            $size = $width .'x' . $height ;
            return json_encode(["status" => 1, "link" => $img_url, "slink" => $simg_url, "size" => $size]);//ajax
        }
    }

    /**
     * 处理上传的新闻封面
     * @param Request $request
     * @return false|string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function uploadCover(Request $request){
        $this->authorize('uploadImgs',News::class);

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
            if ($img->width()>1280){
                $img->resize(1280, null, function($constraint){		// 调整图像的宽到1280，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }
            // 使用我们新建的uploads本地存储空间（目录）
            // 这里的userCover是配置文件的名称
            $bool = Storage::disk('newsCover')->put($filename, file_get_contents($realPath));
            $cover_url = "/uploads/news/cover/" . $filename;
            if ($bool) {
                return json_encode(["status" => 1, "src" => $cover_url]);//ajax
            }
        }
    }



}
