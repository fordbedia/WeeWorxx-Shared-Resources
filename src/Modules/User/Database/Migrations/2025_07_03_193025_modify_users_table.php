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
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if(! Schema::hasColumn('users', 'fname')) {
                    $table->string('fname')->after('id');
                }
                if(! Schema::hasColumn('users', 'lname')) {
                    $table->string('lname')->after('fname');
                }
                if(! Schema::hasColumn('users', 'mname')) {
                    $table->string('mname')->after('lname');
                }
                if(! Schema::hasColumn('users', 'type_id')) {
                    $table->unsignedBigInteger('type_id')->after('remember_token');
                    $table->foreign('type_id')->references('id')->on('user_type')->onDelete('cascade');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                //
            });
        }
    }
};
