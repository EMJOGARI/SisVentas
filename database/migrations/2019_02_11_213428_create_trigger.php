<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /*PGSQL*/
        DB::unprepared('

            CREATE OR REPLACE FUNCTION StockNotaCredito() RETURNS TRIGGER AS $$
            DECLARE
            BEGIN
               
                UPDATE tb_articulo AS a SET stock = stock + NEW.cantidad WHERE a.idarticulo = NEW.idarticulo;

                RETURN NULL;

            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER Trigger_Stock_Nota_Credito AFTER INSERT ON tb_detalle_node FOR EACH ROW 
            EXECUTE PROCEDURE StockNotaCredito();

        ');
		DB::unprepared('

	    	CREATE OR REPLACE FUNCTION StockIngresar() RETURNS TRIGGER AS $$
			DECLARE
			BEGIN
			   
    			UPDATE tb_articulo AS a SET stock = stock + NEW.cantidad WHERE a.idarticulo = NEW.idarticulo;

			    RETURN NULL;

			END;
			$$ LANGUAGE plpgsql;

			CREATE TRIGGER Trigger_Stock_Ingresar AFTER INSERT ON tb_detalle_ingreso FOR EACH ROW 
            EXECUTE PROCEDURE StockIngresar();

		');

		DB::unprepared('

			CREATE OR REPLACE FUNCTION StockVenta() RETURNS TRIGGER AS $$
			DECLARE
			BEGIN
			    
			    UPDATE tb_articulo AS a SET stock = stock - NEW.cantidad WHERE a.idarticulo = NEW.idarticulo;

			    RETURN NULL;

			END;
			$$ LANGUAGE plpgsql;

			CREATE TRIGGER Trigger_Stock_Venta AFTER INSERT ON tb_detalle_venta FOR EACH ROW 
            EXECUTE PROCEDURE StockVenta();
        	
    	');

        /*MYSQL*/
        /*DB::unprepared('
            CREATE TRIGGER StockIngresar AFTER INSERT ON tb_detalle_ingreso FOR EACH ROW 
                BEGIN
                    UPDATE tb_articulo SET stock = stock + new.cantidad
                    WHERE articulo.idarticulo = new.idarticulo;
                END 
        ');

        DB::unprepared('
            CREATE TRIGGER StockVenta AFTER INSERT ON tb_detalle_venta FOR EACH ROW 
                BEGIN
                    UPDATE tb_articulo SET stock = stock - new.cantidad
                    WHERE articulo.idarticulo = new.idarticulo;
                END
        ');*/
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {/*
        DB::unprepared('DROP TRIGGER StockIngresar');
        DB::unprepared('DROP TRIGGER StockVenta');*/
    }
}
