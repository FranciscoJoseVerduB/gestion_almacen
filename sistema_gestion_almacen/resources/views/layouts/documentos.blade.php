<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>@yield('title', 'Gestión Almacen')</title>       
 
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    
    <style> 
        p.cabecera{
            font-size: 12px;
            font-family: sans-serif;
            line-height: 10px;
        }

    </style>
</head>
<body  > 
    <div class="container-fluid">
        <div > 
            @yield('cabecera')
        </div>
        
        <hr>

        <div >
            @yield('lineas')
        </div>
 
    </div>
</body> 
</html>