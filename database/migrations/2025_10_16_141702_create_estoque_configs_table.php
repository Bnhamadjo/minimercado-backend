<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('estoque_configs', function (Blueprint $table) {
        $table->id();
        $table->string('unidade_padrao')->default('unidade');
        $table->integer('alerta_minimo')->default(10);
        $table->boolean('validade_ativa')->default(true);
        $table->integer('dias_validade_alerta')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque_configs');
    }
};
