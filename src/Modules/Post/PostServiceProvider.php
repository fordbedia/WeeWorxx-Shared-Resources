<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post;

use Illuminate\Support\ServiceProvider;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\BenefitsRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\PostRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\SkillsRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\BenefitsRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\PostRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\SkillsRepository;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
				$this->app->singleton(SkillsRepositoryInterface::class, SkillsRepository::class);
				$this->app->singleton(BenefitsRepositoryInterface::class, BenefitsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
