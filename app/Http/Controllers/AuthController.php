<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**
     * 登录操作
     * @param Request $request
     * @return string
     */
    public function login(Request $request){
        //验证
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //逻辑
        $user = \request(['email','password']);
        $remember_me = \request('remember_me');
        if (Auth::attempt($user,$remember_me)){
            $status = 1;
            $msg = 'Logged in successful';
            $user = Auth::user();
            //渲染
            return json_encode(compact('status','msg','user'));
        }else{
            $status = 0;
            $msg = __('auth.failed');
            //渲染
            return json_encode(compact('status','msg'));
        }
    }

    public function notLogin(){
        return Redirect::to("/?notLogged=true");
    }

    /**检查邮箱重复
     * @param Request $request
     * @return string
     */
    public function checkEmailUnique(Request $request){
        //验证
        $this->validate($request,[
            'email' => 'required|unique:users|email',
        ]);
        $status = 1;
        return json_encode(compact('status'));
    }

    /**注册操作
     * @param Request $request
     * @return string
     */
    public function register(Request $request){
        //验证
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'confirmed|required|min:6'
        ]);
        //逻辑
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);
        $userRes = User::create(compact('name','email','password'));
        $userInfoRes = UserInfo::create(['user_id'=>$userRes->id]);
        //渲染
        if ($userRes&&$userInfoRes){
            $status = 1;
            $msg = 'Create account successful';
        }else{
            $status = 0;
            $msg = 'Create account failed';
        }
        return json_encode(compact('status','msg'));
    }

    /**
     * 登出
     */
    public function logout(){
        Auth::logout();
        return Redirect::back();
    }
}
