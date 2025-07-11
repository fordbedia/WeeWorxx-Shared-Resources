<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Tests\Models;

use WeeWorxxSDK\SharedResources\Modules\Post\Models\Benefits;
use WeeWorxxSDK\SharedResources\Modules\Post\Tests\TestCase;

class BenefitsTest extends TestCase
{
    public function test_if_model_works()
    {
        Benefits::create([
            'name' => 'Laravel is the best!',
            'identifier'  => 'laravel-is-the-best!',
        ]);

        $this->assertDatabaseHas('benefits', [
            'name' => 'Laravel is the best!',
            'identifier'  => 'laravel-is-the-best!',
        ]);
    }
}
