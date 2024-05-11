<?php
use App\Models\tbl_producto;
use App\Models\tbl_receta;

$recetas = tbl_receta::all();
$productos = tbl_producto::all();
$recetasActivas = tbl_receta::where('etapa', true)->get();
$productosActivos = tbl_producto::where('estado', 1)->get();
?>
@extends('layouts.app')
@section('content')
    @auth
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Detalle de receta</h2>
                </div>
                {{-- formulario de detalle receta resposive recetas resposive --}}
                <form action="{{ route('detalleReceta.store') }}" enctype="multipart/form-data" method="POST" id="form"
                    class="formularioRegistro">
                    @csrf
                    <div class="form1Registro">
                        <select name="Id_Receta" id="Id_Receta" value="{{ old('Id_Receta') }}">
                            <option value="" disabled selected hidden>Selecione la receta</option>
                            @foreach ($recetasActivas as $receta)
                                <option value="{{ $receta->Id_Receta }}"
                                    {{ old('Id_Receta') == $receta->Id_Receta ? 'selected' : '' }}>{{ $receta->Nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('Id_Receta')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form1Registro">
                        <select name="Cod_Producto" id="Cod_Producto" value="{{ old('Cod_Producto') }}">
                            <option value="" disabled selected hidden>Seleccione el producto que lleva esa receta</option>
                            @foreach ($productosActivos as $producto)
                                <option value="{{ $producto->Cod_Producto }}"
                                    {{ old('Cod_Producto') == $producto->Cod_Producto ? 'selected' : '' }}>
                                    {{ $producto->Nombre }}</option>
                            @endforeach
                        </select>
                        @error('Cod_Producto')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input name="Cantidad" id="Cantidad" type="text" value="{{ old('Cantidad') }}">
                        <label for="Cantidad"> Cantidad del producto</label>
                        @error('Cantidad')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form1Registro">
                        <select id="Cod_UMedida" name="Cod_UMedida" value="{{ old('Cod_UMedida') }}">
                            <option value="" disabled selected hidden>Medida del producto</option>
                            <option value="1" {{ old('Cod_UMedida') == 1 ? 'selected' : '' }}>Gramos</option>
                            <option value="2" {{ old('Cod_UMedida') == 2 ? 'selected' : '' }}>Kilos</option>
                            <option value="3" {{ old('Cod_UMedida') == 3 ? 'selected' : '' }}>Libras</option>
                            <option value="4" {{ old('Cod_UMedida') == 4 ? 'selected' : '' }}>Onzas</option>
                            <option value="5" {{ old('Cod_UMedida') == 5 ? 'selected' : '' }}>Porción</option>
                            <option value="6" {{ old('Cod_UMedida') == 6 ? 'selected' : '' }}>Unidad</option>
                            <option value="7" {{ old('Cod_UMedida') == 7 ? 'selected' : '' }}>Mililitro</option>
                        </select>
                        @error('Cod_UMedida')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="btn1Registro">
                        <input type="submit" class="enviarRegistro">
                        {{-- <a href="{{ route('receta.create') }}" class="enviarRegistro"
                        style="text-decoration: none; padding-top: 10px;"> Volver</a> --}}
                    </div>
                </form>
            </div>
        </div>
        <footer class="footerLogin">
            <img class="logo1SenaLogin" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
            <p><b>Servicio nacional de aprendizaje <br>
                    Centro de la innovación, agroindustria y aviación</b></p>
            <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
        </footer>
        @if (session('receta'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Receta resgistrada!",
                text: "{{ session('receta') }}",
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
                confirmButtonColor:  'rgba(255, 102, 0)',
            });
        </script>
    @endif
    @endauth
@endsection
