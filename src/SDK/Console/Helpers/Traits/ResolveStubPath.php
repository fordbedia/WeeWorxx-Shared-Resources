<?php
namespace WeeWorxxSDK\SharedResources\SDK\Console\Helpers\Traits;

use WeeWorxxSDK\SharedResources\SDK\WeeWorxxApp\Enums\StubsPathEnum;

trait ResolveStubPath
{
    public function resolveMigrationStubPath(string $stub): string
    {
        $published = base_path('stubs/' . $stub);

        return file_exists($published)
            ? $published
            : base_path(StubsPathEnum::MIGRATION->getFullPath() . $stub);
    }
}
