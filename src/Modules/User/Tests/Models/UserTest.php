<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Tests\Models;

use WeeWorxxSDK\SharedResources\Modules\User\Models\User;
use WeeWorxxSDK\SharedResources\Modules\User\Models\UserType;
use WeeWorxxSDK\SharedResources\Modules\User\Tests\TestCase;
use WeeWorxxSDK\SharedResources\TestCase\Extras\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $types = [[
            'id' => 1,
            'type' => 'Job Seeker'
        ],[
            'id' => 2,
            'type' => 'Employer'
        ]];
        foreach($types as $type) {
            UserType::create($type);
        }
    }

    public function test_if_model_works()
    {
        User::factory()->create([
            'fname' => 'Ed',
            'mname' => 'Bass',
            'lname' => 'Bedia',
        ]);

        $this->assertDatabaseHas('users', [
            'fname' => 'Ed',
            'lname'  => 'Bedia',
        ]);
    }
}
