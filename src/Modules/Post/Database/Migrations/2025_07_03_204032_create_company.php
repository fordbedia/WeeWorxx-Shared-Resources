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
        if (! Schema::hasTable('company')) {
            Schema::create('company', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('logo')->nullable();
                $table->tinyInteger('is_test')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('company')) {
            Schema::dropIfExists('company');
        }
    }
};
