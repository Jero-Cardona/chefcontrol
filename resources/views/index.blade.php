@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/estilosCruds.css') }}">
@endsection
@section('content')
    <div class="contenedor">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <br><br>
    @auth
        <div class="container">
            <div class="div1">
                <div class="div2">
                    <div class="div3">
                        <div class="divHeader">
                            <h3 class="titulo">Lista de Usuarios</h3>
                            <a href="{{ route('usuarios.pdf') }}" class="btnEditar">Descargar pdf</a>
                            <form class="buscador" action="{{ route('buscar.usuarios') }}" method="GET">
                                <input type="text" name="buscar" id="buscar" value="{{ request('buscar') }}"
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
                                        <th>Telefono</th>
                                        <th>Rol de Usuario</th>
                                        <th>Estado</th>
                                        @if (Auth::user()->Id_Rol == '1')
                                            <th>Acciones Admin</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{$usuarios = tbl_usuarios::all();}} --}}
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->Id_Empleado }}</td>
                                            <td>{{ $usuario->tipo_documento }}</td>
                                            <td>{{ $usuario->Nombre }}</td>
                                            <td>{{ $usuario->Apellido }}</td>
                                            <td>{{ $usuario->Telefono }}</td>
                                            <td>{{ $usuario->tipoRol->Rol }}</td>
                                            <td>
                                                @if ($usuario->estado == 1)
                                                    Activo
                                                @else
                                                    Inactivo
                                                @endif
                                            </td>
                                            @if (Auth::user()->Id_Rol == '1')
                                                <td class="crud-active">
                                                    <a href="{{ route('usuarios.edit', $usuario->Id_Empleado) }}"
                                                        class="btnEditar swal-edit">Editar</a>
                                                    @if ($usuario->estado)
                                                        <a href="{{ route('usuario.inactive', $usuario->Id_Empleado) }}"
                                                            class="btnEliminar swal-confirm">Inactivar</a>
                                                    @else
                                                        <a href="{{ route('usuario.active', $usuario->Id_Empleado) }}"
                                                            class="btnEliminar swal-confirm">Activar</a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Links de paginación --}}
                            @if ($usuarios->hasPages())
                                <ul class="pagination">
                                    {{-- Botón "Primero" --}}
                                    @if (!$usuarios->onFirstPage())
                                        <li><a href="{{ $usuarios->url(1) }}">Primero</a></li>
                                    @endif
                                    {{-- Botón "Anterior" --}}
                                    @if ($usuarios->onFirstPage())
                                        <li class="disabled"><span>Anterior</span></li>
                                    @else
                                        <li><a href="{{ $usuarios->previousPageUrl() }}">Anterior</a></li>
                                    @endif
                                    {{-- para mostrar el numero de Items --}}
                                    {{ $usuarios->firstItem() }}
                                    de
                                    {{ $usuarios->total() }}
                                    {{-- Páginas --}}
                                    @foreach ($usuarios->items() as $item)
                                        @if (is_string($item))
                                            <li class="disabled"><span>{{ $item }}</span></li>
                                        @endif
                                        @if (is_array($item))
                                            @foreach ($item as $page => $url)
                                                @if ($page == $usuarios->currentPage())
                                                    <li class="active"><span>{{ $page }}</span></li>
                                                @else
                                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    {{-- Botón "Siguiente" --}}
                                    @if ($usuarios->hasMorePages())
                                        <li><a href="{{ $usuarios->nextPageUrl() }}">Siguiente</a></li>
                                    @else
                                        <li class="disabled"><span>Siguiente</span></li>
                                    @endif
                                    {{-- Botón "Último" --}}
                                    @if ($usuarios->hasMorePages())
                                        <li><a href="{{ $usuarios->url($usuarios->lastPage()) }}">Último</a></li>
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
    @endauth
    {{ session('confirm-user') }}
@endsection
