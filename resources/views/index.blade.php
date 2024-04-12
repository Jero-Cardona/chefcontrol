@extends('layouts.app')
@section('style')
     <link rel="stylesheet" href="{{asset('/css/estilosCruds.css')}}">
     @endsection
     @section('content')
<div class="contenedor" >

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    {{-- @auth
    <div class="caja1">
        <a href=""><input type="submit" value="Nuevo Usuario" class="botones1"></a>
        <a href=""><input type="submit" value="Nueva Receta" class="botones1"></a>
        <a href=""><input type="submit" value="Nuevo Producto" class="botones1"></a>
        <a href=""><input type="submit" value=" Nuevo Cliente" class="botones1"></a>
        <a href="{{route('receta.recetario')}}"><input type="submit" value="Recetario" class="botones1"></a>
        <a href="{{route('login')}}"><input type="submit" value="Iniciar sesion" class="botones1"></a>
        <a href=""><input type="submit" value="Lista Recetas" class="botones1"></a>
        <a href=""><input type="submit" value="Lista Productos" class="botones1"></a>
        <a href=""><input type="submit" value="Lista Clientes" class="botones1"></a>
        <a href=""><input type="submit" value="Lista Incio Jornada" class="botones1"></a>
        <a href=""><input type="submit" value="Lista Fin Jornada" class="botones1"></a>
        <a href=""><input type="submit" value="Crear Orden Producción" class="botones1"></a>
        <a href="{{route('orden.index')}}"><input type="submit" value="Ordenes de Producción" class="botones1"></a>
        <a href=""><input type="submit" value="Ordenes en Espera" class="botones1"></a>
        <a href=""><input type="submit" value="Ordenes en Preparación" class="botones1"></a>
        <a href=""><input type="submit" value="Ordenes Entregadas" class="botones1"></a>
        <a href=""><input type="submit" value="Agregar Detalle a una receta" class="botones1"></a>
        <a href=""><input type="submit" value="Listas de inicio registradas" class="botones1"></a>
        <a href=""><input type="submit" value="Listas de fin registradas" class="botones1"></a>
        
        @endauth
        <a href="{{route('login')}}"><input type="submit" value="Iniciar sesion" class="botones1"></a>
        <a href="{{route('usuarios.create')}}"><input type="submit" value="Usuarios" class="botones1"></a> --}}
    </div>
</div>
<br><br>
@auth
    
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
                    <a href="{{route('usuarios.pdf')}}">Descargar pdf<button value="Descargar pdf"></button></a>
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
                                <td>{{ $usuario->tipoRol->Rol }}</td>
                                <td>
                                    <form action="{{ route('usuarios.destroy', ['Id_Empleado' => $usuario->Id_Empleado])}}" method="POST">
                                        <a href="{{ route('usuarios.edit', $usuario->Id_Empleado) }}" class="btnEditar">Editar</a>
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
@endauth
    {{ session('confirm-user') }}
    @endsection

    