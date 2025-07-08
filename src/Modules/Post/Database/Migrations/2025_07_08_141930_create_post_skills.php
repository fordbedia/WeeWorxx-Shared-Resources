<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('skills')) {
            Schema::create('skills', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('identifier');
                $table->timestamps();
            });
        }
        if (! Schema::hasTable('post_skills')) {
            Schema::create('post_skills', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('skills_id');
                $table->unsignedBigInteger('post_id');
                $table->foreign('skills_id')
                    ->references('id')
                    ->on('skills')->onDelete('cascade');
                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('skills')) {
            Schema::dropIfExists('skills');
        }
        if (Schema::hasTable('post_skills')) {
            Schema::dropIfExists('post_skills');
        }
    }
};
