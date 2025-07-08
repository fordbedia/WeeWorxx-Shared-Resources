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
        if (!Schema::hasTable('benefits')) {
            Schema::create('benefits', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('identifier');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('post_benefits')) {
            Schema::create('post_benefits', function(Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('benefits_id');
                $table->unsignedBigInteger('post_id');
                $table->foreign('benefits_id')
                    ->references('id')
                    ->on('benefits')->onDelete('cascade');
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
        if (Schema::hasTable('benefits')) {
            Schema::dropIfExists('benefits');
        }
        if (Schema::hasTable('post_benefits')) {
            Schema::dropIfExists('post_benefits');
        }
    }
};
