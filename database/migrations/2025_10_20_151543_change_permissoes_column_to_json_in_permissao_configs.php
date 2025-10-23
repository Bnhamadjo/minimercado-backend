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
    Schema::table('permissao_configs', function (Blueprint $table) {
        $table->json('permissoes')->change();
    });
}

public function down()
{
    Schema::table('permissao_configs', function (Blueprint $table) {
        $table->longText('permissoes')->change();
    });
}
};
