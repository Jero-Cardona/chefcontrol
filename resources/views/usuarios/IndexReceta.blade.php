<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/estilosReceta.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('imagenes/proyecto/logo.svg') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Chef Control | Recetario</title>
</head>

<body>
    <div class="contenedorRecetas">
        <header class="headerRecetas">
            <div class="contenedorHR">
                <div>
                    <img class="logo1Recetas" src="{{ asset('imagenes/proyecto/logo.svg') }}">
                </div>
                <div class="usuarioRecetas">

                    <h2>{{ Auth::user()->Nombre }}</h2>
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
                            <a href="{{ route('crud.listainicio') }}">Listas Inicio de jornada registradas</a>
                            <a href="{{ route('crud.listafin') }}">Listas Fin de jornada registradas</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Orden de producción</a>
                        <div class="submenu">
                            <a href="{{ route('orden.produccion') }}">Nueva orden</a>
                            <a href="{{ route('ordenes.espera') }}">Órdenes en espera</a>
                            <a href="{{ route('ordenes.preparacion') }}">Órdenes en preparación</a>
                            <a href="{{ route('ordenes.entregadas') }}">Órdenes entregadas</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#">Clientes</a>
                        <div class="submenu">
                            @if (Auth::user()->Id_Rol == '1')
                                <a href="{{ route('clienteCrear') }}">Registar cliente</a>
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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="contenedor1Recetas">
            <img class="fondo1Recetas" src="{{ asset('imagenes/proyecto/image33.png') }}">
            <div class="caja1Recetas">
                <img class="logo2Recetas" src="{{ asset('imagenes/proyecto/logo.svg') }}">
                <h2 class="textRecetas1">Bienvenidos a nuestro sitio web</h2>
                <p class="textRecetas2">El recetario es una recopilación que reúne diversas recetas culinarias. 
                    Cada receta se distingue por detallar los ingredientes necesarios y el procedimiento para preparar un plato específico.</p>
            </div>
        </div>
        <div class="contenedor2Recetas">
            <a class="a1Recetas" href="{{ route('crudrecetas') }}">
                <img src="{{ asset('imagenes/proyecto/image21.png') }}">
                <b>Recetas estandarizadas</b>
            </a>
            <a class="a2Recetas" href="{{ route('receta.create') }}">
                <img src="{{ asset('imagenes/proyecto/image4.png') }}">
                @if (Auth::user()->Id_Rol == '1')
                    <b>Estandarizar una receta</b>
                @else
                    <b>Sugerir receta</b>
                @endif
            </a>
            <a class="a3Recetas" href="#recetario">
                <img src="{{ asset('imagenes/proyecto/image22.png') }}">
                <b>Ver recetario</b>
            </a>
            <p><b>Las siguientes opciones ofrecen diversas funcionalidades según el perfil de usuario y su propósito de uso. 
                Entre las opciones se incluyen: estandarizar, sugerir, visualizar el listado (con opciones para editar y desactivar), entre otras. 
                En la sección siguiente se presentan las recetas que ya han sido registradas y estandarizadas para su visualización por parte del administrador. 
                Una vez que se visita cada receta, se ofrece la opción de calcular la cantidad necesaria de ingredientes para la cantidad deseada de personas. </b></p>
        </div>
        {{-- contenedor de las recetas del aplicativo --}}
        <div class="contenedorRecetario">
            <h2 class="tituloRecetario" id="recetario">Recetario</h2>
            <div class="recetario1">
                @foreach ($recetasActivas as $receta)
                    <div class="hover1Recetas">
                        <figure>
                            <a class="" href="{{ route('receta.ingrediente', $receta->Id_Receta) }}">
                                <img src="{{ $receta->imagen }}">
                                <div class="hoverDiv1Recetas">
                                    <h2>{{ $receta->Nombre }}</h2>
                                    <p>Costo de la receta: <br>
                                    $COP {{ number_format($receta['Costo_Total'], 0, '.', ',') }}</p>
                                </div>
                            </a>
                        </figure>
                        <div class="hoverDiv2Recetas">
                            <h2>{{ $receta->Nombre }}</h2><br>
                            <p>Costo de la receta: <br>
                            $cop {{ number_format($receta['Costo_Total'], 0, '.', ',') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="paginas">
                {{-- agregar paginacion al Recetario --}}
                {{-- Links de paginación --}}
                @if ($recetasActivas->hasPages())
                    <ul class="pagination">
                        {{-- Botón "Primero" --}}
                        @if (!$recetasActivas->onFirstPage())
                            <li><a href="{{ $recetasActivas->url(1) }}">Primero</a></li>
                        @endif

                        {{-- Botón "Anterior" --}}
                        @if ($recetasActivas->onFirstPage())
                            <li class="disabled"><span>Anterior</span></li>
                        @else
                            <li><a href="{{ $recetasActivas->previousPageUrl() }}">Anterior</a></li>
                        @endif
                        {{-- para mostrar el numero de Items --}}
                        {{ $recetasActivas->firstItem() }}
                        de
                        {{ $recetasActivas->total() }}
                        {{-- Páginas --}}
                        @foreach ($recetasActivas->items() as $item)
                            @if (is_string($item))
                                <li class="disabled"><span>{{ $item }}</span></li>
                            @endif
                            @if (is_array($item))
                                @foreach ($item as $page => $url)
                                    @if ($page == $recetasActivas->currentPage())
                                        <li class="active"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        {{-- Botón "Siguiente" --}}
                        @if ($recetasActivas->hasMorePages())
                            <li><a href="{{ $recetasActivas->nextPageUrl() }}">Siguiente</a></li>
                        @else
                            <li class="disabled"><span>Siguiente</span></li>
                        @endif
                        {{-- Botón "Último" --}}
                        @if ($recetasActivas->hasMorePages())
                            <li><a href="{{ $recetasActivas->url($recetasActivas->lastPage()) }}">Último</a></li>
                        @endif
                    </ul>
                @endif
            </div>
            {{-- footer de la vista --}}
            <footer class="footerRecetas">
                <img class="logo1SenaRecetas" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
                <p><b>Servicio nacional de aprendizaje <br>
                        Centro de la innovación, agroindustria y aviación</b></p>
                <img class="logo3Recetas" src="{{ asset('imagenes/proyecto/logo.svg') }}">
            </footer>
        </div>
        {{-- modal para calcular la cantidad de Recetas --}}
        <section class="modal">
            <div class="modal__container">
                <img src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}" class="modal__img">
                <h2 class="modal__title">{{ $receta->Nombre }}</h2>
                <p class="modal__parrafo">{{ $receta->Descripcion }}</p>
                <a href="#" class="cerrarModal">Cerrar</a>
                <h3 class="modal__title">Ingredientes de la receta</h3>
                <ul>
                    @foreach ($receta->detallesReceta as $detalle)
                        <li>
                            {{ $detalle->producto->Nombre }} - {{ $detalle->Cantidad }}
                            {{ $detalle->unidadMedida->Unidad_Medida }}
                        </li>
                    @endforeach
                </ul>
                <form id="frmcantidad" method="POST"
                    action="{{ route('recetas.cantidadmultiplicada', $receta->Id_Receta) }}">
                    @csrf
                    <div>
                        <label for="cantidad">Cantidad de la receta:</label>
                        <input type="number" name="cantidad" min="1" required>
                    </div>
                    <button type="submit">Calcular</button>
                </form>
                @if (isset($cantidadesAjustadas))
                    <h2 class="nombre-ingredientes">Cantidades ajustadas para
                        {{ number_format($cantidad, 0, '.', ',') }} porciones:</h2>
                    <ul>
                        @foreach ($cantidadesAjustadas as $detalle)
                            <li>
                                {{ $detalle['producto']->Nombre }} -
                                {{ number_format($detalle['cantidadAjustada'], 0, '.', ',') }}
                                {{ $detalle['unidadMedida']->Unidad_Medida }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <a href="#" class="cerrarModal">Cerrar</a>
            </div>
        </section>
        <script src="{{ asset('js/SweetAlerts.js') }}"></script>
        @if (session('inicio'))
            <script>
                Swal.fire({
                    text: "Es un gusto tenerte de nuevo en nuestro aplicativo web",
                    position: "center",
                    title: "¡Bienvenido de nuevo {{ Auth::user()->Nombre }}!",
                    // imageUrl: "{{ asset('imagenes/proyecto/image33.png') }}",
                    // imageWidth: 400,
                    // imageHeight: 200,
                    // imageAlt: "Custom image",
                    showConfirmButton: false,
                    confirmButtonColor: 'rgba(255, 102, 0)',
                    timer: 4000,
                    timerProgressBar: true,
                });
            </script>
        @endif
</body>

</html>
