<?php

namespace App\Http\Controllers;

use App\Model\CommunitySection;
use App\Model\CommunityTopic;
use App\Model\CommunityZone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\Activitylog\Models\Activity;

class CommunityTopicController extends Controller
{
    //

    /**
     * ajax获得投票者
     * @param Request $request
     * @return string
     */
    public function ajaxGetVoters(Request $request){
        //验证
        $this->validate($request, [
            'id' => 'required|exists:community_topics',
        ]);
        $voters = CommunityTopic::find($request->id)->voters()->with('info')->get();

        if ($voters){
            $status = 1;
            $html = view('community-content.voters-data', compact('voters'))->render();
            return json_encode(compact('status','html'));//ajax
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
            return json_encode(compact('status','msg'));//ajax
        }
    }

    /**
     * 投票逻辑
     * @param Request $request
     * @return string
     */
    public function handleAjaxVote(Request $request){
        //验证
        $this->validate($request, [
            'id' => 'required|exists:community_topics',
        ]);
        $topic = CommunityTopic::find($request->id);
        if (Auth::user()->upVote($topic)){
            $thumb_up_count = $topic->countVoters();
            $topic->update(compact('thumb_up_count'));
            $status = 1;

            //记录动态
            $userId = Auth::id();
            $userName = Auth::user()->name;
            $userAvatar = Auth::user()->info->avatar_url;
            $topicTitle = $topic->title;
            $topicId = $topic->id;
            $event = 'communityTopic.voted';
            activity()->on($topic)
                ->withProperties(compact('userId','userName','userAvatar','topicId','topicTitle','event'))
                ->log('点赞了社区话题');
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
        }
        return json_encode(compact('status','msg','thumb_up_count'));//ajax
    }

    /**
     * 取消投票逻辑
     * @param Request $request
     * @return string
     */
    public function handleAjaxCancelVote(Request $request){
        //验证
        $this->validate($request, [
            'id' => 'required|exists:community_topics',
        ]);
        $topic = CommunityTopic::find($request->id);
        if (Auth::user()->cancelVote($topic)){

            //删除动态
            Activity::where([
                ['subject_id', $topic->id],
                ['subject_type', 'App\Model\CommunityTopic'],
                ['causer_id', Auth::id()],
                ['description', '点赞了社区话题'],
            ])->delete();

            $thumb_up_count = $topic->countVoters();
            $topic->update(compact('thumb_up_count'));
            $status = 1;
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
        }
        return json_encode(compact('status','msg','thumb_up_count'));//ajax

    }

    /**
     * 显示前台创建话题页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request){
        $this->authorize('create',CommunityTopic::class);

        $zones = CommunityZone::orderBy('order','desc')->get();
        if($request->input('zone_id')&&$request->input('section_id')){
            $zone_id = $request->input('zone_id');
            $section_id = $request->input('section_id');
            $selectedSections = CommunityZone::where('id',$zone_id)->first()->communitySections;
        }
        if($request->input('zone_id')){
            $zone_id = $request->input('zone_id');
            $selectedSections = CommunityZone::where('id',$zone_id)->first()->communitySections;
        }
        return view('community-create-topic',compact('zones','zone_id','section_id','selectedSections'));
    }

    /**
     * 显示前台话题编辑页面
     * @param CommunityTopic $topic
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CommunityTopic $topic,Request $request){
        $this->authorize('update',$topic);

        $zones = CommunityZone::orderBy('order','desc')->get();
        $selectedSections = CommunityZone::where('id',$topic->zone_id)->first()->communitySections;

        return view('community-edit-topic',compact('topic','zones','selectedSections'));
    }

    /**
     * 后台通过分类展示话题页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShowByCategory(){
        $zones = CommunityZone::orderBy('order','desc')->with('communitySections')->get();
        return view('admin.community-topic.show-by-category',compact('zones'));
    }

    /**
     * 后台展示话题列表页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminListShow(Request $request){
        $selectedSection = false;
        if ($request->input('section_id')){
            $topics=CommunityTopic::where('section_id',$request->input('section_id'))
                ->with('user','communitySection')
                ->orderBy('order','desc')
                ->orderBy('created_at','desc')
                ->paginate(15);
            $section = CommunitySection::find($request->input('section_id'));
            $selectedSection=true;
        }else{
            $topics=CommunityTopic::orderBy('order','desc')
                ->orderBy('created_at','desc')
                ->with('user','communitySection')
                ->paginate(15);
        }
        return view('admin.community-topic.list',compact('topics','section','selectedSection'));
    }

    /**
     * 后台显示创建话题页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateShow(Request $request){
        $zones = CommunityZone::orderBy('order','desc')->get();
        if($request->input('zone_id')&&$request->input('section_id')){
            $zone_id = $request->input('zone_id');
            $section_id = $request->input('section_id');
            $selectedSections = CommunityZone::where('id',$zone_id)->first()->communitySections;
        }
        return view('admin.community-topic.create',compact('zones','zone_id','section_id','selectedSections'));
    }

    /**
     * 后台话题创建逻辑
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(){
        $this->authorize('create',CommunityTopic::class);

        $status = \request('status');
        //发布验证 暂存不验证
//        if($status=='publish') {
        //验证
        $messages = [
            'zone_id.required' => __('community.zoneNotSelect'),
            'zone_id.integer' =>  __('community.zoneNotSelect'),
            'section_id.required' =>  __('community.sectionNotSelect'),
            'section_id.integer' =>  __('community.sectionNotSelect'),
        ];
        $this->validate(\request(), [
            'title' => 'required',
            'content' => 'required',
            'zone_id' => 'required|integer|exists:community_zones,id',
            'section_id' => 'required|integer|exists:community_sections,id',
        ],$messages);
//        }
        //逻辑
        $title = \request('title');
        $zone_id = \request('zone_id');
        $section_id = \request('section_id');
        $content = \request('content');
        $order = \request('order');
        $user_id = Auth::id();
        $last_reply_at = Carbon::now();
        $data = compact('title','zone_id','section_id','content','user_id','order','status','last_reply_at');

        $res=CommunityTopic::create($data);

        //渲染
        if ($res) {
            CommunityZone::find($zone_id)->increment('topic_count');
            CommunitySection::find($section_id)->increment('topic_count');
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
     * 前台话题创建逻辑
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function storeMini(){
        $this->authorize('create',CommunityTopic::class);

        $status = \request('status');
        //验证
        $messages = [
            'zone_id.required' => __('community.zoneNotSelect'),
            'zone_id.integer' =>  __('community.zoneNotSelect'),
            'section_id.required' =>  __('community.sectionNotSelect'),
            'section_id.integer' =>  __('community.sectionNotSelect'),
        ];
        $this->validate(\request(), [
            'title' => 'required',
            'content' => 'required',
            'zone_id' => 'required|integer|exists:community_zones,id',
            'section_id' => 'required|integer|exists:community_sections,id',
        ],$messages);
        //逻辑
        $title = \request('title');
        $zone_id = \request('zone_id');
        $section_id = \request('section_id');
        $content = \request('content');
        $user_id = Auth::id();
        $last_reply_at = Carbon::now();
        $data = compact('title','zone_id','section_id','content','user_id','last_reply_at','status');

        $res=CommunityTopic::create($data);

        //渲染
        if ($res) {
            CommunityZone::find($zone_id)->increment('topic_count');
            CommunitySection::find($section_id)->increment('topic_count');
            if ($status == 'publish') {
                return \redirect()->route('showCommunitySection', $section_id)->with('tips', [__('controller.createSuccess',['name'=>$title]),]);
            }else{
                return \redirect()->route('showCommunityContent', $res->id)->with('tips', [__('controller.saveTopicSuccess'),]);
            }
        }else{
            return \redirect()->back()->withErrors(__('controller.failedServerError'));
        }
    }

    /**
     * 后台编辑显示
     * @param CommunityTopic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEditShow(CommunityTopic $topic){
        $zones = CommunityZone::orderBy('order','desc')->get();
        $selectedSections = CommunityZone::where('id',$topic->zone_id)->first()->communitySections;

        return view('admin.community-topic.edit',compact('topic','zones','selectedSections'));
    }

    /**
     * 后台更新逻辑
     * @param CommunityTopic $topic
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(CommunityTopic $topic){
        $this->authorize('update',$topic);

        //获取旧分类id
        $old_zone_id = $topic->zone_id;
        $old_section_id = $topic->section_id;

        $status = \request('status');
        //发布验证 暂存不验证
//        if($status=='publish') {
        //验证
        $this->validate(\request(), [
            'title' => 'required',
            'content' => 'required',
            'zone_id' => 'required|integer|exists:community_zones,id',
            'section_id' => 'required|integer|exists:community_sections,id',
        ]);
//        }
        //逻辑
        $title = \request('title');
        $zone_id = \request('zone_id');
        $section_id = \request('section_id');
        $content = \request('content');
        $order = \request('order');
        $data = compact('title','zone_id','section_id','content','user_id','order','status');

        $res=$topic->update($data);

        //渲染
        if ($res) {
            //旧分类计数器更新
            CommunityZone::find($old_zone_id)->update(['topic_count'=>CommunityTopic::where('zone_id',$old_zone_id)->count()]);
            CommunitySection::find($old_section_id)->update(['topic_count'=>CommunityTopic::where('section_id',$old_section_id)->count()]);
            //新分类计数器更新
            CommunityZone::find($zone_id)->update(['topic_count'=>CommunityTopic::where('zone_id',$zone_id)->count()]);
            CommunitySection::find($section_id)->update(['topic_count'=>CommunityTopic::where('section_id',$section_id)->count()]);
            if ($status == 'publish') {
                return \redirect()->back()->with('tips', [__('controller.editSuccess',['name'=>$title]),]);
            } else {
                return \redirect()->back()->with('tips', [__('controller.saveSuccess',['name'=>$title]),]);
            }
        }else{
            return \redirect()->back()->withErrors(__('controller.failedServerError'));
        }
    }

    /**
     * 前台更新逻辑
     * @param CommunityTopic $topic
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updateMini(CommunityTopic $topic){
        $this->authorize('update',$topic);

        //获取旧分类id
        $old_zone_id = $topic->zone_id;
        $old_section_id = $topic->section_id;

        $status = \request('status');
        //发布验证 暂存不验证
//        if($status=='publish') {
        //验证
        $this->validate(\request(), [
            'title' => 'required',
            'content' => 'required',
            'zone_id' => 'required|integer|exists:community_zones,id',
            'section_id' => 'required|integer|exists:community_sections,id',
        ]);
//        }
        //逻辑
        $title = \request('title');
        $zone_id = \request('zone_id');
        $section_id = \request('section_id');
        $content = \request('content');
        $data = compact('title','zone_id','section_id','content','status');

        $res=$topic->update($data);

        //渲染
        if ($res) {
            //旧分类计数器更新
            CommunityZone::find($old_zone_id)->update(['topic_count'=>CommunityTopic::where('zone_id',$old_zone_id)->count()]);
            CommunitySection::find($old_section_id)->update(['topic_count'=>CommunityTopic::where('section_id',$old_section_id)->count()]);
            //新分类计数器更新
            CommunityZone::find($zone_id)->update(['topic_count'=>CommunityTopic::where('zone_id',$zone_id)->count()]);
            CommunitySection::find($section_id)->update(['topic_count'=>CommunityTopic::where('section_id',$section_id)->count()]);
            if ($status == 'publish') {
                return \redirect()->route('showCommunitySection', $section_id)->with('tips', [__('controller.saveSuccess',['name'=>$title]),]);
            } else {
                return \redirect()->route('showCommunityContent', $topic->id)->with('tips', [__('controller.saveTopicSuccess')]);
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
        $topic = CommunityTopic::where('id',$request->id)->first();
        $this->authorize('delete',$topic);

        $topic->delete();
        if($topic->trashed()){
            $topic->communityZone()->decrement('topic_count');
            $topic->communitySection()->decrement('topic_count');
            $status = 1;
            $msg = __('controller.deleteSuccess');
        }else{
            $status = 0;
            $msg = __('controller.failedServerError');
        }
        return json_encode(compact('status','msg'));//ajax

    }

    /**
     * 话题批量删除行为
     * @param Request $request
     * @return false|string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function softDeletes(Request $request){
        $failedCount=0;
        for($i=0;$i<count($request->ids);$i++){
            $topic = CommunityTopic::where('id',$request->ids[$i])->first();
            $this->authorize('delete',$topic);

            $topic->delete();
            if(!$topic->trashed()){
                $failedCount++;
            }else{
                $topic->communityZone()->decrement('topic_count');
                $topic->communitySection()->decrement('topic_count');
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
     * 提高排序
     * @param CommunityTopic $topic
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function turnUpOrder(CommunityTopic $topic){
        $this->authorize('manage',$topic);

        $topic->increment('order');
        return \redirect()->back()->with('tips', [__('controller.priorityUp1')]);
    }

    /**
     * 降低排序
     * @param CommunityTopic $topic
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function turnDownOrder(CommunityTopic $topic){
        $this->authorize('manage',$topic);

        $topic->decrement('order');
        return \redirect()->back()->with('tips', [__('controller.priorityDown1')]);
    }

    /**
     * 切换是否精华
     * @param CommunityTopic $topic
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function toggleExcellent(CommunityTopic $topic){
        $this->authorize('manage',$topic);
        if (!$topic->is_excellent){
            $topic->update(['is_excellent'=> true]);
            return \redirect()->back()->with('tips', [__('controller.excellentSuccess')]);
        }else{
            $topic->update(['is_excellent'=> false]);
            return \redirect()->back()->with('tips', [__('controller.unexcellentSuccess')]);
        }
    }


    /**
     * uploadTopicImg
     * @param Request $request
     * @return false|string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function uploadImg(Request $request)
    {
        $this->authorize('uploadImgs',CommunityTopic::class);

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
                $img->resize(1280, null, function($constraint){		// 调整图像的宽到900，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }
            $width = $img ->width();
            $height = $img ->height();
            $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '@'.$width.'x'.$height .'@' . uniqid() . '.' . $ext;
            //存储大图
            Storage::disk('communityTopicImg')->put($filename, file_get_contents($realPath));

            //图片压缩处理缩略图
            $smallImg = Image::make($realPath);
            if ($smallImg->width()>500) {
                $smallImg->resize(500, null, function ($constraint) {        // 调整图像的宽到500，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }
            $s_filename = 's-'.$filename;
            // 使用communityTopicImg本地存储空间（目录）
            Storage::disk('communityTopicImg')->put($s_filename, file_get_contents($realPath));

            $img_url = "/uploads/community/topic/img/" . $filename;
            $simg_url = "/uploads/community/topic/img/" . $s_filename;
            $size = $width .'x' . $height ;
            return json_encode(["status" => 1, "link" => $img_url, "slink" => $simg_url, "size" => $size]);//ajax
        }
    }

    public function uploadReplyImg(Request $request)
    {
        $this->authorize('uploadImgs',CommunityTopic::class);

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
            Storage::disk('communityTopicImg')->put($filename, file_get_contents($realPath));

            //图片压缩处理缩略图
            $smallImg = Image::make($realPath);
            if ($smallImg->width()>400) {
                $smallImg->resize(400, null, function ($constraint) {        // 调整图像的宽到500，并约束宽高比(高自动)
                    $constraint->aspectRatio();
                })->save();
            }

            $s_filename = 's-'.$filename;
            // 使用communityTopicImg本地存储空间（目录）
            Storage::disk('communityTopicImg')->put($s_filename, file_get_contents($realPath));

            $img_url = "/uploads/community/topic/img/" . $filename;
            $simg_url = "/uploads/community/topic/img/" . $s_filename;
            $size = $width .'x' . $height ;
            return json_encode(["status" => 1, "link" => $img_url, "slink" => $simg_url, "size" => $size]);//ajax
        }
    }

}
