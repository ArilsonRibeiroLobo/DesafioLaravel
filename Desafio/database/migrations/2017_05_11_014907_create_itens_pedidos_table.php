<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItensPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('idPedido')->unsigned();
            $table->integer('idItem')->unsigned();
        });
        Schema::table('itens_pedidos', function($table) {
            $table->foreign('idPedido')->references('id')->on('pedidos');
            $table->foreign('idItem')->references('id')->on('itens');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_pedidos');
    }
}
