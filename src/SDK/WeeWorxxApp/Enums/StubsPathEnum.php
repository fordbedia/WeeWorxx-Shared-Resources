<?php

namespace WeeWorxxSDK\SharedResources\SDK\WeeWorxxApp\Enums;

enum StubsPathEnum: string
{
    case MIGRATION = 'migration.';
    case CONTROLLER = 'controller.';
    case MODEL = 'model.';

    public function getFullPath()
    {
        return '/vendor/weeworxx/shared-resources/src/SDK/WeeWorxxApp/stubs/' . $this->value;
    }
}
