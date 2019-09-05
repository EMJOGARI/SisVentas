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
Route::resource('seguridad/persona', 'PersonaController');
Route::resource('seguridad/precio_articulo', 'EditPrecioController');
Route::resource('almacen/categoria', 'CategoriaController');
Route::resource('almacen/articulo', 'ArticuloController');
Route::resource('ventas/venta', 'VentaController');
Route::resource('compras/ingreso', 'IngresoController');
Route::get('reporte/almacen/listado-producto', 'ReporteController@reporte_almacen');
Route::get('reporte/almacen/margen-utilidad', 'ReporteController@reporte_almacen_utilidad');
Route::get('reporte/venta', 'ReporteController@reporte_venta');


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

