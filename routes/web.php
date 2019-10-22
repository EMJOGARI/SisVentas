<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('principal/index', 'InicioController');
Route::resource('seguridad/usuario', 'UsuarioController');
/**/
Route::resource('seguridad/persona', 'PersonaController');
/**/
Route::resource('seguridad/precio_articulo', 'EditPrecioController');
Route::resource('almacen/categoria', 'CategoriaController');
Route::resource('almacen/articulo', 'ArticuloController');
Route::resource('ventas/venta', 'VentaController');
Route::resource('cobranza/banco', 'BancoController');
Route::resource('cobranza/cuenta-por-cobrar', 'CuentasporcobrarController');
Route::resource('compras/ingreso', 'IngresoController');
/* REPORTES ALMACEN */
Route::get('reporte/almacen/listado-producto', 'ReportealmacenController@reporte_almacen');
Route::get('reporte/almacen/margen-utilidad', 'ReportealmacenController@reporte_almacen_utilidad');
Route::get('reporte/almacen/resumen-inventario', 'ReportealmacenController@resumen_almacen');
Route::get('reporte/almacen/producto-menos-vendido', 'ReportealmacenController@articulo_menos_vendido');
Route::get('reporte/almacen/producto-mas-vendido', 'ReportealmacenController@articulo_mas_vendido');
/* REPORTES VENTAS */
Route::get('reporte/venta/venta-cliente', 'ReporteventaController@reporte_venta_cliente');
Route::get('reporte/venta/venta-vendedor', 'ReporteventaController@reporte_venta_vendedor');
Route::get('reporte/venta/venta-categoria', 'ReporteventaController@reporte_venta_categoria');
Route::get('reporte/venta/facturas-anuladas', 'ReporteventaController@reporte_factura_anulada');
/* REPORTES INGRESO */
Route::get('reporte/ingreso/ingreso-cliente', 'ReporteingresoController@reporte_ingreso_cliente');
Route::get('reporte/ingreso/analisis-vencimiento', 'ReporteingresoController@reporte_analisis_vencimiento');
/* REPORTE COMPRAS */
Route::get('reporte/compra/compra-proveedor', 'ReporteCompraController@reporte_compra_proveedor');
/* RANKING */
Route::get('reporte/ranking/cliente', 'RankingController@ranking_cliente');
Route::get('reporte/ranking/municipio', 'RankingController@ranking_municipio');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{slug?}', 'HomeController@index')->name('home');

Route::get('pdf/reportearticulo', 'ReporteController@ReporteArticulo');
Route::get('pdf/reportearticuloprecio', 'ReporteController@ReporteArticuloPrecio');

Route::get('pdf/reporteingreso', 'ReporteController@ReporteIngreso');
Route::get('pdf/reporteingresoid/{id}', 'ReporteController@ReporteIngresoID');

Route::get('pdf/reporteventa', 'ReporteController@ReporteVenta');
Route::get('pdf/reporteventaid/{id}', 'ReporteController@ReporteVentaID');

Route::get('pdf/reportepersona', 'ReporteController@ReportePersona');
Route::get('pdf/reportecliente', 'ReporteController@ReporteCliente');
Route::get('pdf/reporteproveedor', 'ReporteController@ReporteProveedor');
Route::get('pdf/reportevendedor', 'ReporteController@ReporteVendedor');

