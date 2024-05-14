@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div style="padding: 20px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: white; background-color: rgba(255, 102, 0); border-color: #f5c6cb;"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="div1">
            <div class="div2">
                <div class="div3">
                    <div class="divHeader">
                        @if ($resultados->isEmpty())
                            <h3 class="titulo">No Hay Resultados para {{ $searchTerm }}</h3>
                        @else
                            <h3 class="titulo">Resultados para : {{ $searchTerm }}</h3>
                        @endif
                        {{-- <a href="{{route('producto.pdf')}}" class="btnEditar" >Descargar pdf</a> --}}
                        <form class="buscador" action="{{ route('buscar.productos') }}" method="GET">
                            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar">
                            <button>Buscar</button>
                        </form>
                    </div>
                    <div class="divBody">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Stock min</th>
                                    <th>Stock Max</th>
                                    <th>Vencimiento</th>
                                    <th>Costo</th>
                                    <th>Tipo</th>
                                    <th>Ubicacion</th>
                                    <th>Medida</th>
                                    <th>Precio</th>
                                    <th>Existencia</th>
                                    <th>Iva</th>
                                    <th>Estado</th>
                                    @if (Auth::user()->Id_Rol == '1')
                                        <th>Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                {{-- registros de los productos --}}
                                @foreach ($resultados as $producto)
                                    <tr>

                                        <td>{{ $producto->Nombre }}</td>
                                        <td><img style="height: 100px; width: 100px; border-radius: 10px;"
                                                src="{{ $producto->imagen }}" alt="imagen"></td>
                                        <td>{{ $producto->Stock_Minimo }}</td>
                                        <td>{{ $producto->Stock_Maximo }}</td>
                                        <td>{{ $producto->Fecha_Vencimiento }}</td>
                                        <td>{{ $producto->Costo }}</td>
                                        <td>{{ $producto->tipoProducto->Tipo }}</td>
                                        <td>{{ $producto->Ubicacion }}</td>
                                        <td>{{ $producto->tipoMedida->Unidad_Medida }}</td>
                                        <td>{{ $producto->Precio_Venta }}</td>
                                        <td>{{ $producto->Existencia }}</td>
                                        <td>{{ $producto->IVA }}</td>
                                        <td>
                                            @if ($producto->estado == 1)
                                                Activo
                                            @else
                                                Inactivo
                                            @endif
                                        </td>
                                        @if (Auth::user()->Id_Rol == '1')
                                            <td class="crud-form">
                                                <a href="{{ route('producto.edit', $producto->Cod_Producto) }}"
                                                    class="btnEditar swal-edit">Editar</a>
                                                @if ($producto->estado)
                                                    <a href="{{ route('producto.inactive', $producto->Cod_Producto) }}"
                                                        class="btnEliminar swal-confirm">Inactivar</a>
                                                @else
                                                    <a href="{{ route('producto.active', $producto->Cod_Producto) }}"
                                                        class="btnEliminar swal-confirm">Activar</a>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="tabla-mobile">
                            {{-- @foreach ($productos as $producto) --}}
                            <div class="fila">
                                @foreach ($resultados as $producto)
                                <div class="columna">
                                    <div class="header">Nombre</div>
                                    <div class="contenido"><b>{{$producto->Nombre}}</b></div>
                                </div>
                                <div class="columna">
                                    <div class="header">imagen</div>
                                    <div class="contenido"><img style="height: 100px; width: 100px; border-radius: 10px;"
                                    src="{{ $producto->imagen }}" alt="imagen"></div>
                                </div>
                                <div class="columna">
                                    <div class="header">Stock minimo</div>
                                    <div class="contenido">{{$producto->Stock_Minimo}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Stock maximo</div>
                                    <div class="contenido">{{$producto->Stock_Maximo}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Fecha vencimiento</div>
                                    <div class="contenido">{{$producto->Fecha_Vencimiento}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Costo</div>
                                    <div class="contenido">$COP {{$producto->Costo}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Tipo</div>
                                    <div class="contenido">{{$producto->tipoProducto->Tipo}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Ubicacion</div>
                                    <div class="contenido">{{$producto->Ubicacion}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Unidad medida</div>
                                    <div class="contenido">{{$producto->tipoMedida->Unidad_Medida}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Precio venta</div>
                                    <div class="contenido">{{$producto->Precio_Venta}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Existencia</div>
                                    <div class="contenido">{{$producto->Existencia}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Iva</div>
                                    <div class="contenido">{{$producto->IVA}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Estado</div>
                                    <div class="contenido">
                                        @if ($producto->estado == 1)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                    </div>
                                </div>
                                <div class="columna">
                                    <div class="header">Acciones</div>
                                    <div class="contenido">
                                        <a href="{{ route('producto.edit', $producto->Cod_Producto) }}"
                                            class="btnEditar swal-edit">Editar</a>
                                        @if ($producto->estado)
                                            <a href="{{ route('producto.inactive', $producto->Cod_Producto) }}"
                                                class="btnEliminar swal-confirm">Inactivar</a>
                                        @else
                                            <a href="{{ route('producto.active', $producto->Cod_Producto) }}"
                                                class="btnEliminar swal-confirm">Activar</a>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            {{-- @endforeach --}}
                        </div>
                        {{-- Links de paginación --}}
                        @if ($resultados->hasPages())
                            <ul class="pagination">
                                {{-- Botón "Primero" --}}
                                @if (!$resultados->onFirstPage())
                                    <li><a href="{{ $resultados->url(1) }}">Primero</a></li>
                                @endif

                                {{-- Botón "Anterior" --}}
                                @if ($resultados->onFirstPage())
                                    <li class="disabled"><span>Anterior</span></li>
                                @else
                                    <li><a href="{{ $resultados->previousPageUrl() }}">Anterior</a></li>
                                @endif
                                {{-- para mostrar el numero de Items --}}
                                {{ $resultados->firstItem() }}
                                de
                                {{ $resultados->total() }}
                                {{-- Páginas --}}
                                @foreach ($resultados->items() as $item)
                                    @if (is_string($item))
                                        <li class="disabled"><span>{{ $item }}</span></li>
                                    @endif
                                    @if (is_array($item))
                                        @foreach ($item as $page => $url)
                                            @if ($page == $resultados->currentPage())
                                                <li class="active"><span>{{ $page }}</span></li>
                                            @else
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                {{-- Botón "Siguiente" --}}
                                @if ($resultados->hasMorePages())
                                    <li><a href="{{ $resultados->nextPageUrl() }}">Siguiente</a></li>
                                @else
                                    <li class="disabled"><span>Siguiente</span></li>
                                @endif

                                {{-- Botón "Último" --}}
                                @if ($resultados->hasMorePages())
                                    <li><a href="{{ $resultados->url($resultados->lastPage()) }}">Último</a></li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footerLogin">
        <img class="logo1SenaLogin" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
        <p><b>Servicio nacional de aprendizaje <br>
                Centro de la Innovacion, agroindustria y aviacion</b></p>
        <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
    </footer>
@endsection
