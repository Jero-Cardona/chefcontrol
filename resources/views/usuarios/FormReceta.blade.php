
@extends('layouts.app')
@section('style')
{{-- en esta seccion irian los estilos necesarios para el archivo --}}
<link rel="stylesheet" href="{{ asset('/css/estilosProducto.css')}}">
@endsection
@section('content')
@auth
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif    

<body>
    <div class="contenedorFormRegistro">
        <div class="contenedorFormRegistro1">
            <div class="tituloRegistro">
                <h2>Nueva Receta</h2>
            </div>
                {{-- formulario de recetas resposive --}}
                <form action="{{route('receta.store')}}" enctype="multipart/form-data" method="POST" class="formularioRegistro">
                @csrf
                <div class="formRegistro">
                    <input id="Nombre" name="Nombre" type="text" required>
                    <label for="Nombre"> Nombre Receta</label>
                </div>
                <div class="formRegistro">
                    <input name="Descripcion" id="Descripcion" type="text" required>
                    <label for="Descripcion"> Descripcion Receta</label>
                </div>
                <div class="formRegistro">
                    <input id="Costo_Total" name="Costo_Total" type="text" required>
                    <label for="Costo_Total"> Costo Total de la Receta</label>
                </div>
                <div class="formRegistro">
                    <input id="Contribucion" name="Contribucion" type="number" required>
                    <label for="Contribucion">Contribucion</label>
                </div>
                <div class="form1Registro">
                    <select id="Estado" name="Estado" required>
                        <option value="" disabled selected hidden>Estado de la Receta</option>
                        <option value="1">Estandarizada</option>
                        <option value="2">En Espera</option>
                    </select>
                </div>
                <div class="formRegistro">
                    <input id="imagen" name="imagen" type="file" required>
                    <label for="imagen"></label>
                </div>
                <div class="btn1Registro">
                    <input type="submit" class="enviarRegistro">
                </div>
            </form>
        </div>
    </div>
    @endauth
@endsection