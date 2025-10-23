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
    Schema::table('produtos', function (Blueprint $table) {
        $table->foreign('fornecedor_id')
              ->references('id')
              ->on('fornecedores')
              ->onDelete('set null');
    });
}

public function down()
{
    Schema::table('produtos', function (Blueprint $table) {
        $table->dropForeign(['fornecedor_id']);
    });
}
};
