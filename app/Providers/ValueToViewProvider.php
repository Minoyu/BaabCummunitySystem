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
        view()->composer([
            'message.layout.left-type-list',
            'message.layout.left-type-list-mini',
            'layout.drawer',
            'layout.appbar-right-menu',
            'layout.appbar',
            ],function($view){
            if (Auth::check()){
                $messageUnreadCount = Auth::user()->newThreadsCount();
                $notificationUnreadCount = Auth::user()->unreadNotifications()->count();
            }else{
                $messageUnreadCount = 0;
                $notificationUnreadCount = 0;
            }

            $view->with([
                'messageUnreadCount'=>$messageUnreadCount,
                'notificationUnreadCount'=>$notificationUnreadCount,
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
