<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ResetPassword;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Return_;

class ResetPasswordController extends Controller
{
    //
    public function handleResetPassword(){

        $user = User::findOrFail(1);
//        Return new ResetPassword($user);
        Mail::to($user->email)->send(new ResetPassword($user));
    }
}
