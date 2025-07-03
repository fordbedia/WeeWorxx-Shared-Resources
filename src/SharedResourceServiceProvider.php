<?php

namespace WeeWorxxSDK\SharedResources;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use WeeWorxxSDK\SharedResources\Modules\Post\PostServiceProvider;
use WeeWorxxSDK\SharedResources\Modules\User\UserServiceProvider;
use WeeWorxxSDK\SharedResources\SDK\Console\Config\Make;

class SharedResourceServiceProvider extends ServiceProvider
{
    protected array $providers = [
        UserServiceProvider::class,
        PostServiceProvider::class
    ];

    public function boot()
    {
        // Load module routes and migrations dynamically
        $this->loadModules();

        // Optional: Load SDK services, views, etc.
        // $this->loadViewsFrom(__DIR__ . '/SDK/resources/views', 'sdk');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Make::class,
            ]);
        }
    }

    protected function loadModules()
    {
        $modulesPath = __DIR__ . '/Modules';

        if (!is_dir($modulesPath)) {
            return;
        }

        $moduleDirs = File::directories($modulesPath);

        foreach ($moduleDirs as $moduleDir) {
            // Routes
            $routePath = $moduleDir . '/routes/web.php';
            if (file_exists($routePath)) {
                $this->loadRoutesFrom($routePath);
            }

            // Migrations
            $migrationPath = $moduleDir . '/Database/Migrations';
            if (is_dir($migrationPath)) {
                $this->loadMigrationsFrom($migrationPath);
            }

            // You can also auto-load views per module, config, etc.
        }
    }

    public function register()
    {
        // ==============================================================
        // Register all providers
        // ==============================================================
        foreach($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}

