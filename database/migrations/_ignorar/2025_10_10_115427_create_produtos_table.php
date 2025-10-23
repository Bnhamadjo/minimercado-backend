<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('codigo_barras')->unique();
            $table->decimal('preco', 10, 2);
            $table->integer('quantidade')->default(0);
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('fornecedor_id');
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}