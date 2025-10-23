<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddCamposNovosToProdutosTable extends Migration
{
    public function up()
    {
      Schema::table('produtos', function (Blueprint $table) {

    if (!Schema::hasColumn('produtos', 'codigo_barras')) {
        $table->string('codigo_barras')->unique()->nullable();
    }

    if (!Schema::hasColumn('produtos', 'preco')) {
        $table->decimal('preco', 10, 2)->nullable();
    }

    if (!Schema::hasColumn('produtos', 'quantidade')) {
        $table->integer('quantidade')->default(0);
    }

    if (!Schema::hasColumn('produtos', 'categoria_id')) {
        $table->unsignedBigInteger('categoria_id')->nullable();
        $table->foreign('categoria_id', 'fk_produtos_categoria')
              ->references('id')->on('categorias')
              ->onDelete('set null');
    }

    if (!Schema::hasColumn('produtos', 'fornecedor_id')) {
        $table->unsignedBigInteger('fornecedor_id')->nullable();
        $table->foreign('fornecedor_id', 'fk_produtos_fornecedor')
              ->references('id')->on('fornecedores')
              ->onDelete('cascade');
    }

});


    }

    public function down()
    {
        // Antes de tentar remover, verifica se as FKs existem
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
              AND TABLE_NAME = 'produtos';
        ");

        $fkNames = collect($foreignKeys)->pluck('CONSTRAINT_NAME')->toArray();

        Schema::table('produtos', function (Blueprint $table) use ($fkNames) {
            // Remove as foreign keys, se existirem
            if (in_array('fk_produtos_categoria', $fkNames)) {
                $table->dropForeign('fk_produtos_categoria');
            } elseif (in_array('produtos_categoria_id_foreign', $fkNames)) {
                $table->dropForeign('produtos_categoria_id_foreign');
            }

            if (in_array('fk_produtos_fornecedor', $fkNames)) {
                $table->dropForeign('fk_produtos_fornecedor');
            } elseif (in_array('produtos_fornecedor_id_foreign', $fkNames)) {
                $table->dropForeign('produtos_fornecedor_id_foreign');
            }

            // Remove as colunas
            $table->dropColumn([
                'nome',
                'codigo_barras',
                'preco',
                'quantidade',
                'categoria_id',
                'fornecedor_id'
            ]);
        });
    }
}
