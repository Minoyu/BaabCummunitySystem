<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //
    public function showIndex(){
        return view('index');
    }

    public function switchLang(){
        if (App::isLocale('en')) {
            Session::put('language', 'zh');
        }else{
            Session::put('language', 'en');
        }
        return redirect()->back();
    }
}
