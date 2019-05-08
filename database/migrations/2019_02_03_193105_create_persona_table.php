<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_persona', function (Blueprint $table) {
            $table->increments('idpersona');
            $table->string('tipo_persona',15);           
            $table->string('nombre',50);
            $table->string('tipo_documento',10);
            $table->string('num_documento',15)->unique();
            $table->string('direccion',255);
            $table->string('telefono',15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_persona');
    }
}
