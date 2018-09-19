<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ResetPassword;
use App\Model\PasswordReset;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Return_;

class ResetPasswordController extends Controller
{
    //
    public function handleResetPassword(Request $request){
        $messages = [
            'email.required' => __('auth.emailEmpty'),
            'email.exists' =>'This user does not exist.',
        ];
        $this->validate($request,[
           'email'=>'required|email|exists:users,email'
        ],$messages);
        $user = User::where('email',$request->email)->firstOrFail();
//        Return new ResetPassword($user);
        $email = $request->email;
        $token = str_random(40);
        $created_at = Carbon::now();
        if ($passwordReset = PasswordReset::find($email)){
            $passwordReset -> update(compact('token','created_at'));
        }else{
            PasswordReset::create(compact('email','token','created_at'));
        }
        $username = $user->name;
        Mail::to($email)->send(new ResetPassword($token,$username));
        $status = 1 ;
        $msg = 'send successfully' ;
        return json_encode(compact('status','msg'));//ajax
    }

    public function showResetPage($token){
        if ($passwordReset = PasswordReset::where('token',$token)->first()){
            $user = $passwordReset->user;
            return view('auth.reset-password-page',compact('user','token'));
        }else{
            return '错误的验证码或已失效';
        }
    }

    public function storeResetPassword($token,Request $request){
        $this->validate($request,[
            'password'=>'required|min:6|confirmed'
        ]);
        if ($passwordReset = PasswordReset::where('token',$token)->first()){
            $user = $passwordReset->user;
            $password = bcrypt($request->password);
            $user->update(compact('password'));
            return view('auth.reset-password-page',compact('user','token'));
        }else{
            return '错误的验证码或已失效';
        }
    }
}
