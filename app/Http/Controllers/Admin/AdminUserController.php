<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    //
    public function showUsersList(Request $request){
        $roles = Role::all();
        $users = User::with(['info','roles'])->paginate(15);
        //遍历生成用户集合
        $user_collection = collect([]);
        foreach ($users as $user){
            $topicsCount = $user->communityTopics()->count();
            $repliesCount = $user->communityTopicReplies()->count() + $user->newsReplies()->count();
            $followersCount = $user->followers()->count();

            $user_collection->push(compact(
                'user',
                'topicsCount',
                'repliesCount',
                'followersCount'
            ));
        }

        return view('admin.user.list',compact('users','user_collection','roles'));
    }

    public function showUserEdit(User $user){
        $user=$user->load('info');

        return view('admin.user.edit-user-info',compact('user'));
    }

    public function userEditUpdate(User $user,Request $request){
        //用户验证权限
        $this->authorize('manage', User::class);
        //验证
        $this->validate($request, [
            'name' => 'required',
            'password'=>'nullable|min:6'
        ]);

        //逻辑
        $name = $request->name;
        if (!empty($request->password)){
            $password = bcrypt($request->password);
            $userRes = $user->update(compact(
                'name',
                'password'
            ));
        }else{
            $userRes = $user->update(compact(
                'name'
            ));
        }

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
            return \redirect()->back()->with('tips', ['用户信息更新成功',]);
        } else {
            return \redirect()->back()->withErrors('更新失败,服务器内部错误,请联系管理员');
        }
    }

    /* 删除行为
     * @return int 1 success 0 failed
     */
    public function softDelete(Request $request){
        $user = User::where('id',$request->id)->first();
        $this->authorize('delete', $user);

        $user->delete();
        if($user->trashed()){
            $status = 1;
            $msg = "The user has been deleted";
        }else{
            $status = 0;
            $msg = "Server internal error";
        }
        return json_encode(compact('status','msg'));//ajax

    }


    public function softDeletes(Request $request){
        $failedCount=0;
        for($i=0;$i<count($request->ids);$i++){
            $user = User::where('id',$request->ids[$i])->first();
            $this->authorize('delete', $user);

            $user->delete();
            if(!$user->trashed()){
                $failedCount++;
            }
        }
        if($failedCount==0){
            $status = 1;
            $msg = "The selected users has been deleted";
        }else{
            $status = 0;
            $msg = $failedCount."Server internal error";
        }
        return json_encode(compact('status','msg'));//ajax
    }


    public function changeRoles(Request $request){
        $this->authorize('manage', User::class);

        $this->validate($request,[
            'userId'=>'required'
        ]);

        $user =User::findOrFail($request->userId);
        $user->syncRoles($request->role_ids);

        $status = 1;
        $msg = "The roles has been updated";
        return json_encode(compact('status','msg'));//ajax
    }

}
