<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\PostStatuses;
use WeeWorxxSDK\SharedResources\SDK\Database\MakeSeeder;

class PostStatusesSeeder extends MakeSeeder
{
    protected array $postStatuses = [
        'Active',
        'Draft',
        'Pending',
        'Expired',
        'Archive'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->postStatuses as $postStatus) {
            PostStatuses::create([
                'status' => $postStatus
            ]);
        }
    }


    public function revert()
    {
        Schema::disableForeignKeyConstraints();
        PostStatuses::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
