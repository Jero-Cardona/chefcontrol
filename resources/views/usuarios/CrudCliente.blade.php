@extends('layouts.app')
@section('content')
<div class="container">
    @if (session('success'))
    <div style="padding: 10px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: white; background-color: rgba(255, 102, 0); border-color: #f5c6cb;" role="alert">
    
        {{ session('success') }}
    </div>
    @endif
    <div class="div1">
        <div class="div2">
            <div class="div3">
                <div class="divHeader">
                    <h3 class="titulo">Lista de Clientes</h3>
                    <a href="{{route('clientes.pdf')}}" class="btnEditar" >Descargar pdf</a>
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
                                <a href="{{ route('cliente.edit', $cliente->Id_Cliente) }}" class="btnEditar">Editar</a>
                                @if($cliente->estado)
                                <a href="{{ route('cliente.inactive', $cliente->Id_Cliente) }}" class="btnEliminar">Inactivar</a>
                                @else
                                <a href="{{ route('cliente.active', $cliente->Id_Cliente) }}" class="btnEliminar">Activar</a>
                                @endif   
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