@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="div1">
            <div class="div2">
                <div class="div3">
                    <div class="divHeader">
                        <h3 class="titulo">Lista de Clientes</h3>
                        <a href="{{ route('clientes.pdf') }}" class="btnEditar swal-pdfs">Descargar pdf</a>
                        <form class="buscador" action="{{ route('buscar.clientes') }}" method="GET">
                            <input type="text" id="buscar" name="buscar" value="{{ request('buscar') }}"
                                placeholder="Buscar">
                            <button>Buscar</button>
                        </form>
                    </div>
                    <div class="divBody">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th>Tipo Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                    <th>Acciones Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{$usuarios = tbl_usuarios::all();}} --}}
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->Id_Cliente }}</td>
                                        <td>{{ $cliente->Tipo_identificacion }}</td>
                                        <td>{{ $cliente->Nombre }}</td>
                                        <td>{{ $cliente->Apellido }}</td>
                                        <td>{{ $cliente->Telefono }}</td>
                                        <td>
                                            @if ($cliente->estado == 0)
                                                Inactivo
                                            @elseif($cliente->estado == 1)
                                                Activo
                                            @endif
                                        </td>
                                        @if (Auth::user()->Id_Rol == '1')
                                            <td class="crud-active">
                                                <a href="{{ route('cliente.edit', $cliente->Id_Cliente) }}"
                                                    class="btnEditar swal-edit">Editar</a>
                                                @if ($cliente->estado)
                                                    <a href="{{ route('cliente.inactive', $cliente->Id_Cliente) }}"
                                                        class="btnEliminar swal-confirm">Inactivar</a>
                                                @else
                                                    <a href="{{ route('cliente.active', $cliente->Id_Cliente) }}"
                                                        class="btnEliminar swal-confirm">Activar</a>
                                                @endif
                                                <a href="{{ route('cliente.pdf',['Id_Cliente' => $cliente->Id_Cliente])}}"
                                                    class="btnEditar swal-descargar">Descargar</a>
                                                
                                            </td>
                                        @else
                                        <td class="crud-active">
                                        <a href="{{ route('cliente.pdf',['Id_Cliente' => $cliente->Id_Cliente])}}"
                                                    class="btnEditar swal-descargar">Descargar</a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="tabla-mobile">
                            <div class="fila">
                                @foreach ($clientes as $cliente)
                                <div class="columna">
                                    <div class="header">Numero de documento</div>
                                    <div class="contenido"><b>{{$cliente->Id_Cliente}}</b></div>
                                </div>
                                <div class="columna">
                                    <div class="header">Tipo de Documento</div>
                                    <div class="contenido">{{$cliente->Tipo_identificacion}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Nombre</div>
                                    <div class="contenido">{{$cliente->Nombre}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Apellido</div>
                                    <div class="contenido">{{$cliente->Apellido}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Telefono</div>
                                    <div class="contenido">{{$cliente->Telefono}}</div>
                                </div>
                                <div class="columna">
                                    <div class="header">Estado</div>
                                    <div class="contenido">
                                        @if ($cliente->estado == 0)
                                        Inactivo
                                    @elseif($cliente->estado == 1)
                                        Activo
                                    @endif
                                    </div>
                                </div>
                                <div class="columna">
                                    <div class="header">Acciones</div>
                                    <div class="contenido">
                                        @if (Auth::user()->Id_Rol == '1')
                                        <a href="{{ route('cliente.edit', $cliente->Id_Cliente) }}"
                                            class="btnEditar swal-edit">Editar</a>
                                        @if ($cliente->estado)
                                            <a href="{{ route('cliente.inactive', $cliente->Id_Cliente) }}"
                                                class="btnEliminar swal-confirm">Inactivar</a>
                                        @else
                                            <a href="{{ route('cliente.active', $cliente->Id_Cliente) }}"
                                                class="btnEliminar swal-confirm">Activar</a>
                                        @endif
                                        @else
                                        <a href="{{ route('cliente.pdf',['Id_Cliente' => $cliente->Id_Cliente])}}"
                                            class="btnEditar swal-descargar">Descargar</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Links de paginación --}}
                        @if ($clientes->hasPages())
                            <ul class="pagination">
                                {{-- Botón "Primero" --}}
                                @if (!$clientes->onFirstPage())
                                    <li><a href="{{ $clientes->url(1) }}">Primero</a></li>
                                @endif

                                {{-- Botón "Anterior" --}}
                                @if ($clientes->onFirstPage())
                                    <li class="disabled"><span>Anterior</span></li>
                                @else
                                    <li><a href="{{ $clientes->previousPageUrl() }}">Anterior</a></li>
                                @endif
                                {{-- para mostrar el numero de Items --}}
                                {{ $clientes->firstItem() }}
                                de
                                {{ $clientes->total() }}
                                {{-- Páginas --}}
                                @foreach ($clientes->items() as $item)
                                    @if (is_string($item))
                                        <li class="disabled"><span>{{ $item }}</span></li>
                                    @endif
                                    @if (is_array($item))
                                        @foreach ($item as $page => $url)
                                            @if ($page == $clientes->currentPage())
                                                <li class="active"><span>{{ $page }}</span></li>
                                            @else
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                {{-- Botón "Siguiente" --}}
                                @if ($clientes->hasMorePages())
                                    <li><a href="{{ $clientes->nextPageUrl() }}">Siguiente</a></li>
                                @else
                                    <li class="disabled"><span>Siguiente</span></li>
                                @endif
                                {{-- Botón "Último" --}}
                                @if ($clientes->hasMorePages())
                                    <li><a href="{{ $clientes->url($clientes->lastPage()) }}">Último</a></li>
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
    @if (session('success'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                text: "¡el estado del cliente ha cambiado!",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });
        </script>
    @endif
@endsection
