<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use WeeWorxxSDK\SharedResources\Modules\User\Models\UserType;

class UserTypeSeeder extends Seeder
{
    protected array $types = ['Employer', 'Job Seeker'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->types as $type) {
            UserType::create([
                'type' => $type
            ]);
        }
    }

    /**
     * Revert the database seeds.
     */
    public function revert(): void
    {
        Schema::disableForeignKeyConstraints();
        foreach ($this->types as $type) {
            UserType::truncate();
        }
        Schema::enableForeignKeyConstraints();
    }
}
