<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        \App\Model\User::class  => \App\Policies\UserPolicy::class,
        \App\Model\UserInfo::class  => \App\Policies\UserInfoPolicy::class,
        \App\Model\NewsReply::class  => \App\Policies\NewsReplyPolicy::class,
        \App\Model\News::class  => \App\Policies\NewsPolicy::class,
        \App\Model\IndexCarousel::class  => \App\Policies\IndexCarouselPolicy::class,
        \App\Model\CommunityZone::class  => \App\Policies\CommunityZonePolicy::class,
        \App\Model\CommunityTopicReply::class  => \App\Policies\CommunityTopicReplyPolicy::class,
        \App\Model\CommunityTopic::class  => \App\Policies\CommunityTopicPolicy::class,
        \App\Model\CommunitySection::class  => \App\Policies\CommunitySectionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
