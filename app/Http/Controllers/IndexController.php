<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //
    public function showIndex(){
        return view('welcome');
    }

    public function switchZh(){
        Session::put('language', 'zh');
        return redirect()->back();
    }

    public function switchEn(){
        Session::put('language', 'en');
        return redirect()->back();
    }
}
