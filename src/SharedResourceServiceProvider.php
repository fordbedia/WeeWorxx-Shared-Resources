<?php

namespace WeeWorxxSDK\SharedResources;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use WeeWorxxSDK\SharedResources\Modules\User\UserRepositoryServiceProvider;
use WeeWorxxSDK\SharedResources\SDK\Console\Config\MakeAnythingCommand;

class SharedResourceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load module routes and migrations dynamically
        $this->loadModules();

        // Optional: Load SDK services, views, etc.
        // $this->loadViewsFrom(__DIR__ . '/SDK/resources/views', 'sdk');

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeAnythingCommand::class,
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
        $this->app->register(UserRepositoryServiceProvider::class);
    }
}

