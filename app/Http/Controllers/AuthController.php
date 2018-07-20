<?php

namespace App\Http\Controllers;

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
}
