<?php

namespace SharedResources;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class SharedResourceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load module routes and migrations dynamically
        $this->loadModules();

        // Optional: Load SDK services, views, etc.
        // $this->loadViewsFrom(__DIR__ . '/SDK/resources/views', 'sdk');
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
            $migrationPath = $moduleDir . '/Database/migrations';
            if (is_dir($migrationPath)) {
                $this->loadMigrationsFrom($migrationPath);
            }

            // You can also auto-load views per module, config, etc.
        }
    }

    public function register()
    {
        //
    }
}

