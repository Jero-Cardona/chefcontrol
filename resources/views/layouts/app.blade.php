<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/estilosRegister.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <title>ChefControl</title>
    {{-- enlace a boostrap 5 css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- enlace a estilos de css personalizados --}}
    @yield('style')
    {{-- <link rel="stylesheet" href="{{ asset('/css/style.css')}}"> --}}
</head>
<body>
    {{-- <div class="contenedorRegistro"> --}}
        <header class="headerIndex">
            <div class="contenedorHIndex">
                <div>
                    <img class="logoHIndex" src="{{asset('imagenes/proyecto/logo.svg')}}">
                </div>
                @auth
                {{-- <div class="NombreProyectoIndex">
                    <h2>{{Auth::user()->Id_Empleado}}</h2>
                </div> --}}
                @endauth
                <div class="NombreProyectoIndex">
                    <h2 style="margin-top: 15px">ChefControl</h2>
                </div>
                <div class="btnMenuHIndex">
                    <label for="btnMenu">Menú</label>
                </div>
                <input type="checkbox" id="btnMenu">
                <nav class="menuHIndex">
                    <a href="{{route('usuarios.index')}}">Inicio</a>
                    @auth
                        <form action="{{'logout'}}" method="post">
                            @csrf
                            <a href="#" onclick="this.closets('form').submit()">Salir</a>
                        </form>
                    @endauth
                </nav>
            </div>
        </header>
    {{-- </div> --}}
    <div class="container mt-4">
        @yield('content')
    </div>
    {{-- enlace a boostrap 5 js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>