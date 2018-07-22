<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //登录操作
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
        }else{
            $status = 0;
            $msg = __('auth.failed');
        }
        //渲染
        return json_encode(compact('status','msg'));
    }
    //检查邮箱重复
    public function checkEmailUnique(Request $request){
        //验证
        $this->validate($request,[
            'email' => 'required|unique:users|email',
        ]);
        $status = 1;
        return json_encode(compact('status'));
    }

    //注册操作
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
        $res = User::create(compact('name','email','password'));
        //渲染
        if ($res){
            $status = 1;
            $msg = 'Create account successful';
        }else{
            $status = 0;
            $msg = 'Create account failed';
        }
        return json_encode(compact('status','msg'));
    }

}
