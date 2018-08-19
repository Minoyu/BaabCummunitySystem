<?php

namespace App\Providers;

use App\Model\Activity\CommunityTopicObserver;
use App\Model\Activity\CommunityTopicReplyObserver;
use App\Model\Activity\NewsReplyObserver;
use App\Model\Activity\UserObserver;
use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
use App\Model\NewsReply;
use App\Model\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        CommunityTopic::observe(CommunityTopicObserver::class);
        CommunityTopicReply::observe(CommunityTopicReplyObserver::class);
        NewsReply::observe(NewsReplyObserver::class);
        User::observe(UserObserver::class);
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
