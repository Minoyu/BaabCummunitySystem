<?php

namespace App\Http\Controllers;

use App\Model\CommunitySection;
use App\Model\CommunityZone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CommunityCategoryController extends Controller
{
    //
    public function showZonesAndSections(){
        $zones = CommunityZone::with('communitySections')->get();
        return view('admin.community-category.zones-and-sections-list',compact('zones'));
    }
    public function adminZoneCreateShow(){
        return view('admin.community-category.zone-create');
    }
    public function adminZoneStore(){
        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        //逻辑
        $name = \request('name');
        $description = \request('description');
        $img_url = \request('img_url');
        $order = \request('order');
        if ($img_url!=""){
            $data = compact('name','description','order','img_url','status');
        }else{
            $data = compact('name','description','order','status');
        }

        $res=CommunityZone::create($data);

        //渲染
        if ($res) {
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', ['社区分区' . $name . '创建成功',]);
            } else {
                return \redirect()->back()->with('tips', ['社区分区' . $name . '暂存成功',]);
            }
        }else{
            return \redirect()->back()->withErrors('创建/暂存失败,服务器内部错误,请联系管理员');
        }

    }

    public function adminZoneEditShow(CommunityZone $zone){
        return view('admin.community-category.zone-edit',compact('zone'));
    }

    public function adminZoneUpdate(CommunityZone $zone){
        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        //逻辑
        $name = \request('name');
        $description = \request('description');
        $img_url = \request('img_url');
        $order = \request('order');
        $data = compact('name','description','order','img_url','status');

        $res=$zone->update($data);
        //渲染
        if ($res) {
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', ['社区分区' . $name . '编辑成功',]);
            } else {
                return \redirect()->back()->with('tips', ['社区分区' . $name . '暂存成功',]);
            }
        }else{
            return \redirect()->back()->withErrors('编辑/暂存失败,服务器内部错误,请联系管理员');
        }

    }

    /* zone删除行为
     * @param Request $companyId
     * @return int 1 success 0 failed
     */
    public function zoneSoftDelete(Request $request){
        $zone = CommunityZone::where('id',$request->id)->first();
        $zone->delete();
        if($zone->trashed()){
            $status = 1;
            $msg = "The Zone has been deleted";
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg'));//ajax

    }

    /**
     * 后台社区板块创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminSectionCreateShow(Request $request){
        $zones = CommunityZone::all();
        $selectedZone=$request->input('zone_id');
        return view('admin.community-category.section-create',compact('zones','selectedZone'));
    }

    public function adminSectionStore(){
        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'name' => 'required',
            'description' => 'required',
            'zone_id' => 'required|integer',
        ]);
        //逻辑
        $name = \request('name');
        $description = \request('description');
        $zone_id = \request('zone_id');
        $img_url = \request('img_url');
        $order = \request('order');
        if ($img_url!=""){
            $data = compact('name','description','zone_id','order','img_url','status');
        }else{
            $data = compact('name','description','zone_id','order','status');
        }

        $res=CommunitySection::create($data);

        //渲染
        if ($res) {
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', ['社区板块' . $name . '创建成功',]);
            } else {
                return \redirect()->back()->with('tips', ['社区板块' . $name . '暂存成功',]);
            }
        }else{
            return \redirect()->back()->withErrors('创建/暂存失败,服务器内部错误,请联系管理员');
        }

    }

    public function adminSectionEditShow(CommunitySection $section){
        $zones = CommunityZone::all();
        return view('admin.community-category.section-edit',compact('section','zones')
        );
    }

    public function adminSectionUpdate(CommunitySection $section){
        $status = \request('status');
        //验证
        $this->validate(\request(), [
            'name' => 'required',
            'description' => 'required',
            'zone_id' => 'required|integer',
        ]);
        //逻辑
        $name = \request('name');
        $description = \request('description');
        $zone_id = \request('zone_id');
        $img_url = \request('img_url');
        $order = \request('order');
        $data = compact('name','description','zone_id','order','img_url','status');

        $res=$section->update($data);
        //渲染
        if ($res) {
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', ['社区板块' . $name . '编辑成功',]);
            } else {
                return \redirect()->back()->with('tips', ['社区板块' . $name . '暂存成功',]);
            }
        }else{
            return \redirect()->back()->withErrors('编辑/暂存失败,服务器内部错误,请联系管理员');
        }

    }

    /* section删除行为
     * @param Request $companyId
     * @return int 1 success 0 failed
     */
    public function sectionSoftDelete(Request $request){
        $section = CommunitySection::where('id',$request->id)->first();
        $section->delete();
        if($section->trashed()){
            $status = 1;
            $msg = "The Section has been deleted";
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg'));//ajax

    }

    public function getSectionsByZoneId(Request $request){
        $this->validate($request,[
            'id'=>'required|integer|exists:community_zones'
        ]);
        $sections = CommunityZone::where('id',$request->id)->first()->communitySections()->get();
        return json_encode(compact('sections'));
    }


    /**
     * 处理上传的新闻封面
     * @param Request $request
     * @return string
     */
    public function uploadZoneImg(Request $request)
    {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'img'=>'required|image'
            ]);
            $file = $request->file('img');
            // 文件是否上传成功
            if ($file->isValid()) {
                // 获取文件相关信息
//                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
//                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
//                // 如果宽大于1280 裁剪图片
                $img=Image::make($realPath);
                $img->fit(200)->save();
//                if ($img->width()>1280){
//                    $img->resize(1280, null, function($constraint){		// 调整图像的宽到1280，并约束宽高比(高自动)
//                        $constraint->aspectRatio();
//                    })->save();
//                }
                // 使用我们新建的uploads本地存储空间（目录）
                // 这里的userCover是配置文件的名称
                $bool = Storage::disk('communityCategoryImg')->put($filename, file_get_contents($realPath));
                $cover_url = "/uploads/community/category/img/" . $filename;
                if ($bool) {
                    return json_encode(["status" => 1, "src" => $cover_url]);//ajax
                }
            }
        }
    }

}
