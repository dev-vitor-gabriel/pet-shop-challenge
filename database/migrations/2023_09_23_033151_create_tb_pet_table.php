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
        Schema::create('tb_pet', function (Blueprint $table) {
            $table->id('id_pet_tbp');
            $table->unsignedBigInteger('id_cliente_tbp');
            $table->string('des_pet_tbp');
            $table->boolean('is_ative_tbp');
            $table->foreign('id_cliente_tbp')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pet');
    }
};
