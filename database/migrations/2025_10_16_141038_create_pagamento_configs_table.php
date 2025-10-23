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
    Schema::create('pagamento_configs', function (Blueprint $table) {
        $table->id();
        $table->boolean('dinheiro')->default(true);
        $table->boolean('cartao')->default(true);
        $table->boolean('pix')->default(true);
        $table->boolean('vale')->default(false);
        $table->decimal('taxa_cartao', 5, 2)->nullable();
        $table->decimal('desconto_pix', 5, 2)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamento_configs');
    }
};
