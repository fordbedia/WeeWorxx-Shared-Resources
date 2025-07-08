<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Benefits;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\PostBenefits;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\PostSkills;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Skills;
use WeeWorxxSDK\SharedResources\SDK\Database\MakeSeeder;

class PostSeeder extends MakeSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()
            ->count(100)
            ->create();
        Skills::factory()
            ->count(100)
            ->create();
        PostSkills::factory()->count(100)->create();
        Benefits::factory()->count(100)->create();
        PostBenefits::factory()->count(100)->create();
    }

    /**
     * Revert the database seeds.
     */
    public function revert(): void
    {
        Schema::disableForeignKeyConstraints();
        Post::where('is_test', 1)->delete();
        DB::statement('ALTER TABLE posts AUTO_INCREMENT = 1');
        Schema::enableForeignKeyConstraints();
    }
}
