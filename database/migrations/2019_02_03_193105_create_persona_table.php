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
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('idpersona');
            $table->string('tipo_persona',10);           
            $table->string('nombre',30);
            $table->string('tipo_documento',10);
            $table->string('num_documento',15);
            $table->string('direccion',150);
            $table->string('telefono',15);
            $table->string('email',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
