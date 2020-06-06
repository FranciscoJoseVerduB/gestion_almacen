<?php

use App\Almacen;
use Illuminate\Support\Facades\Route;

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


//Rutas auth 
Auth::routes();



//Usuarios
Route::resource('usuarios', 'UserController')->names('usuarios');
Route::resource('roles', 'RolController')->names('roles')->parameters(['roles'=>'rol']);

//Articulos 
Route::get('/articulos', 'ArticuloController@index')->name('articulos');
Route::resource('productos', 'ProductoController')->names('productos'); 
Route::resource('impuestos', 'ImpuestoController')->names('impuestos'); 
Route::resource('marcas', 'MarcaController')->names('marcas');
Route::resource('familias', 'FamiliaController')->names('familias');
Route::resource('subfamilias', 'SubfamiliaController')->names('subfamilias');

//Proveedores/Almacenes
Route::resource('proveedores', 'ProveedorController')->names('proveedores')->parameters(['proveedores'=>'proveedor']);
Route::resource('almacenes', 'AlmacenController')->names('almacenes')->parameters(['almacenes'=>'almacen']);

//Pedidos 
//En construccion
Route::resource('pedidos_compra', 'PedidoCompraController')->names('pedidos_compra')->parameters(['pedidos_compra'=>'pedido_compra']);
Route::prefix('pedidos_compra')->group(function(){
    Route::post('{pedido_compra}/anadir-linea', 'PedidoCompraController@anadirLineaTabla')->name('pedidos_compra.anadir-linea');
    Route::post('anadir-linea', 'PedidoCompraController@anadirLineaTabla')->name('pedidos_compra.anadir-linea');
    Route::post('buscar-precio-producto', 'PedidoCompraController@buscarPrecioProducto')->name('pedidos_compra.buscar-precio-producto'); 
    Route::any('{pedido_compra}/ver-pdf', 'PedidoCompraController@visualizarPedido')->name('pedidos_compra.ver-pdf'); 
});



//Recepciones
//En construccion
Route::resource('recepciones', 'RecepcionController')->names('recepciones')->parameters(['recepciones'=>'recepcion']);
Route::prefix('recepciones')->group(function(){ 
    Route::post('{recepcion}/anadir-linea', 'RecepcionController@anadirLineaTabla')->name('recepciones.anadir-linea');
    Route::post('anadir-linea', 'RecepcionController@anadirLineaTabla')->name('recepciones.anadir-linea');
    
    Route::post('{recepcion}/lista-pedidos', 'RecepcionController@listaPedidosPorProveedor')->name('recepciones.lista-pedidos');
    Route::post('lista-pedidos', 'RecepcionController@listaPedidosPorProveedor')->name('recepciones.lista-pedidos');
    
    Route::post('{recepcion}/anadirLineaPedidoEnRecepcion', 'RecepcionController@anadirLineaPedidoEnRecepcion')->name('recepciones.anadirLineaPedidoEnRecepcion');
    Route::post('anadirLineaPedidoEnRecepcion', 'RecepcionController@anadirLineaPedidoEnRecepcion')->name('recepciones.anadirLineaPedidoEnRecepcion');
    Route::any('{recepcion}/ver-pdf', 'RecepcionController@visualizarRecepcion')->name('recepciones.ver-pdf'); 
});



//Stocks
Route::resource('stocks', 'StockController')->names('stocks');
Route::prefix('stocks')->group(function(){
    Route::post('regularizarStock', 'StockController@regularizarStock')->name('stocks.regularizarStock');
    Route::any('{user}/ver-pdf', 'StockController@visualizarInformeStock')->name('stocks.ver-pdf');     
});


//Regularizaciones de stock
Route::resource('regularizaciones_manual', 'RegularizacionManualController')->names('regularizaciones_manual')->parameters(['regularizaciones_manual'=>'regularizacion_manual']);
Route::prefix('regularizaciones_manual')->group(function(){
    Route::post('anadir-linea', 'RegularizacionManualController@anadirLineaTabla')->name('regularizaciones_manual.anadir-linea');
    Route::post('{regularizacion}/anadir-linea', 'RegularizacionManualController@anadirLineaTabla')->name('regularizaciones_manual.anadir-linea');     
    
    Route::post('{regularizacion}/buscar-cantidad', 'RegularizacionManualController@buscarCantidadStockPorAlmacen')->name('regularizaciones_manual.buscar-cantidad');     
    Route::post('buscar-cantidad', 'RegularizacionManualController@buscarCantidadStockPorAlmacen')->name('regularizaciones_manual.buscar-cantidad');     
    Route::any('{regularizacion}/ver-pdf', 'RegularizacionManualController@visualizarRegularizacion')->name('regularizaciones_manual.ver-pdf'); 
});


//Ruta Home
Route::get('/', 'HomeController@index')->name('home');










 