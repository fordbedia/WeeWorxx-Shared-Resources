<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post;

use Illuminate\Support\ServiceProvider;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\BenefitsRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\PostRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\SkillsRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\BenefitsRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\PostRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Eloquents\SkillsRepository;
use WeeWorxxSDK\SharedResources\Modules\Post\Search\Contracts\PostSearchEngine;
use WeeWorxxSDK\SharedResources\Modules\Post\Search\Engines\SqlPostSearchEngine;

class PostServiceProvider extends ServiceProvider
{
	protected $defer = true;
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
		$this->app->singleton(SkillsRepositoryInterface::class, SkillsRepository::class);
		$this->app->singleton(BenefitsRepositoryInterface::class, BenefitsRepository::class);
		// ----------------------------------------------------------------------------
		// Bind the engine (swap later if needed)
		// ----------------------------------------------------------------------------
		$this->app->singleton(PostSearchEngine::class, SqlPostSearchEngine::class);
	}
	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		//
	}

	public function provides(): array
	{
		return [
			PostRepositoryInterface::class,
			SkillsRepositoryInterface::class,
			BenefitsRepositoryInterface::class,
			PostSearchEngine::class,
		];
	}
}
