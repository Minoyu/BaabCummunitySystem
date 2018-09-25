<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ValueToViewProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer(['message.layout.left-type-list','message.layout.left-type-list-mini',],function($view){
            if (Auth::check()){
                $messageUnreadCount = Auth::user()->newThreadsCount();
            }else{
                $messageUnreadCount = 0;
            }

            $view->with([
                'messageUnreadCount'=>$messageUnreadCount,
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
