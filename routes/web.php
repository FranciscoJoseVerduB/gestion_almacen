<?php

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
Route::post('pedidos_compra/{pedido_compra}/anadir-linea', 'PedidoCompraController@anadirLineaTabla')->name('pedidos_compra.anadir-linea');
Route::post('pedidos_compra/anadir-linea', 'PedidoCompraController@anadirLineaTabla')->name('pedidos_compra.anadir-linea');
Route::post('pedidos_compra/buscar-precio-producto', 'PedidoCompraController@buscarPrecioProducto')->name('pedidos_compra.buscar-precio-producto');


//Recepciones
//En construccion
Route::resource('recepciones', 'RecepcionController')->names('recepciones')->parameters(['recepciones'=>'recepcion']);
Route::post('recepciones/{recepcion}/anadir-linea', 'RecepcionController@anadirLineaTabla')->name('recepciones.anadir-linea');
Route::post('recepciones/anadir-linea', 'RecepcionController@anadirLineaTabla')->name('recepciones.anadir-linea');

Route::post('recepciones/{recepcion}/lista-pedidos', 'RecepcionController@listaPedidosPorProveedor')->name('recepciones.lista-pedidos');
Route::post('recepciones/lista-pedidos', 'RecepcionController@listaPedidosPorProveedor')->name('recepciones.lista-pedidos');

Route::post('recepciones/{recepcion}/anadirLineaPedidoEnRecepcion', 'RecepcionController@anadirLineaPedidoEnRecepcion')->name('recepciones.anadirLineaPedidoEnRecepcion');
Route::post('recepciones/anadirLineaPedidoEnRecepcion', 'RecepcionController@anadirLineaPedidoEnRecepcion')->name('recepciones.anadirLineaPedidoEnRecepcion');




//Stocks
Route::resource('stocks', 'StockController')->names('stocks');
Route::post('stocks/regularizarStock', 'StockController@regularizarStock')->name('stocks.regularizarStock');


//Regularizaciones de stock
Route::resource('regularizaciones_manual', 'RegularizacionManualController')->names('regularizaciones_manual')->parameters(['regularizaciones_manual'=>'regularizacion_manual']);
Route::post('regularizaciones_manual/anadir-linea', 'RegularizacionManualController@anadirLineaTabla')->name('regularizaciones_manual.anadir-linea');
Route::post('regularizaciones_manual/{regularizacion}/anadir-linea', 'RegularizacionManualController@anadirLineaTabla')->name('regularizaciones_manual.anadir-linea');



//Ruta Home
Route::get('/', 'HomeController@index')->name('home');












//Pruebas. Crear un documento word desde html
Route::get('/docs-generate', function(){ 
    $headers = array( 
        "Content-type"=>"text/html",
        "Content-Disposition"=>"attachment;Filename=myGeneratefile.doc" 
    ); 
    $content = '<html> 
            <head><meta charset="utf-8"></head> 
                <body> 
                    <p>My Blog Laravel 7 generate word document from html Example - Nicesnippets.com</p> 
                    <ul>
                        <li>Php</li>
                        <li>Laravel</li>
                        <li>Html</li>
                    </ul> 
                </body> 
            </html>'; 
    return \Response::make($content,200, $headers); 
});

