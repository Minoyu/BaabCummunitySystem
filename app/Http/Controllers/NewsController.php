<?php

namespace App\Http\Controllers;

use App\Model\News;
use App\Model\NewsCategory;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    //
    public function showNews(){
        return view('news');
    }
    public function showNewsSec(){
        return view('news-sec');
    }
    public function showNewsContent(){
        return view('news-content');
    }


    public function adminListShow(){
        $newses=News::paginate(10);
        return view('admin.news.list',compact('newses'));
    }
    public function adminCreateShow(){
        $newsCategories = NewsCategory::all();
        return view('admin.news.create',compact('newsCategories'));
    }
    public function store(){

    }
    public function adminEditShow(){

    }
    public function update(){

    }
    public function softDelete(){

    }
    public function softDeletes(){

    }

    /**
     * uploadImg
     * @param Request $request
     * @return string
     */
    public function uploadImg(Request $request)
    {
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


}
