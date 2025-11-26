<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('user_types')->insert([
            [
                'name' => 'Consumidor',
                'description' => 'Utilizador que compra produtos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Produtor',
                'description' => 'Utilizador que vende produtos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
