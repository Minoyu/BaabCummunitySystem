<?php

namespace App\Http\Controllers\Auth;

use App\Jobs\SendEmail;
use App\Mail\ResetPassword;
use App\Model\PasswordReset;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $mailTo = $request->email;
        $token = str_random(40);
        $created_at = Carbon::now();
        if ($passwordReset = PasswordReset::find($mailTo)){
            $passwordReset -> update(compact('token','created_at'));
        }else{
            PasswordReset::create(compact('email','token','created_at'));
        }

        //发送邮件 队列服务
        $username = $user->name;
        $mailObj = new ResetPassword($token,$username);
        Mail::to($user)->send($mailObj);

        $status = 1 ;
        $msg = 'send successfully' ;
        return json_encode(compact('status','msg'));//ajax
    }

    public function showResetPage($token){
        $query = [
            ['token',$token],
            ['created_at','>',Carbon::parse('-10 minutes')],
        ];
        if ($passwordReset = PasswordReset::where($query)->first()){
            $user = $passwordReset->user;
            return view('auth.reset-password-page',compact('user','token'));
        }else{
            return view('auth.reset-password-failed');
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
            $passwordReset->delete();
            Auth::logout();
            return view('auth.reset-password-success');
        }else{
            return view('auth.reset-password-failed');
        }
    }
}
