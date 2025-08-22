<?php

namespace WeeWorxxSDK\SharedResources\Modules\User;

use Illuminate\Support\ServiceProvider;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\BenefitsRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\PostRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\SkillsRepository;
use WeeWorxxSDK\SharedResources\Modules\User\OAuth\OAuthContract;
use WeeWorxxSDK\SharedResources\Modules\User\OAuth\UserOAuth;
use WeeWorxxSDK\SharedResources\Modules\User\Repositories\Contracts\UserRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\User\Repositories\Eloquent\UserRepository;
use WeeWorxxSDK\SharedResources\Modules\User\Services\Contracts\PostServicesInterface;
use WeeWorxxSDK\SharedResources\Modules\User\Services\PostService;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);

        $this->app->singleton(OAuthContract::class, function(){
            return new UserOAuth(request());
        });
        $this->app->singleton(PostServicesInterface::class, function() {
					return new PostService(
						new PostRepository,
						new SkillsRepository,
						new BenefitsRepository
					);
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
