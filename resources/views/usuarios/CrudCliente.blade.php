@extends('layouts.app')
@section('content')
<a href="{{route('clientes.pdf')}}"><input type="submit" value="descargar clientes pdf" class="botones1"></a>
<div class="container">
    <div class="div1">
        <div class="div2">
            <div class="div3">
                <div class="divHeader">
                    <h3 class="titulo">Lista de Usuarios</h3>
                    <form class="buscador">
                        <input type="text" placeholder="Buscar">
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
                                <td>{{ $cliente->Estado }}</td>
                                <td>
                                    <form action="{{ route('cliente.destroy', ['Id_Cliente' => $cliente->Id_Cliente]) }}" method="POST">
                                        <a href="{{ route('cliente.edit', $cliente->Id_Cliente) }}" class="btnEditar">Editar</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btnEliminar" onclick="return confirm('¿Estás seguro de querer eliminar estos datos?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection