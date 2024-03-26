@extends('layouts.app')
@section('content')
<div class="contenedor" >
    <div class="caja1">
        <a href="{{route('usuarios.create')}}"><input type="submit" value="Usuarios" class="botones1"></a>
        <a href="{{route('receta.create')}}"><input type="submit" value="Recetas" class="botones1"></a>
        <a href="{{route('producto.create')}}"><input type="submit" value="Productos" class="botones1"></a>
        <a href="{{route('clienteCrear')}}"><input type="submit" value="Clientes" class="botones1"></a>
        <a href="{{route('recetas.index')}}"><input type="submit" value="Recetas Index" class="botones1"></a>
        <a href="{{route('login')}}"><input type="submit" value="Iniciar sesion" class="botones1"></a>
        <a href="{{route('crudrecetas')}}"><input type="submit" value="Crud Recetas" class="botones1"></a>
        <a href="{{route('crudproductos')}}"><input type="submit" value="Crud Productos" class="botones1"></a>
        <a href="{{route('crudclientes')}}"><input type="submit" value="Crud Clientes" class="botones1"></a>
        <a href="{{route('lista.inicio')}}"><input type="submit" value="Lista Incio Jornada" class="botones1"></a>
        <a href="{{route('indexInicio')}}"><input type="submit" value="Index Inicio" class="botones1"></a>

        {{-- <a href="{{route('lista.fin')}}"><input type="submit" value="Lista Fin Jornada" class="botones1"></a> --}}
    </div>
</div>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Usuarios</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Tipo Documento</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Telefono</th>
                                <th>Rol de Usuario</th>
                                <th>Acciones Admin</th>
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
                                <td>{{ $usuario->Id_Rol }}</td>
                                <td>
                                    <form action="{{ route('usuarios.destroy', ['Id_Empleado' => $usuario->Id_Empleado])}}" method="POST">
                                        <a href="{{ route('usuarios.edit', $usuario->Id_Empleado) }}" class="btn btn-sm btn-primary">Editar Datos</a>
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
    {{ session('confirm-user') }}
    @endsection