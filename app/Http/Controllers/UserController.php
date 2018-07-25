<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function showPersonalCenter(User $user){
        return view('personal-center',compact('user'));
    }

    /**
     * 更新个人用户信息
     * @param User $user
     * @param Request $request
     * @return string
     */
    public function updateUserInfo(User $user,Request $request){
        //验证
        $this->validate($request, [
            'name' => 'required',
        ]);

        //逻辑
        $name=$request->name;
        $sex=$request->sex;
        $sex_open=$request->sex_open;
        $motto=$request->motto;
        $wechat=$request->wechat;
        $wechat_open=$request->wechat_open;
        $nation=$request->nation;
        $nation_open=$request->nation_open;
        $living_city=$request->living_city;
        $living_city_open=$request->living_city_open;
        $engaged_in=$request->engaged_in;
        $engaged_in_open=$request->engaged_in_open;

        $userRes=$user->update(compact(
            'name'
        ));
        $userInfoRes=$user->info->update(compact(
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
        if ($userRes&&$userInfoRes) {
            $status = 1;
            $msg = 'Create account successful';
        }else{
            $status = 0;
            $msg = 'Create account failed';
            }
            return json_encode(compact('status','msg'));
    }

    public function uploadAvatar(User $user,Request $request){
        if ($request->isMethod('post')) {
            $file = $request->file('avatar');
            // 文件是否上传成功
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = $user->id. '-' .date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                // 这里的userAvatar是配置文件的名称
                $bool = Storage::disk('userAvatar')->put($filename, file_get_contents($realPath));
                //var_dump($bool);
                
            }

        }
//        $path = $request->file('avatar')->store('uploads/img');

        return json_encode(["data"=>"/uploads/avatar/".$filename]);//ajax

    }
}
