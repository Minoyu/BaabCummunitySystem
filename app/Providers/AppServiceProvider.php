<?php

namespace App\Providers;

use App\Model\Activity\CommunityTopicObserver;
use App\Model\Activity\CommunityTopicReplyObserver;
use App\Model\Activity\NewsObserver;
use App\Model\Activity\NewsReplyObserver;
use App\Model\Activity\UserObserver;
use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
use App\Model\News;
use App\Model\NewsReply;
use App\Model\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
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
        News::observe(NewsObserver::class);
        User::observe(UserObserver::class);
        Schema::defaultStringLength(191);
        \URL::forceScheme('https');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }
}
