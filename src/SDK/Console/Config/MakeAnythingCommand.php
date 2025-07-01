<?php

namespace WeeWorxxSDK\SharedResources\SDK\Console\Config;

use Illuminate\Support\Facades\File;

class MakeAnythingCommand extends ModularMakeCommand
{
    protected $signature = 'ww:make {what} {className}
        {--module= : Module Name}
        {--table= : Name of table to derive model or migration from}
        {--create= : Create a migration file for the model}
        {--model-name= : Model to be targeted for observer}';

    protected $description = 'Create Laravel components in modules or the default app paths';

    protected function makeInModule(string $command, array $args): int
    {
        // Define the module root directory
        $modulePath = base_path("vendor/weeworxx/shared-resources/src/Modules/{$this->module}");

        // Define subpaths based on component type
        $paths = [
            'make:model'      => 'Models',
            'make:controller' => 'Http/Controllers',
            'make:migration'  => 'Database/Migrations',
            'make:seeder'     => 'Database/Seeders',
        ];

        $subPath = $paths[$command] ?? 'Misc';
        $fullPath = "{$modulePath}/{$subPath}";

        // Ensure directory exists
        File::ensureDirectoryExists($fullPath);

        // Generate the file manually or call Artisan with a custom path
        $filename =$this->fileName . '.php';
        $targetPath = "{$fullPath}/{$filename}";
        $stubPath = file_get_contents($this->stubPath);

        // For now, just a file stub — you can customize with real stubs later
        File::put($targetPath, $stubPath);

        $this->info("Created {$this->what} in module [{$this->module}]: {$targetPath}");

        return 0;
    }
}
