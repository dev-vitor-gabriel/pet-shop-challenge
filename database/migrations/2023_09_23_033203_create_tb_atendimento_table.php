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
        Schema::create('tb_atendimento', function (Blueprint $table) {
            $table->id('id_atendimento_tba');
            $table->date('dta_atendimento_tba');
            $table->unsignedBigInteger('id_pet_tba');
            $table->foreign('id_pet_tba')->references('id_pet_tbp')->on('tb_pet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_atendimento');
    }
};
