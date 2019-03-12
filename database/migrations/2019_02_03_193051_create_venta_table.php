<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_venta', function (Blueprint $table) {
            $table->increments('idventa');
            $table->integer('idcliente')->unsigned();
            $table->string('tipo_comprobante',10);
            $table->string('serie_comprobante',10);
            $table->string('num_comprobante',10);
            $table->decimal('total_venta',11,2);
            $table->string('estado',10);
            $table->date('fecha_hora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::dropIfExists('tb_venta');
    }
}
