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
    Schema::create('relatorio_configs', function (Blueprint $table) {
        $table->id();
        $table->string('frequencia')->default('diario');
        $table->string('formato')->default('pdf');
        $table->string('filtro_padrao')->default('data');
        $table->boolean('envio_email')->default(false);
        $table->string('email_destino')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorio_configs');
    }
};
