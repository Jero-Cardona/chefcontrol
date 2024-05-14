@extends('layouts.app')
@section('title','ChefControl | Recetas en espera')
@section('content')
    <div class="container">
        @if (session('success'))
            <div style="padding: 10px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: white; background-color: rgba(255, 102, 0); border-color: #f5c6cb;"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="div1">
            <div class="div2">
                <div class="div3">
                    <div class="divHeader">
                        <h3 class="titulo">Lista de recetas en espera</h3>
                        <a href="{{ route('recetas.pdf', ['button_id' => 3]) }}" class="btnEditar swal-pdfs"><b>Descargar PDF</b></a>
                        <form class="buscador" action="{{ route('buscar.recetas', ['buscar' => 3]) }}" method="GET">
                            @csrf
                            <input type="text" placeholder="Buscar" name="buscar" value="{{ request('buscar') }}">
                            <button>Buscar</button>
                        </form>
                    </div>
                    <div class="divBody">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Costo</th>
                                    <th>Aporte</th>
                                    <th>Estado</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- registros de las recetas --}}
                                @foreach ($recetas as $receta)
                                    <tr>
                                        <td>{{ $receta->Nombre }}</td>
                                        <td class="descripcion">{{ $receta->Descripcion }}</td>
                                        <td>$COP {{ number_format($receta['Costo_Total'], 0, '.', ',') }}</td>
                                        <td>{{ $receta->Contribucion }}</td>
                                        <td>
                                            @if ($receta->Estado == 2)
                                                En espera
                                            @else
                                            Estandarizada
                                            @endif
                                        </td>

                                        <td> <img style="height: 100px; width: 100px" src="{{ $receta->imagen }}"
                                                alt=""> </td>
                                        @if (Auth::user()->Id_Rol == '1')
                                            <td class="crud-form">
                                                <a href="{{ route('receta.edit', $receta->Id_Receta) }}"
                                                    class="btnEditar swal-edit">Editar</a>
                                                @if ($receta->etapa)
                                                    {{-- <a href="{{ route('receta.inactive', $receta->Id_Receta) }}" class="btnEliminar swal-confirm">Eliminar</a> --}}
                                                    <a href="{{ route('receta.estandarizar', $receta->Id_Receta) }}"
                                                        class="btnEliminar swal-confirm">Estandarizar</a>
                                                @endif
                                                <a href="{{ route('receta.pdf', ['Id_Receta' => $receta->Id_Receta, 'button' => 2]) }}"
                                                    class="btnEditar swal-edit">Descargar</a>
                                                </td>
                                                @else
                                                <td class="crud-form">

                                                    <a href="{{ route('receta.pdf', ['Id_Receta' => $receta->Id_Receta, 'button' => 2]) }}"
                                                    class="btnEditar swal-edit">Descargar</a>
                                                </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="tabla-mobile">
                            <div class="fila">
                                @foreach ($recetas as $receta)
                                <div class="columna">
                                    <div class="header">Nombre</div>
                                    <div class="contenido"><b>{{$receta->Nombre}}</b></div>
                                </div>
                                <div class="columna">
                                    <div class="header">imagen</div>
                                    <div class="contenido"><img style="height: 150px; width: 200px; border-radius: 10px;"
                                    src="{{ $receta->imagen }}" alt="imagen"></div>
                                </div>
                                <div class="columna">
                                    <div class="header">Descripcion</div>
                                    <div class="contenido">{{$receta->Descripcion}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Costo receta</div>
                                    <div class="contenido">$COP {{ number_format($receta['Costo_Total'], 0, '.', ',')}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Aporte</div>
                                    <div class="contenido">{{$receta->Contribucion}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Estado</div>
                                    <div class="contenido">
                                        @if ($receta->Estado == 1)
                                        Estandarizada
                                    @elseif($receta->Estado == 2)
                                        En espera
                                    @endif
                                    </div>
                                </div>
                                <div class="columna">
                                    <div class="header">Estado</div>
                                    <div class="contenido">
                                        @if ($receta->etapa == true)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                    </div>
                                </div>
                                <div class="columna">
                                    <div class="header">Acciones</div>
                                    <div class="contenido">
                                        @if (Auth::user()->Id_Rol == '1')
                                        <a href="{{ route('receta.edit', $receta->Id_Receta) }}"
                                            class="btnEditar swal-edit">Editar</a>
                                        @if ($receta->etapa)
                                            <a href="{{ route('receta.inactive', $receta->Id_Receta) }}"
                                                class="btnEliminar swal-confirm">Desactivar</a>
                                        @else
                                            <a href="{{ route('receta.active', $receta->Id_Receta) }}"
                                                class="btnEliminar swal-confirm">Activar</a>
                                        @endif
                                        @else
                                        <a href="{{ route('receta.pdf', ['Id_Receta' => $receta->Id_Receta, 'button' => 2]) }}"
                                        class="btnEditar swal-edit">Descargar</a>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            {{-- @endforeach --}}
                        </div>
                        {{-- Links de paginación --}}
                        @if ($recetas->hasPages())
                            <ul class="pagination">
                                {{-- Botón "Primero" --}}
                                @if (!$recetas->onFirstPage())
                                    <li><a href="{{ $recetas->url(1) }}">Primero</a></li>
                                @endif
                                {{-- Botón "Anterior" --}}
                                @if ($recetas->onFirstPage())
                                    <li class="disabled"><span>Anterior</span></li>
                                @else
                                    <li><a href="{{ $recetas->previousPageUrl() }}">Anterior</a></li>
                                @endif
                                {{-- para mostrar el numero de Items --}}
                                {{ $recetas->firstItem() }}
                                de
                                {{ $recetas->total() }}
                                {{-- Páginas --}}
                                @foreach ($recetas->items() as $item)
                                    @if (is_string($item))
                                        <li class="disabled"><span>{{ $item }}</span></li>
                                    @endif
                                    @if (is_array($item))
                                        @foreach ($item as $page => $url)
                                            @if ($page == $recetas->currentPage())
                                                <li class="active"><span>{{ $page }}</span></li>
                                            @else
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                {{-- Botón "Siguiente" --}}
                                @if ($recetas->hasMorePages())
                                    <li><a href="{{ $recetas->nextPageUrl() }}">Siguiente</a></li>
                                @else
                                    <li class="disabled"><span>Siguiente</span></li>
                                @endif
                                {{-- Botón "Último" --}}
                                @if ($recetas->hasMorePages())
                                    <li><a href="{{ $recetas->url($recetas->lastPage()) }}">Último</a></li>
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
                Centro de la innovación, agroindustria y aviación</b></p>
        <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
    </footer>
@endsection
