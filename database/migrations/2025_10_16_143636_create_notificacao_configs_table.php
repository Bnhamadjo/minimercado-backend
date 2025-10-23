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
    Schema::create('notificacao_configs', function (Blueprint $table) {
        $table->id();
        $table->boolean('alerta_vencimento')->default(true);
        $table->boolean('alerta_estoque_baixo')->default(true);
        $table->boolean('alerta_venda_alta')->default(false);
        $table->boolean('canal_email')->default(true);
        $table->boolean('canal_popup')->default(true);
        $table->boolean('canal_sms')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacao_configs');
    }
};
