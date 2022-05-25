<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMovTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mov_produtos', function (Blueprint $table) {
            $table->id('id_mov_produto'); // id mov
            $table->unsignedBigInteger('id_produto');
            $table->foreign('id_produto')->references('id_produto')->on('tb_produtos'); // id do produto
            $table->dateTime('dt_alteracao'); // data modificação do produto
            $table->integer('qtd_inicial_produto'); // qtd inicial do produto
            $table->integer('qtd_final_produto'); // qtd inicial do produto
            $table->enum('tipo_operacao', ['add', 'remove']); // tipo de operação realizada
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
        Schema::dropIfExists('tb_mov_produtos');
    }
}
