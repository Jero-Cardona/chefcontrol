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
                        @if ($resultados->isEmpty())
                            <script>
                                Swal.fire({
                                    position: "center",
                                    icon: "warning",
                                    title: "No se encontro ningun registro",
                                    showConfirmButton: false,
                                    timer: 5000
                                });
                            </script>
                            <h3 class="titulo">No se encontro : <b>{{ $searchTerm }}</b></h3>
                        @else
                            <h3 class="titulo">Resultados para la busqueda de <b>{{ $searchTerm }}</b></h3>
                        @endif
                        {{-- <a href="{{route('clientes.pdf')}}" class="btnEditar" >Descargar pdf</a> --}}
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
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    @if (Auth::user()->Id_Rol == '1')
                                        <th>Acciones Admin</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{$usuarios = tbl_usuarios::all();}} --}}
                                @foreach ($resultados as $cliente)
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
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
