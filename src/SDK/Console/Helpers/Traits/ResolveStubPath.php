<?php
namespace WeeWorxxSDK\SharedResources\SDK\Console\Helpers\Traits;

trait ResolveStubPath
{
    public function resolveMigrationStubPath(string $stub): string
    {
        $published = base_path('stubs/' . $stub);

        return file_exists($published)
            ? $published
            : base_path('vendor/laravel/framework/src/Illuminate/Database/Migrations/stubs/' . $stub);
    }
}
