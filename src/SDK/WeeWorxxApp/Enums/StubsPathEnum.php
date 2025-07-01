<?php

namespace WeeWorxxSDK\SharedResources\SDK\WeeWorxxApp\Enums;

enum StubsPathEnum: string
{
    case MIGRATION = '/vendor/weeworxx/shared-resources/src/SDK/WeeWorxxApp/stubs/migration.';

    public function getFullPath()
    {
        return __DIR__ . $this->value;
    }
}
