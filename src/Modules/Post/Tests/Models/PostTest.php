<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Tests\Models;

use WeeWorxxSDK\SharedResources\Modules\Post\Models\Benefits;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;
use WeeWorxxSDK\SharedResources\Modules\Post\Tests\TestCase;
use WeeWorxxSDK\SharedResources\Modules\User\Models\UserType;
use WeeWorxxSDK\SharedResources\TestCase\Extras\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $types = [[
            'id' => 1,
            'type' => 'Test Job Seeker'
        ],[
            'id' => 2,
            'type' => 'Test Employer'
        ]];
        foreach($types as $type) {
            UserType::create($type);
        }
    }

    /** @test */
    public function test_it_can_create_a_post()
    {
        $post = Benefits::create([
            'name' => 'Laravel is the best!',
            'identifier'  => 'laravel-is-the-best!',
        ]);

        $this->assertDatabaseHas('benefits', [
            'name' => 'Laravel is the best!',
            'identifier'  => 'laravel-is-the-best!',
        ]);
    }

    public function test_force_deprecation()
    {
        @trigger_error('Manual deprecation warning test', E_USER_DEPRECATED);
        $this->assertTrue(true);
    }
}
