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
            $table->string('nome')->nullable();               // pode ser nullable
            $table->string('codigo_barras')->unique()->nullable();
            $table->decimal('preco', 10, 2)->nullable();
            $table->integer('quantidade')->default(0);

            // FK: categoria_id
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id', 'fk_produtos_categoria')
                  ->references('id')->on('categorias')
                  ->onDelete('set null');

            // FK: fornecedor_id
            $table->unsignedBigInteger('fornecedor_id')->nullable();
            $table->foreign('fornecedor_id', 'fk_produtos_fornecedor')
                  ->references('id')->on('fornecedores')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
