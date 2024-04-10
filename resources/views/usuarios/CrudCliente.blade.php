@extends('layouts.app')
@section('content')
<a href="{{route('clientes.pdf')}}"><input type="submit" value="descargar clientes pdf" class="botones1"></a>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Clientes</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Tipo de Documento</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
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
                                <td>{{ $cliente->estado }}</td>
                                <td>
                                    <form action="{{ route('cliente.destroy', $cliente->Id_Cliente) }}" method="POST">
                                        <a href="{{ route('cliente.edit', $cliente->Id_Cliente) }}" class="btn btn-sm btn-primary">Editar Datos</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar estos datos?')">Eliminar</button>
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