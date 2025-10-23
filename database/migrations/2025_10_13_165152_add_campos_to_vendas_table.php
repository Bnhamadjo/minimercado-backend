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
       
    Schema::table('vendas', function (Blueprint $table) {
        $table->decimal('valor_total', 10, 2)->nullable(); // valor da venda
        $table->unsignedBigInteger('cliente_id')->nullable(); // se houver cliente
        $table->string('forma_pagamento')->nullable(); // ex: dinheiro, cartão
        $table->date('data_venda')->nullable(); // data da venda
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            //
        });
    }
};
