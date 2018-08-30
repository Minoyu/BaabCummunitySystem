<?php

namespace App\Http\Controllers;

use App\Model\News;
use App\Model\NewsCarousel;
use App\Model\NewsCategory;
use App\Model\User;
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
                return \redirect()->back()->with('tips', ['新闻' . $title . '创建成功',]);
            } else {
                return \redirect()->back()->with('tips', ['新闻' . $title . '暂存成功',]);
            }
        }else{
            return \redirect()->back()->withErrors('创建/暂存失败,服务器内部错误,请联系管理员');
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

        $this->authorize('delete',$news);
        $news->delete();
        if($news->trashed()){
            $news->newsCategory->update(['news_count'=>$news->newsCategory->news()->count()]);
            $status = 1;
            $msg = "The news has been deleted";
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
            $msg = "The selected news has been deleted";
        }else{
            $status = 0;
            $msg = $failedCount."Server internal error";
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
        return \redirect()->back()->with('tips', ['优先级已自增1']);
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function turnDownOrder(News $news){
        $this->authorize('manage',$news);

        $news->decrement('order');
        return \redirect()->back()->with('tips', ['优先级已自减1']);
    }


    /**
     * uploadImg
     * @param Request $request
     * @return string
     */
    public function uploadImg(Request $request){
        $this->authorize('uploadImgs',News::class);

        $user = Auth::user();
        $data = [];
        $failCount=0;
        if ($request->isMethod('post')) {
            $file = $request->file('img');
            $len=0;
            foreach ($file as $key => $value) {
                $len = $key;
            }
            for ($i = 0; $i <= $len; $i++) {
                // 文件是否上传成功
                if ($file[$i]->isValid()) {
                    $this->validate($request,[
                        'img.*'=>'required|image'
                    ]);
                    // 获取文件相关信息
                    $originalName = $file[$i]->getClientOriginalName(); // 文件原名
                    $ext = $file[$i]->getClientOriginalExtension();     // 扩展名
                    $realPath = $file[$i]->getRealPath();   //临时文件的绝对路径
                    $type = $file[$i]->getClientMimeType();     // image/jpeg

                    // 上传文件
                    $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
//                // 如果宽大于900 裁剪图片
                    $img=Image::make($realPath);
                    if ($img->width()>900){
                        $img->resize(900, null, function($constraint){		// 调整图像的宽到900，并约束宽高比(高自动)
                            $constraint->aspectRatio();
                        })->save();
                    }

                    // 使用我们新建的uploads本地存储空间（目录）
                    // 这里的userCover是配置文件的名称
                    $bool = Storage::disk('newsImg')->put($filename, file_get_contents($realPath));
                    $img_url = "/uploads/news/img/" . $filename;
                    if ($bool) {
                        array_push($data,$img_url);
                    }else{
                        $failCount++;
                    }
                }
            }
            if ($failCount==0){
                return json_encode(["errno" => 0, "data" => $data]);//ajax
            }
        }
    }
    /**
     * uploadReplyImg
     * @param Request $request
     * @return string
     */
    public function uploadReplyImg(Request $request){
        $this->authorize('uploadReplyImgs',News::class);

        $user = Auth::user();
        $data = [];
        $failCount=0;
        if ($request->isMethod('post')) {
            $file = $request->file('img');
            $len=0;
            foreach ($file as $key => $value) {
                $len = $key;
            }
            for ($i = 0; $i <= $len; $i++) {
                // 文件是否上传成功
                if ($file[$i]->isValid()) {
                    $this->validate($request,[
                        'img.*'=>'required|image'
                    ]);
                    // 获取文件相关信息
                    $originalName = $file[$i]->getClientOriginalName(); // 文件原名
                    $ext = $file[$i]->getClientOriginalExtension();     // 扩展名
                    $realPath = $file[$i]->getRealPath();   //临时文件的绝对路径
                    $type = $file[$i]->getClientMimeType();     // image/jpeg

                    // 上传文件
                    $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
//                // 如果宽大于900 裁剪图片
                    $img=Image::make($realPath);
                    if ($img->width()>600){
                        $img->resize(600, null, function($constraint){		// 调整图像的宽到900，并约束宽高比(高自动)
                            $constraint->aspectRatio();
                        })->save();
                    }

                    // 使用我们新建的uploads本地存储空间（目录）
                    // 这里的userCover是配置文件的名称
                    $bool = Storage::disk('newsReplyImg')->put($filename, file_get_contents($realPath));
                    $img_url = "/uploads/news/reply/img/" . $filename;
                    if ($bool) {
                        array_push($data,$img_url);
                    }else{
                        $failCount++;
                    }
                }
            }
            if ($failCount==0){
                return json_encode(["errno" => 0, "data" => $data]);//ajax
            }
        }
    }

    /**
     * 处理上传的新闻封面
     * @param Request $request
     * @return string
     */
    public function uploadCover(Request $request){
        $this->authorize('uploadImgs',News::class);

        $user = Auth::user();
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'cover'=>'required|image'
            ]);
            $file = $request->file('cover');
            // 文件是否上传成功
            if ($file->isValid()) {
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

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



}
