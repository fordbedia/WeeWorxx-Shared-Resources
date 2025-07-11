<?php

namespace WeeWorxxSDK\SharedResources\TestCase;

use Orchestra\Testbench\TestCase as BaseTestCase;
use WeeWorxxSDK\SharedResources\SharedResourceServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SharedResourceServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->importSqlSchema();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function importSqlSchema(): void
    {
        $schemaPath = __DIR__ . '/../../../../tests/schema.sql'; // Adjust if needed

        if (!file_exists($schemaPath)) {
            throw new \RuntimeException('schema.sql not found');
        }

        $sql = file_get_contents($schemaPath);
        foreach (explode(";", $sql) as $statement) {
            $trimmed = trim($statement);
            if (!empty($trimmed)) {
                \DB::statement($trimmed);
            }
        }
    }
}
