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
    Schema::table('movimentacao_estoques', function (Blueprint $table) {
        $table->date('data_validade')->nullable()->after('motivo');
    });
}

public function down(): void
{
    Schema::table('movimentacao_estoques', function (Blueprint $table) {
        $table->dropColumn('data_validade');
    });
}

};
