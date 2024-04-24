<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/estilosLayout.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <title>ChefControl</title>
    {{-- enlace a boostrap 5 css --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/cssclsbootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    {{-- enlace a estilos de css personalizados --}}
    @yield('style')
    {{-- <link rel="stylesheet" href="{{ asset('/css/style.css')}}"> --}}
</head>
<body>
    {{-- <div class="contenedorRegistro"> --}}
        <header class="headerRecetas">
            <div class="contenedorHR">
                <div>
                    <img class="logo1Recetas" src="{{asset('imagenes/proyecto/logo.svg')}}">
                </div>
                <div class="usuarioRecetas">
                   
                    <h2>{{Auth::user()->Nombre}}</h2>
                    <?php
                    $rol =  App\Models\tbl_rol::where('Id_Rol', Auth::user()->Id_Rol)->first();
                    ?>
                    <h4>{{$rol->Rol}}</h4>
                </div>
                <div class="btnMenuR">
                    <label for="btnMenu">Menú</label>
                </div>
                <input type="checkbox" id="btnMenu">
                <nav class="menuRecetas">
                    <div class="menu-item">
                        <a href="{{route('receta.recetario')}}">Inicio</a>
                    </div>
                    <div class="menu-item">
                        <a href="#">Recetas</a>
                        <div class="submenu">
                            <a href="{{route('receta.create')}}">Nueva Receta</a>
                            <a href="{{route('detalleReceta.create')}}">Agregar Detalle a una Receta</a>
                            <a href="{{route('crudrecetas')}}">Recetas Activas</a>
                            <a href="{{route('crudrecetas.inactivas')}}">Recetas Inactivas</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Productos</a>
                        <div class="submenu">
                            <a href="{{route('producto.create')}}">Nuevo Producto</a>
                            <a href="{{route('crudproductos')}}">Lista de Productos</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Listas de Chequeo</a>
                        <div class="submenu">
                            <a href="{{route('lista.inicio')}}">Lista Inicio de Jornada</a>
                            <a href="{{route('lista.fin')}}">Lista Fin de Jornada</a>
                            @if (Auth::user()->Id_Rol == '1')
                            <a href="{{route('crud.listainicio')}}">Listas Inicio de Jornada Registradas</a>
                            <a href="{{route('crud.listafin')}}">Listas Fin de Jornada Registradas</a>    
                            @endif
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Orden de Producción</a>
                        <div class="submenu">
                            <a href="{{route('orden.produccion')}}">Nueva Orden</a>
                            <a href="{{route('ordenes.espera')}}">Ordenes en Espera</a>
                            <a href="{{route('ordenes.preparacion')}}">Ordenes en Preparación</a>
                            <a href="{{route('ordenes.entregadas')}}">Ordenes Entregadas</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Clientes</a>
                        <div class="submenu">
                            @if (Auth::user()->Id_Rol == '1')
                            <a href="{{route('clienteCrear')}}">Registrar Cliente</a>
                            @endif
                            <a href="{{route('crudclientes')}}">Lista de Clientes</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Usuarios</a>
                        <div class="submenu">
                            @if (Auth::user()->Id_Rol == '1')
                            <a href="{{route('Admin.create')}}">Registrar Usuario</a>
                            @endif
                            <a href="{{route('usuarios.index')}}">Lista de Usuarios</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Opciones</a>
                        <div class="submenu">
                            
                            <a href="{{route('logout')}}">Cerrar Sesión</a>
                            
                        </div>
                    </div>
                </nav>
  
            </div>
        </header>
    {{-- </div> --}}
    {{-- <div class="container mt-4"> --}}
        @yield('content')
    {{-- </div> --}}
    <!-- enlace de la libreria de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    {{-- enalce a scripts personalizados del aplicativo --}}
    <script src="{{asset('js/SweetAlerts.js')}}">
    </script>     
    {{-- enlace a boostrap 5 js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>