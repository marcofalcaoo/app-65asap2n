<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produtos', function (Blueprint $table) {
            $table->id('id_produto'); // id
            $table->string('nm_produto', 50); // nome do produto
            $table->string('dsc_produto', 100)->nullable(); // descrição do produto
            $table->string('sku_produto', 10)->unique(); // SKU do produto
            $table->integer('qtd_produto'); // qtd do produto
            $table->timestamps(); // created_at | updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_produtos');
    }
}
