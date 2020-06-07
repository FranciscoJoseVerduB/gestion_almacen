<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', 'Gestión Almacen')</title>    
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script src="{{ mix('js/app.js') }}" defer ></script>  
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    


</head>
<body  > 
    <div id="app" class="d-flex flex-column  h-screen justify-content-between">
        <div class="header-nav">
            <div class="container-fluid">
             <header>
                <header>
                    @include('partials.nav') 
                    @include('partials.session-status')
                </header>
              </header>
            </div>
          </div>
        

        <main class="my-0">
            @yield('content')
        </main>

       @include('partials.footer')

    </div>
</body> 
</html>