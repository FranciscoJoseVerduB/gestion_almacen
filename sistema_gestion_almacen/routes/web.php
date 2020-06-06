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
    
});



//Stocks
Route::resource('stocks', 'StockController')->names('stocks');
Route::post('stocks/regularizarStock', 'StockController@regularizarStock')->name('stocks.regularizarStock');


//Regularizaciones de stock
Route::resource('regularizaciones_manual', 'RegularizacionManualController')->names('regularizaciones_manual')->parameters(['regularizaciones_manual'=>'regularizacion_manual']);
Route::prefix('regularizaciones_manual')->group(function(){
    Route::post('anadir-linea', 'RegularizacionManualController@anadirLineaTabla')->name('regularizaciones_manual.anadir-linea');
    Route::post('{regularizacion}/anadir-linea', 'RegularizacionManualController@anadirLineaTabla')->name('regularizaciones_manual.anadir-linea');     
    
    Route::post('{regularizacion}/buscar-cantidad', 'RegularizacionManualController@buscarCantidadStockPorAlmacen')->name('regularizaciones_manual.buscar-cantidad');     
    Route::post('buscar-cantidad', 'RegularizacionManualController@buscarCantidadStockPorAlmacen')->name('regularizaciones_manual.buscar-cantidad');     
});


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


Route::get('/docs-pdf', function(){ 
    $headers = array( 
        "Content-type"=>"text/html",
        "Content-Disposition"=>"attachment;Filename=myGeneratefile.doc" 
    ); 
    $content = '<style>
    .page-break {
        page-break-after: always;
    }
    </style>
    <h1>Page 1</h1>
    <div class="page-break"></div>
    <h1>Page 2</h1>'; 

    // $pdf = App::make('dompdf.wrapper');
    // $pdf->loadHTML($content);
    // return $pdf->stream(); 

 
    $almacen = Almacen::first();
    $data = [
        'almacen' =>$almacen,  
        'sujeto' => $almacen->sujeto,
        'direccion' => $almacen->sujeto->direccion,
        'geolocalizacion' => $almacen->geolocalizacion
    ];
 
    return PDF::loadView('almacenes/edit', $data)->stream('archivo.pdf');
 
    // Storage::disk('public')->put('almacen-edit.pdf', $content);
   

    // return response()->file('almacen-edit.pdf');

});





