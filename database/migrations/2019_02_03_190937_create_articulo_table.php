<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->increments('idarticulo');
            $table->integer('idcategoria')->unsigned();
            $table->string('codigo',30);
            $table->string('nombre',30);
            $table->string('descripcion',150);            
            $table->integer('stock');
            $table->decimal('costo',11,2);
            $table->string('estado',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {       
        Schema::dropIfExists('articulo');
    }
}
