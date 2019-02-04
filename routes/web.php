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

Route::resource('seguridad/usuario', 'UsuarioController');
Route::resource('almacen/categoria', 'CategoriaController');
Route::resource('almacen/articulo', 'ArticuloController');
Route::resource('ventas/cliente', 'ClienteController');
Route::resource('ventas/venta', 'VentaController');
Route::resource('compras/proveedor', 'ProveedorController');
Route::resource('compras/ingreso', 'IngresoController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{slug?}', 'HomeController@index')->name('home');

Route::get('pdf/reportearticulo', 'ReporteController@ReporteArticulo');

Route::get('pdf/reporteingreso', 'ReporteController@ReporteIngreso');
Route::get('pdf/reporteingresoid/{id}', 'ReporteController@ReporteIngresoID');

Route::get('pdf/reporteventa', 'ReporteController@ReporteVenta');
Route::get('pdf/reporteventaid/{id}', 'ReporteController@ReporteVentaID');

Route::get('pdf/reportecliente', 'ReporteController@ReporteCliente');
Route::get('pdf/reporteproveedor', 'ReporteController@ReporteProveedor');