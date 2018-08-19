<?php

namespace App\Http\Controllers;

use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
use App\Model\NewsReply;
use App\Model\User;
use App\Model\UserInfo;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    //

    public function ajaxGetFollowings(Request $request){
        //验证
        $this->validate($request, [
            'id' => 'required|exists:users',
        ]);
        $users = User::find($request->id)->followings()->with('info')->get();

        if ($users){
            $status = 1;
            $html = view('personal-center.followings-dialog-data', compact('users'))->render();
            return json_encode(compact('status','html'));//ajax
        }else{
            $status = 0;
            $msg = "Server internal error";
            return json_encode(compact('status','msg'));//ajax
        }
    }
    public function ajaxGetFollowers(Request $request){
        //验证
        $this->validate($request, [
            'id' => 'required|exists:users',
        ]);
        $users = User::find($request->id)->followers()->with('info')->get();

        if ($users){
            $status = 1;
            $html = view('personal-center.followers-dialog-data', compact('users'))->render();
            return json_encode(compact('status','html'));//ajax
        }else{
            $status = 0;
            $msg = "Server internal error";
            return json_encode(compact('status','msg'));//ajax
        }
    }

    public function handleAjaxFollow(Request $request){
        //验证
        $this->validate($request, [
            'id' => 'required|exists:users',
        ]);
        $user = User::find($request->id);
        if (Auth::user()->follow($user)){
            $follower_count = $user->followers()->count();
            $status = 1;
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg','follower_count'));//ajax
    }

    public function handleAjaxUnfollow(Request $request){
        //验证
        $this->validate($request, [
            'id' => 'required|exists:users',
        ]);
        $user = User::find($request->id);
        if (Auth::user()->unfollow($user)){
            $follower_count = $user->followers()->count();
            $status = 1;
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg','follower_count'));//ajax

    }


    public function showPersonalCenter(User $user,Request $request){
        $user->load('info');
        $view = $request->view;
        if ($user->id ==Auth::id()) {
            $userIsMe = true;
        }else{
            $userIsMe = false;
        }
        $followersCount = $user->followers()->count();
        $followingsCount = $user->followings()->count();
        switch ($view) {
            case 'topics':
                if ($userIsMe){
                    $topics = $user
                        ->communityTopics()
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
                }else{
                    $topics = $user
                        ->communityTopics()
                        ->where('status','publish')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
                }
                if ($request->ajax()) {
                    $html = view('personal-center.left-topic-data',compact('topics'))->render();
                    return json_encode(compact('html'));
                }
                break;
            case 'voted':
                $votedTopics = $user
                    ->votedItems(CommunityTopic::class)
                    ->get();
                $votedTopicReplies = $user
                    ->votedItems(CommunityTopicReply::class)
                    ->get();
                $votedNewsReply = $user
                    ->votedItems(NewsReply::class)
                    ->get();
                $page = 1;
                if( !empty($request->page) ) {
                    $page = $request->page;
                }
                $perPage = 15;
                $votes = $votedTopics
                ->concat($votedNewsReply)
                ->concat($votedTopicReplies)
                ->sortByDesc('created_at')
                ->forPage($page,$perPage);

                if ($request->ajax()) {
                    $html = view('personal-center.left-voted-data',compact('votes','user'))->render();
                    return json_encode(compact('html'));
                }

                break;

            case 'replies':
                $newsReplies = $user
                    ->newsReplies()
                    ->with('news')
                    ->get();
                $CommunityReplies = $user
                    ->communityTopicReplies()
                    ->with('communityTopic')
                    ->get();
                $replies = $newsReplies
                    ->concat($CommunityReplies)
                    ->sortByDesc('created_at');
                //分页

                $page = 1;
                if( !empty($request->page) ) {
                    $page = $request->page;
                }
                $perPage = 15;
                $offset = (($page - 1) * $perPage);

                $replies = new LengthAwarePaginator(
                    $replies->slice($offset,$perPage, true)->all(),
                    $replies->count(),
                    $page);

                if ($request->ajax()) {
                    $html = view('personal-center.left-reply-data',compact('replies','user'))->render();
                    return json_encode(compact('html'));
                }
                break;
            default:
                //我的动态
                $activities = Activity::where('causer_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                if ($request->ajax()) {
                    $html = view('personal-center.left-activity-data',compact('activities','user'))->render();
                    return json_encode(compact('html'));
                }
                break;
        }

        return view('personal-center',compact(
            'user',
            'userIsMe',
            'followersCount',
            'followingsCount',
            'view',
            'activities',
            'topics',
            'replies',
            'votes'
        ));
    }

    /**
     * 更新个人用户信息
     * @param User $user
     * @param Request $request
     * @return string
     */
    public function updateUserInfo(User $user,Request $request)
    {
        //用户验证权限
        $this->authorize('updateUserInfo', $user);
        //验证
        $this->validate($request, [
            'name' => 'required',
        ]);

        //逻辑
        $name = $request->name;
        $sex = $request->sex;
        $sex_open = $request->sex_open;
        $motto = $request->motto;
        $wechat = $request->wechat;
        $wechat_open = $request->wechat_open;
        $nation = $request->nation;
        $nation_open = $request->nation_open;
        $living_city = $request->living_city;
        $living_city_open = $request->living_city_open;
        $engaged_in = $request->engaged_in;
        $engaged_in_open = $request->engaged_in_open;

        $userRes = $user->update(compact(
            'name'
        ));
        $userInfoRes = $user->info->update(compact(
            'sex',
            'sex_open',
            'motto',
            'wechat',
            'wechat_open',
            'nation',
            'nation_open',
            'living_city',
            'living_city_open',
            'engaged_in',
            'engaged_in_open'
        ));

        //渲染
        if ($userRes && $userInfoRes) {
            $status = 1;
            $msg = 'Update user info successful';
        } else {
            $status = 0;
            $msg = 'Update user info failed';
        }
        return json_encode(compact('status', 'msg'));
    }

    /**
     * 提示更新个人用户信息
     * @param User $user
     * @param Request $request
     * @return string
     */

    public function helpUpdateUserWechat(User $user,Request $request){
        //用户验证权限
        $this->authorize('updateUserInfo',$user);

        //逻辑
        $wechat = $request->wechat;
        $wechat_open = $request->wechat_open? 'true':'false';

        $userInfoRes = $user->info->update(compact(
            'wechat',
            'wechat_open'
        ));

        //渲染
        if ($userInfoRes) {
            return \redirect()->back()->with('tips', ['微信更新成功',]);
        } else {
            return \redirect()->back()->withErrors('更新失败,服务器内部错误,请联系管理员');
        }

    }
    public function helpUpdateUserLivingCity(User $user,Request $request){
        //用户验证权限
        $this->authorize('updateUserInfo',$user);

        //逻辑
        $living_city = $request->living_city;
        $living_city_open = $request->living_city_open? 'true':'false';

        $userInfoRes = $user->info->update(compact(
            'living_city',
            'living_city_open'
        ));

        //渲染
        if ($userInfoRes) {
            return \redirect()->back()->with('tips', ['现居城市更新成功',]);
        } else {
            return \redirect()->back()->withErrors('更新失败,服务器内部错误,请联系管理员');
        }

    }
    public function helpUpdateUserNation(User $user,Request $request){
        //用户验证权限
        $this->authorize('updateUserInfo',$user);

        //逻辑
        $nation = $request->nation;
        $nation_open = $request->nation_open? 'true':'false';

        $userInfoRes = $user->info->update(compact(
            'nation',
            'nation_open'
        ));

        //渲染
        if ($userInfoRes) {
            return \redirect()->back()->with('tips', ['国家更新成功',]);
        } else {
            return \redirect()->back()->withErrors('更新失败,服务器内部错误,请联系管理员');
        }

    }
    public function helpUpdateUserEngaged(User $user,Request $request){
        //用户验证权限
        $this->authorize('updateUserInfo',$user);

        //逻辑
        $engaged_in = $request->engaged_in;
        $engaged_in_open = $request->engaged_in_open? 'true':'false';

        $userInfoRes = $user->info->update(compact(
            'engaged_in',
            'engaged_in_open'
        ));

        //渲染
        if ($userInfoRes) {
            return \redirect()->back()->with('tips', ['职业/从事行业更新成功',]);
        } else {
            return \redirect()->back()->withErrors('更新失败,服务器内部错误,请联系管理员');
        }

    }

    public function helpUpdateUserMotto(User $user,Request $request){
        //用户验证权限
        $this->authorize('updateUserInfo',$user);

        //逻辑
        $motto = $request->motto;

        $userInfoRes = $user->info->update(compact(
            'motto'
        ));

        //渲染
        if ($userInfoRes) {
            return \redirect()->back()->with('tips', ['一句话介绍更新成功',]);
        } else {
            return \redirect()->back()->withErrors('更新失败,服务器内部错误,请联系管理员');
        }

    }

    public function helpUpdateClose(User $user){
        //用户验证权限
        $this->authorize('updateUserInfo',$user);

        //逻辑
        $help_tip_open = false;

        $userInfoRes = $user->info->update(compact(
            'help_tip_open'
        ));

        //渲染
        if($userInfoRes){
            $status = 1;
            $msg = "引导已关闭";
        }else{
            $status = 0;
            $msg = "更新失败,服务器内部错误,请联系管理员";
        }
    return json_encode(compact('status','msg'));//ajax

}

    /**
     * 处理用户上传的头像
     * @param User $user
     * @param Request $request
     * @return string
     */
    public function uploadAvatar(User $user,Request $request)
    {
        //用户验证权限
        $this->authorize('uploadAvatar',$user);
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'avatar'=>'required|image'
            ]);
            $file = $request->file('avatar');
            // 文件是否上传成功
            if ($file->isValid()) {
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = $user->id . '-' . date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 裁剪图片 生成200x200的缩略图
                Image::make($realPath)->fit(200)->save();
                // 使用我们新建的uploads本地存储空间（目录）
                // 这里的userAvatar是配置文件的名称
                $bool = Storage::disk('userAvatar')->put($filename, file_get_contents($realPath));
                $avatar_url = "/uploads/avatar/" . $filename;
                if ($bool) {
                    UserInfo::where('user_id', $user->id)->update(compact('avatar_url'));
                }
                return json_encode(["status" => 1, "src" => $avatar_url]);//ajax
            }
        }
    }
    /**
     * 处理用户上传的封面
     * @param User $user
     * @param Request $request
     * @return string
     */
    public function uploadCover(User $user,Request $request)
    {
        //用户验证权限
        $this->authorize('uploadCover',$user);
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
                    $img->resize(1280, null, function($constraint){		// 调整图像的宽到900，并约束宽高比(高自动)
                        $constraint->aspectRatio();
                    })->save();
                }
                // 使用我们新建的uploads本地存储空间（目录）
                // 这里的userCover是配置文件的名称
                $bool = Storage::disk('userCover')->put($filename, file_get_contents($realPath));
                $cover_bg_url = "/uploads/cover/" . $filename;
                if ($bool) {
                    UserInfo::where('user_id', $user->id)->update(compact('cover_bg_url'));
                }
                return json_encode(["status" => 1, "src" => $cover_bg_url]);//ajax
            }
        }
    }
}
