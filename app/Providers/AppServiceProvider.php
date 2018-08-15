<?php

namespace App\Providers;

use App\Model\Activity\CommunityTopicObserver;
use App\Model\Activity\CommunityTopicReplyObserver;
use App\Model\CommunityTopic;
use App\Model\CommunityTopicReply;
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
