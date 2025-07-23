<?php

namespace WeeWorxxSDK\SharedResources\Modules\User;

use Illuminate\Support\ServiceProvider;
use WeeWorxxSDK\SharedResources\Modules\User\OAuth\OAuthContract;
use WeeWorxxSDK\SharedResources\Modules\User\OAuth\UserOAuth;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OAuthContract::class, function(){
            return new UserOAuth(request());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
