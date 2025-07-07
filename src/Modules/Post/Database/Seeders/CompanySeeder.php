<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Company;
use WeeWorxxSDK\SharedResources\SDK\Database\MakeSeeder;

class CompanySeeder extends MakeSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()
            ->count(100)
            ->create();
    }

    /**
     * Revert the database seeds.
     */
    public function revert(): void
    {
        Schema::disableForeignKeyConstraints();
        Company::where('is_test', 1)->delete();
        DB::statement('ALTER TABLE company AUTO_INCREMENT = 1');
        Schema::enableForeignKeyConstraints();
    }
}
