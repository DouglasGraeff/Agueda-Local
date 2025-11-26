<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add UUID column nullable first
        Schema::table('user_info', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });

        // Generate UUIDs for existing users using PostgreSQL function
        DB::statement('UPDATE user_info SET uuid = gen_random_uuid()');

        // Make UUID not nullable and unique
        Schema::table('user_info', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('user_info', function (Blueprint $table) {
            $table->dropUnique(['uuid']);
            $table->dropColumn('uuid');
        });
    }
};

