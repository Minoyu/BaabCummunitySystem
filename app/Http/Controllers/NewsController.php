<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function showNews(){
        return view('news');
    }
    public function showNewsSec(){
        return view('newsSec');
    }
}
