@extends('layouts.app')

@section('content')
<h1>Lista de recetas</h1>

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Imagen</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recetas as $receta)
        <tr>
            <td>{{ $receta->Nombre }}</td>
            <td>{{ $receta->Descripcion }}</td>
            <td><img src="{{ $receta->imagen }}" alt="{{ $receta->nombre }}" style="width: 45px; height:25px;"></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
