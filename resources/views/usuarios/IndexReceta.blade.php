
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('/css/estilosReceta.css')}}" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="icon" href="{{ asset('imagenes/proyecto/logo.svg') }}">
        <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
        <title>Chef Control | Recetario</title>
</head>
<body>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    
    <div class="contenedorRecetas">
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
                            <a href="{{route('crudrecetas')}}">Lista de Recetas</a>
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
                            <a href="{{route('crud.listainicio')}}">Listas Inicio de Jornada Registradas</a>
                            <a href="{{route('crud.listafin')}}">Listas Fin de Jornada Registradas</a>
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
                            <a href="{{route('clienteCrear')}}">Nuevo Cliente</a>
                            <a href="{{route('crudclientes')}}">Lista de Clientes</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Usuarios</a>
                        <div class="submenu">
                            <a href="{{route('usuarios.create')}}">Nuevo Usuario</a>
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
        <div class="contenedor1Recetas">
            <img class="fondo1Recetas" src="{{asset('imagenes/proyecto/image33.png')}}">
            <div class="caja1Recetas">
                <img class="logo2Recetas" src="{{asset('imagenes/proyecto/logo.svg')}}">
                <h2 class="textRecetas1">Bienvenidos a nuestro sitio web</h2>
                <p class="textRecetas2">El recetario es un libro que contiene recetas culinarias. La receta se caracteriza por indicar los elementos que entran en la composición y elaboración de un plato de cocina y la manera en que se prepara.</p>
            </div>
        </div>
        <div class="contenedor2Recetas">
                <a class="a1Recetas" href="{{route('crudrecetas')}}">
                    <img src="{{asset('imagenes/proyecto/image21.png')}}">
                    <b>Recetas Estandarizadas</b>
                </a>
                <a class="a2Recetas" href="{{route('receta.create')}}">
                    <img src="{{asset('imagenes/proyecto/image4.png')}}">
                    <b>Sugerir Receta</b>
                </a>
                <a class="a3Recetas" href="#recetario">
                    <img src="{{asset('imagenes/proyecto/image22.png')}}">
                    <b>Ver Recetario</b>
                </a>
                <p><b>Las siguientes opciones permiten distintas funcionalidades de acuerdo a el perfil de usuario y el uso que este mismo desde, las
                    opciones son: Estandarizar, Sugerir, Ver listado (Editar, Borrar),etc... 
                en la siguiente seccion se encuentrarn las recetas que ya han sido registradas y estan estandarizadas para mostrar al usuario, 
            una vez visites cada receta tienes la opcion de calcular para cuantas personas es necesaria la receta. </b></p>
        </div>
            
        {{-- <div class="contenedorRecetario">
    <h2 class="tituloRecetario">Recetario</h2>
    <div class="recetario-columnas">
        @foreach ($recetas as $receta)
            <div class="receta">
                <a href="{{ route('receta.ingrediente', $receta->Id_Receta) }}">
                    <div class="infoReceta">
                        <h2>{{ $receta->Nombre }}</h2>
                        <p>{{ $receta->Descripcion }}</p>
                    </div>
                    <img src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}">
                </a>
            </div>
        @endforeach
    </div>
</div> --}}

{{-- contenedor de las recetas del aplicativo --}}
<div class="contenedorRecetario">
    <h2 class="tituloRecetario" id="recetario">Recetario</h2>
    <div class="recetario1">
        @foreach ($recetas as $receta)
        <div class="hover1Recetas">
            <figure>
                <a href="{{ route('receta.ingrediente', $receta->Id_Receta) }}">
                    <img src="{{ $receta->imagen }}">
                    <div class="hoverDiv1Recetas">
                        <h2>{{ $receta->Nombre }}</h2>
                        <p>Costo de la receta: <br>
                            {{ $receta->Costo_Total }}</p>
                        </div>
                    </a>
                </figure>
                <div class="hoverDiv2Recetas">
                    <h2>{{ $receta->Nombre }}</h2>
                    <p>costo de la receta: <br>
                        {{ $receta->Costo_Total }}</p>
                    </div>
                </div>
        @endforeach
        
        {{-- footer de la vista --}}
    </div>
    <footer class="footerRecetas">
        <img class="logo1SenaRecetas" src="{{asset('imagenes/proyecto/logoSena.png')}}">
        <p><b>Servicio nacional de aprendizaje <br>
            Centro de la Innovacion, agroindustria y aviacion</b></p>
        <img class="logo3Recetas" src="{{asset('imagenes/proyecto/logo.svg')}}">
    </footer>  
</div>
</body>
</html>

