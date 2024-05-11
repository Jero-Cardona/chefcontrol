@extends('layouts.app')
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
                        <a href="{{ route('recetas.pdf', ['button_id' => 3]) }}" class="btnEditar">Descargar PDF</a>
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
                                    @if (Auth::user()->Id_Rol == '1')
                                        <th>Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                {{-- registros de las recetas --}}
                                @foreach ($recetas as $receta)
                                    <tr>
                                        <td>{{ $receta->Nombre }}</td>
                                        <td>{{ $receta->Descripcion }}</td>
                                        <td>{{ $receta->Costo_Total }}</td>
                                        <td>{{ $receta->Contribucion }}</td>
                                        <td>
                                            @if ($receta->Estado == 2)
                                                En espera
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
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
