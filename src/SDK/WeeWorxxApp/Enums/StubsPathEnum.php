<?php

namespace WeeWorxxSDK\SharedResources\SDK\WeeWorxxApp\Enums;

enum StubsPathEnum: string
{
    case MIGRATION = 'migration.';

    public function getFullPath()
    {
        return '/vendor/weeworxx/shared-resources/src/SDK/WeeWorxxApp/stubs/' . $this->value;
    }
}
