@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/estiloCrudReceta.css')}}">
@endsection
@section('content')
<a href="{{route('recetas.pdf')}}"><input type="submit" value="descargar pdf" class="botones1"></a>
<div class="container">
    <div class="div1">
        <div class="div2">
            <div class="div3">
                <div class="divHeader">
                    <h3 class="titulo">Lista de Recetas</h3>
                    <form class="buscador">
                        <input type="text" placeholder="Buscar">
                        <button>Buscar</button>
                    </form>
                </div>
                <div class="divBody">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descipcion</th>
                                <th>Costo</th>
                                <th>Contribucion</th>
                                <th>Estado</th>
                                <th>imagen</th>
                                <th>Acciones</th>
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
                                <td>{{ $receta->Estado }}</td>
                                <td> <img style="height: 100px; width: 100px" src="{{$receta->imagen}}" alt=""> </td>
                                <td>
                                    <form action="{{ route('receta.destroy', $receta->Id_Receta) }}" method="POST" class="crud-form">
                                        <a href="{{ route('receta.edit', $receta->Id_Receta) }}" class="btnEditar">Editar</a>
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
{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Recetas</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descipcion</th>
                                <th>Costo total</th>
                                <th>Contribucion</th>
                                <th>Estado</th>
                                <th>imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recetas as $receta)
                            <tr>
                                
                                <td>{{ $receta->Nombre }}</td>
                                <td>{{ $receta->Descripcion }}</td>
                                <td>{{ $receta->Costo_Total }}</td>
                                <td>{{ $receta->Contribucion }}</td>
                                <td>{{ $receta->Estado }}</td>
                                <td> <img class="imagen-crud" src="{{$receta->imagen}}" alt=""> </td>
                                <td>
                                    <form action="{{ route('receta.destroy', $receta->Id_Receta) }}" method="POST">
                                        <a href="{{ route('receta.edit', $receta->Id_Receta) }}" class="btn btn-sm btn-primary">Editar Datos</a>
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
</div> --}}
@endsection