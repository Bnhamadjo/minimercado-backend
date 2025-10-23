<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposNovosToProdutosTable extends Migration
{
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('nome')->nullable();
            $table->string('codigo_barras')->unique()->nullable();
            $table->decimal('preco', 10, 2)->nullable();
            $table->integer('quantidade')->default(0);
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('fornecedor_id')->nullable();

            // Chaves estrangeiras
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropForeign(['fornecedor_id']);
            $table->dropColumn(['nome', 'codigo_barras', 'preco', 'quantidade', 'categoria_id', 'fornecedor_id']);
        });
    }
}