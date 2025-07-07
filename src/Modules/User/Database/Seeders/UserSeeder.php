<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use WeeWorxxSDK\SharedResources\Modules\User\Models\User;
use WeeWorxxSDK\SharedResources\SDK\Database\MakeSeeder;

class UserSeeder extends MakeSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(100)
            ->create();
    }

    public function revert()
    {
        Schema::disableForeignKeyConstraints();
        User::where('is_test', 1)->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        Schema::disableForeignKeyConstraints();
    }
}
