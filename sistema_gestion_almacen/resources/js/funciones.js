


// ***************************************************************************
// GLOBALES ********************************************************************

var indice = 0;

$( document ).ready( function(){
    console.log('Se ha cargado la funcion al inicio del documento'); 
    console.log('La ruta es: ' + window.location.pathname);
    if(window.location.pathname.includes('recepciones/'))
        cargarPedidosPorProveedor( $("#proveedor_id option:selected").val()); 
    
});


// ***************************************************************************
//PEDIDOS ********************************************************************

//Funcion utilizada para eliminar una linea de pedido de compra
$('body').on('click', 'input.eliminarLineaPedido', function() {
    //console.log( $(this).parents('tr').find(".clase-id").val()); 
    $(this).parents('tr').remove();  
 });
 
 //Funcion utilizada para añadir una linea de pedido de compra
$('body').on('click', 'input.anadirLineaPedido', function() {
 
 console.log('Se ha hecho click en el evento para añadir una linea de pedido de compra. Indice actual: ' + indice); 

 //En caso de que el indice sea inferior al número de filas, se le asigna el mismo valor al indice
 //Esto se hará util cuando se edite el pedido de venta
 //asi se aplicará un indice dinámico, sin que se repita el indice de las filas
 if($('tbody >tr').length  > indice) indice = $('tbody >tr').length;

 indice = indice +1;

    $.ajax({
        type: "POST", 
        url:  "anadir-linea",
        data: {'indice':  indice , 'estado':'algo'},
        // contentType: false, 
        // processData: false,
        // async: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(datos) {
            console.log("Row Creado OK."); 
            $('tbody').append(datos); 
        }
    }); 
 });

 
    
// Funcion utilizada para buscar el precio del producto seleccionado
$('body').on('change', 'select.buscarPrecioProducto', function() 
{ 
    console.log('Se esta buscando el precio para el producto seleccionado');
    
    //Obtenemos el id del proveedor seleccionado
    var producto_id =  $(this).children("option:selected"). val();  
    var idPrecio =  $(this).attr('id').replace('producto_id', 'precio');
   
    $.ajax({
        type: "POST", 
        url:  "buscar-precio-producto",
        data: {'producto_id':  producto_id },
        // contentType: false, 
        // processData: false,
        // async: false, 
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(datos) {
            console.log('El precio encontrado para el producto es: ' + datos['producto'].codigo); 
             
            //Insertamos el precio encontrado en el producto seleccionado
            document.getElementById(idPrecio).value = datos.producto.precio; 
            
            //Seteamos los valores a 0 
            document.getElementById(idPrecio.replace('precio', 'cantidad')).value = 0; 
            document.getElementById(idPrecio.replace('precio', 'importe')).value = 0;  
        }
    }); 

}); 
  
$('body').on('input', 'input.calcularImporteLineaPedido', function() {
    var idActual = $(this).attr('id');

    //Obtenemos los campos de la misma linea de la tabla
    var idCantidad =  idActual.replace('precio', 'cantidad');
    var idPrecio =  idActual.replace('cantidad', 'precio');
    var idImporte =  idActual.replace('precio', 'importe').replace('cantidad', 'importe');
 

    //Calculamos el importe y lo asignamos en importe
    document.getElementById(idImporte).value = (parseFloat(document.getElementById(idCantidad).value) * parseFloat(document.getElementById(idPrecio).value)) ;
 
    //Establecemos el valor a 0 si es null el importe
    if(document.getElementById(idImporte).value == null) document.getElementById(idImporte).value = '0'; 
 });
  
//********************************************************************************
//RECEPCIONES ********************************************************************

// Funcion utilizada para eliminar una linea de recepcion
$('body').on('click', 'input.eliminarLineaRecepcion', function() {
    //console.log( $(this).parents('tr').find(".clase-id").val()); 
    $(this).parents('tr').remove();  
 });
  //Funcion utilizada para añadir una linea de pedido de compra
$('body').on('click', 'input.anadirLineaRecepcion', function() {
 
    console.log('Se ha hecho click en el evento para añadir una linea de recepcion. Indice actual: ' + indice); 
   
    //En caso de que el indice sea inferior al número de filas, se le asigna el mismo valor al indice
    //Esto se hará util cuando se edite el pedido de venta
    //asi se aplicará un indice dinámico, sin que se repita el indice de las filas
    if($('tbody >tr').length  > indice) indice = $('tbody >tr').length;
   
    indice = indice +1;
   
       $.ajax({
           type: "POST",
           url:  "anadir-linea",
           data: {'indice':  indice}, 
           // contentType: false, 
           // processData: false,
           // async: false,
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function(datos) {
               console.log("Row Creado OK."); 
               $('tbody').append(datos); 
           }
       }); 
});

function cargarPedidosPorProveedor(proveedor_id){
    
    console.log( 'Se esta cambiando de opcion en el proveedor. proveedor_id: ' +  proveedor_id); 

    //Nos comunicamos con el método del controlador
    $.ajax({
        type: "POST",
        url:  "lista-pedidos",
        data: {'proveedor_id':  proveedor_id}, 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(datos) {
            console.log("Datos Modal actualizado OK."); 
            $('#listaPedidos').empty(); 
            $('#listaPedidos').append(datos); 
        }
    });   
}


// Funcion utilizada para actualizar la lista de pedidos que se pueden rescatar desde una recepción, por proveedor
$('body').on('change', 'select.actualizarListaPedidos-modal', function() 
 { 
    //Obtenemos el id del proveedor seleccionado
    var proveedor_id =  $(this).children("option:selected"). val();
    cargarPedidosPorProveedor(proveedor_id);
});
 

$('body').on('click', 'button.anadirLineaPedidoEnRecepcion', function() {
    console.log('Se ha hecho click en el boton guardar del modal');
 
    var selecteditems = []; 
    $("#listaPedidos").find("input:checked").each(function (i, ob) { 
        selecteditems.push($(ob).attr('id'));
      });
    console.log(selecteditems);

    //Borramos todas las filas que sean añadidas a partir de los checkbox
    //Es decir, si ha sido añadido y tiene un input con la class row-lineaPedido, borramos ese row 
    $('.row-lineaPedido').parents('tr').remove(); 
 

    //Si el array contiene algun elemento, hacemos una solicitud via ajax
    if(selecteditems.length > 0){
 
        if($('tbody >tr').length  > indice) indice = $('tbody >tr').length; 
        indice = indice + 1;
    //Nos comunicamos con el método del controlador
    $.ajax({
                type: "POST",
                url:  "anadirLineaPedidoEnRecepcion",
                data: {'lineasPedido_id':  selecteditems, 'indice': indice}, 
                dataType:"json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(datos) { 
                    console.log("Row añadido. Indice:" + datos['indice']); 
                    indice = datos['indice'];
                    $('tbody').append(datos['row']);

                }
        });
    } 
});

//*********************************************************************************************************
//DOCUMENTOS DE REGULARIZACION DE STOCK ********************************************************************
//Funcion utilizada para eliminar una linea de un documento de regularización de stock
$('body').on('click', 'input.eliminarLineaRegularizacionManual', function() {
   // console.log( $(this).parents('tr').find(".clase-id").val()); 
    $(this).parents('tr').remove();  
 });

 
 //Funcion utilizada para añadir una linea de un documento de regularizacion
$('body').on('click', 'input.anadirLineaRegularizacionManual', function() {
 
    console.log('Se ha hecho click en el evento para añadir una linea de Regularizacion Manual. Indice actual: ' + indice); 
   
    //En caso de que el indice sea inferior al número de filas, se le asigna el mismo valor al indice 
    //asi se aplicará un indice dinámico, sin que se repita el indice de las filas
    if($('tbody >tr').length  > indice) indice = $('tbody >tr').length;

    
    //Obtenemos el id del almacen seleccionado
    var almacen_id =  $("#almacen_id").children("option:selected").val(); 
    console.log('El almacen seleccionado es: ' + almacen_id);
   
    indice = indice +1;
   
       $.ajax({
           type: "POST", 
           url:  "anadir-linea",
           data: {'indice':  indice, 'almacen_id':  almacen_id },
           // contentType: false, 
           // processData: false,
           // async: false,
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function(datos) {
               console.log("Row Creado OK."); 
               $('tbody').append(datos); 
           }
       }); 
    });
   

        
// Funcion utilizada para buscar el precio del producto seleccionado
$('body').on('change', 'select.buscarStockProductoPorAlmacen', function() 
{ 
    console.log('Se esta buscando la cantidad de stock para el producto y almacen seleccionado');
    
    var idEntidad = $(this).attr('id');
    //Obtenemos el id del producto seleccionado
    var producto_id =  $(this).children("option:selected").val();  
    
    //Obtenemos el id del almacen seleccionado
    var almacen_id =  $("#almacen_id").children("option:selected").val(); 

    $.ajax({
        type: "POST", 
        url:  "buscar-cantidad",
        data: {'producto_id':  producto_id, 'almacen_id': almacen_id },
        // contentType: false, 
        // processData: false,
        // async: false, 
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(datos) {
            console.log('La cantidad de stock para el producto es: ' + datos['stock'].cantidad); 
            
            //Asignamos la cantidad que tiene el producto en el almacen seleccionado
            document.getElementById(idEntidad.replace('producto_id', 'cantidad')).value =  datos.stock. cantidad; 
             
            if(document.getElementById(idEntidad.replace('producto_id', 'cantidad')).value == '')
                document.getElementById(idEntidad.replace('producto_id', 'cantidad')).value = 0;
        }
    }); 

}); 