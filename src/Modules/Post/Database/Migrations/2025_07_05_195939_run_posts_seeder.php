<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Seeders\PostStatusesSeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        (new PostStatusesSeeder)->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        (new PostStatusesSeeder)->revert();
    }
};
