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
        if (! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('posted_by');
                $table->unsignedBigInteger('company_id');
                $table->unsignedBigInteger('post_status_id');
                $table->string('salary')->nullable();
                $table->enum('employment_type', ['full_time', 'part_time', 'contract']);
                $table->string('job_location');
                $table->string('title');
                $table->longText('content');
                $table->timestamp('valid_at');
                $table->tinyInteger('is_test')->default(0);
                $table->timestamps();

                $table->foreign('posted_by')
                    ->references('id')->on('posts')->onDelete('cascade');
                $table->foreign('company_id')
                    ->references('id')->on('company')->onDelete('cascade');
                $table->foreign('post_status_id')
                    ->references('id')->on('post_statuses')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('posts')) {
            Schema::dropIfExists('posts');
        }
    }
};
