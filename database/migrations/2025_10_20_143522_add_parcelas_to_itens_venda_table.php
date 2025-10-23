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
    Schema::table('itens_venda', function (Blueprint $table) {
        $table->string('parcelas')->default('1x');
    });
}

public function down()
{
    Schema::table('itens_venda', function (Blueprint $table) {
        $table->dropColumn('parcelas');
    });
}
};
