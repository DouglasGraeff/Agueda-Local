<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_info', function (Blueprint $table) {
            $table->unsignedInteger('user_type_id')->nullable()->after('password');
            $table->string('phone', 20)->nullable()->after('user_type_id');
            
            $table->foreign('user_type_id')
                ->references('id')
                ->on('user_types')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('user_info', function (Blueprint $table) {
            $table->dropForeign(['user_type_id']);
            $table->dropColumn(['user_type_id', 'phone']);
        });
    }
};
