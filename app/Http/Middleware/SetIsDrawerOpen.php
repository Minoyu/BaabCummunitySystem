<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetIsDrawerOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //给drawer视图传递是否默认开启
        view()->composer(['layout.drawer','frame.indexframe'],function($view){
            if (Auth::check()&&!empty(Auth::user()->info->is_drawer_open)){
                $res = Auth::user()->info->is_drawer_open;
            }else{
                $res = Session::get('isDrawerOpen', true);
            }

            $view->with('isDrawerOpen',$res);
        });
        return $next($request);
    }
}
