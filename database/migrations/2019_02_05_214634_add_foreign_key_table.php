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
        Schema::table('tb_users', function (Blueprint $table) {            
            $table->foreign('idrol')->references('idrol')->on('tb_roles')->onDelete('cascade');
        });
        /**/
        Schema::table('tb_articulo', function (Blueprint $table) {            
            $table->foreign('idcategoria')->references('idcategoria')->on('tb_categoria')->onDelete('cascade');
        });
        /**/
        Schema::table('tb_detalle_ingreso', function (Blueprint $table) {            
            $table->foreign('idarticulo')->references('idarticulo')->on('tb_articulo')->onDelete('cascade');
            $table->foreign('idingreso')->references('idingreso')->on('tb_ingreso')->onDelete('cascade');
        });
        /**/
        Schema::table('tb_detalle_venta', function (Blueprint $table) {            
            $table->foreign('idarticulo')->references('idarticulo')->on('tb_articulo')->onDelete('cascade');
            $table->foreign('idventa')->references('idventa')->on('tb_venta')->onDelete('cascade');
        });
        /**/
        Schema::table('tb_ingreso', function (Blueprint $table) {            
            $table->foreign('idproveedor')->references('idpersona')->on('tb_persona')->onDelete('cascade');
        });
        /**/
        Schema::table('tb_venta', function (Blueprint $table) {            
            $table->foreign('idcliente')->references('idpersona')->on('tb_persona')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_users', function (Blueprint $table) {
            $table->dropForeign('tb_users_idrol_foreign');
        });
        Schema::table('tb_articulo', function (Blueprint $table) {
            $table->dropForeign('tb_articulo_idcategoria_foreign');
        });
        Schema::table('tb_detalle_ingreso', function (Blueprint $table) {
            $table->dropForeign('tb_detalle_ingreso_idarticulo_foreign');
            $table->dropForeign('tb_detalle_ingreso_idingreso_foreign');
        });
        Schema::table('tb_detalle_venta', function (Blueprint $table) {
            $table->dropForeign('tb_detalle_venta_idarticulo_foreign');
            $table->dropForeign('tb_detalle_venta_idventa_foreign');
        });
        Schema::table('tb_ingreso', function (Blueprint $table) {
            $table->dropForeign('tb_ingreso_idproveedor_foreign');
        });
        Schema::table('tb_venta', function (Blueprint $table) {
            $table->dropForeign('tb_venta_idcliente_foreign');
        });   
    }
}
