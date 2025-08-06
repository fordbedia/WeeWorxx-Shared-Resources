<?php

namespace WeeWorxxSDK\SharedResources\Modules\User;

use Illuminate\Support\ServiceProvider;
use WeeWorxxSDK\SharedResources\Modules\User\OAuth\OAuthContract;
use WeeWorxxSDK\SharedResources\Modules\User\OAuth\UserOAuth;
use WeeWorxxSDK\SharedResources\src\Modules\User\Repositories\Contracts\UserRepositoryInterface;
use WeeWorxxSDK\SharedResources\src\Modules\User\Repositories\Eloquent\UserRepository;

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

        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
