<?php

namespace WeeWorxxSDK\SharedResources\SDK\Console\Config;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

abstract class ModularMakeCommand extends Command
{
    protected string $what;
    protected string $className;
    protected ?string $module;
    protected ?string $table;
    protected ?string $create;
    protected ?string $modelName;

    protected function initializeInputs(): void
    {
        $this->what = $this->argument('what');
        $this->className = $this->argument('className');
        $this->module = $this->option('module');
        $this->table = $this->option('table');
        $this->create = $this->option('create');
        $this->modelName = $this->option('model-name');
    }

    public function handle(): int
    {
        $this->initializeInputs();

        return match ($this->what) {
            'action'     => $this->makeAction(),
            'command'    => $this->makeCommand(),
            'controller' => $this->makeController(),
            'migration'  => $this->makeMigration(),
            'model'      => $this->makeModel(),
            'observer'   => $this->makeObserver(),
            'request'    => $this->makeRequest(),
            'resource'   => $this->makeResource(),
            'seeder'     => $this->makeSeeder(),
            default      => $this->error('Invalid make option: ' . $this->what),
        };
    }

    protected function artisanCallOrCustom(string $artisanCommand, array $args = []): int
    {
        if ($this->module) {
            return $this->makeInModule($artisanCommand, $args);
        }

        return $this->call($artisanCommand, $args);
    }

    abstract protected function makeInModule(string $command, array $args): int;

    // You can implement default handlers and override as needed:
    protected function makeModel(): int
    {
        return $this->artisanCallOrCustom('make:model', [
            'name' => $this->className,
            '--migration' => $this->create !== null,
        ]);
    }

    protected function makeController(): int
    {
        return $this->artisanCallOrCustom('make:controller', [
            'name' => $this->className,
        ]);
    }

    protected function makeMigration(): int
    {
        return $this->artisanCallOrCustom('make:migration', [
            'name' => $this->className,
            '--create' => $this->create,
            '--table' => $this->table,
        ]);
    }

    // Empty stubs — override these in child class as needed
    protected function makeAction(): int { return 0; }
    protected function makeCommand(): int { return 0; }
    protected function makeObserver(): int { return 0; }
    protected function makeRequest(): int { return 0; }
    protected function makeResource(): int { return 0; }
    protected function makeSeeder(): int { return 0; }
}
