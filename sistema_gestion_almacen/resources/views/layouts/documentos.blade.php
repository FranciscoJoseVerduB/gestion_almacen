<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', 'Gestión Almacen')</title>       
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 

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