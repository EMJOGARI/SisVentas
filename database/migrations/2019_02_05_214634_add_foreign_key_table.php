<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**/
        Schema::table('users', function (Blueprint $table) {            
            $table->foreign('idrol')->references('idrol')->on('roles')->onDelete('cascade');
        });
        /**/
        Schema::table('articulo', function (Blueprint $table) {            
            $table->foreign('idcategoria')->references('idcategoria')->on('categoria')->onDelete('cascade');
        });
        /**/
        Schema::table('detalle_ingreso', function (Blueprint $table) {            
            $table->foreign('idarticulo')->references('idarticulo')->on('articulo')->onDelete('cascade');
            $table->foreign('idingreso')->references('idingreso')->on('ingreso')->onDelete('cascade');
        });
        /**/
        Schema::table('detalle_venta', function (Blueprint $table) {            
            $table->foreign('idarticulo')->references('idarticulo')->on('articulo')->onDelete('cascade');
            $table->foreign('idventa')->references('idventa')->on('venta')->onDelete('cascade');
        });
        /**/
        Schema::table('ingreso', function (Blueprint $table) {            
            $table->foreign('idproveedor')->references('idpersona')->on('persona')->onDelete('cascade');
        });
        /**/
        Schema::table('venta', function (Blueprint $table) {            
            $table->foreign('idcliente')->references('idpersona')->on('persona')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_idrol_foreign');
        });
        Schema::table('articulo', function (Blueprint $table) {
            $table->dropForeign('articulo_idcategoria_foreign');
        });
        Schema::table('detalle_ingreso', function (Blueprint $table) {
            $table->dropForeign('detalle_ingreso_idarticulo_foreign');
            $table->dropForeign('detalle_ingreso_idingreso_foreign');
        });
        Schema::table('detalle_venta', function (Blueprint $table) {
            $table->dropForeign('detalle_venta_idarticulo_foreign');
            $table->dropForeign('detalle_venta_idventa_foreign');
        });
        Schema::table('ingreso', function (Blueprint $table) {
            $table->dropForeign('ingreso_idproveedor_foreign');
        });
        Schema::table('venta', function (Blueprint $table) {
            $table->dropForeign('venta_idcliente_foreign');
        });   
    }
}
