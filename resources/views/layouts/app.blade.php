<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('/css/estilosLayout.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('imagenes/proyecto/logo.svg') }}">
    <title>@yield('title')</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/cssclsbootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    @yield('style')
    <!-- enlace de la libreria de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    {{-- <div class="contenedorRegistro"> --}}
    <header class="headerRecetas">
        <div class="contenedorHR">
            <div>
                <img class="logo1Recetas" src="{{ asset('imagenes/proyecto/logo.svg') }}">
            </div>
            <div class="usuarioRecetas">

                <h2>{{ Auth::user()->Nombre .''. Auth::user()->Apellido }}</h2>
                <?php
                $rol = App\Models\tbl_rol::where('Id_Rol', Auth::user()->Id_Rol)->first();
                ?>
                <h4>{{ $rol->Rol }}</h4>
            </div>
            <div class="btnMenuR">
                <label for="btnMenu">Menú</label>
            </div>
            <input type="checkbox" id="btnMenu">
            <nav class="menuRecetas">
                <div class="menu-item">
                    <a href="{{ route('receta.recetario') }}">Inicio</a>
                </div>
                <div class="menu-item">
                    <a href="#">Recetas</a>
                    <div class="submenu">
                        <a href="{{ route('receta.create') }}">Nueva receta</a>
                        <a href="{{ route('detalleReceta.create') }}">Agregar detalle a una receta</a>
                        <a href="{{ route('crudrecetas') }}">Lista de recetas</a>
                        <a href="{{ route('crudrecetas.inactivas') }}">Recetas inactivas</a>
                        <a href="{{ route('crudrecetas.espera') }}">Recetas en espera </a>
                        
                        @if (Auth::user()->Id_Rol == '2')
                            <a href="{{ route('recetas.sugeridas') }}">Mis recetas sugeridas</a>
                        @endif

                    </div>
                </div>
                <div class="menu-item">
                    <a href="#">Productos</a>
                    <div class="submenu">
                        <a href="{{ route('producto.create') }}">Nuevo producto</a>
                        <a href="{{ route('crudproductos') }}">Lista de productos</a>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="#">Listas de chequeo</a>
                    <div class="submenu">
                        <a href="{{ route('lista.inicio') }}">Lista Inicio de jornada</a>
                        <a href="{{ route('lista.fin') }}">Lista Fin de jornada</a>
                        @if (Auth::user()->Id_Rol == '1')
                            <a href="{{ route('crud.listainicio') }}">Listas Inicio de jornada registradas</a>
                            <a href="{{ route('crud.listafin') }}">Listas Fin de jornada registradas</a>
                        @endif
                    </div>
                </div>
                <div class="menu-item">
                    <a href="#">Orden de producción</a>
                    <div class="submenu">
                        <a href="{{ route('orden.produccion') }}">Nueva orden</a>
                        <a href="{{ route('ordenes.espera') }}">Ordenes en espera</a>
                        <a href="{{ route('ordenes.preparacion') }}">Ordenes en preparación</a>
                        <a href="{{ route('ordenes.entregadas') }}">Ordenes entregadas</a>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="#">Clientes</a>
                    <div class="submenu">
                        @if (Auth::user()->Id_Rol == '1')
                            <a href="{{ route('clienteCrear') }}">Registrar cliente</a>
                        @endif
                        <a href="{{ route('crudclientes') }}">Lista de clientes</a>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="#">Usuarios</a>
                    <div class="submenu">
                        @if (Auth::user()->Id_Rol == '1')
                            <a href="{{ route('Admin.create') }}">Registrar usuario</a>
                        @endif
                        <a href="{{ route('usuarios.index') }}">Lista de usuarios</a>
                    </div>
                </div>
                <div class="menu-item">
                    <a href="#">Opciones</a>
                    <div class="submenu">

                        <a href="{{ route('logout') }}">Cerrar sesión</a>

                    </div>
                </div>
            </nav>

        </div>
    </header>
    @yield('content')
    {{-- link de error de busqueda --}}
    @if (session('mensaje'))
        <script>
            Swal.fire({
                position: "center",
                icon: "info",
                title: "Intenta buscar de nuevo, este registro no existe",
                text: "{{ session('mensaje') }}",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });
        </script>
    @endif
    @if (session('status'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Registro guardado correctamente",
                text: "{{ session('status') }}",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });
        </script>
    @endif
    @if (session('ordenes'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "¡Listo!",
            text: "{{ session('ordenes') }}",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
        });
    </script>
@endif
    {{-- enalce a scripts personalizados del aplicativo --}}
    <script src="{{ asset('js/SweetAlerts.js') }}"></script>
    {{-- enlace a boostrap 5 js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
