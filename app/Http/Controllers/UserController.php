<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function showPersonalCenter($user){
        return view('personal-center',compact('user'));
    }
}
