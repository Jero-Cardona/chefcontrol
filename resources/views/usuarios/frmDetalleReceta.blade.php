<?php
use App\Models\tbl_producto;
use App\Models\tbl_receta;

$recetas = tbl_receta::all();
$productos = tbl_producto::all(); 
?>
@extends('layouts.app')
@section('style')

<link rel="stylesheet" href="{{ asset('/css/estilosProducto.css')}}">
@endsection
@section('content')
@auth
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="contenedorFormRegistro">
    <div class="contenedorFormRegistro1">
        <div class="tituloRegistro">
            <h2>Detalle de Receta</h2>
        </div>
        {{-- formulario de detalle receta resposive recetas resposive --}}
        <form action="{{route('detalleReceta.store')}}" enctype="multipart/form-data" method="POST" class="formularioRegistro">
            @csrf
            <div class="form1Registro">
                <select name="Id_Receta" id="Id_Receta">
                    <option value="" disabled selected hidden>Selecione la receta</option>
                    @foreach ($recetas as $receta)
                        <option value="{{ $receta->Id_Receta }}">{{$receta->Nombre}}</option>
                    @endforeach
                </select>
                
            </div>
            <div class="form1Registro">
                <select name="Cod_Producto" id="Cod_Producto">
                    <option value="" disabled selected hidden>Selecione el producto que lleva esa receta</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->Cod_Producto }}">{{$producto->Nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="formRegistro">
                <input name="Cantidad" id="Cantidad" type="text" required>
                <label for="Cantidad"> Cantidad del producto</label>
            </div>
            <div class="form1Registro">
                <select id="Cod_UMedida" name="Cod_UMedida" required>
                    <option value="" disabled selected hidden>Medida del producto</option>
                    <option value="1">Gramos</option>
                    <option value="2">Kilos</option>
                    <option value="3">Libras</option>
                    <option value="4">Onzas</option>
                    <option value="5">Porcion</option>
                    <option value="6">Unidad</option>
                    <option value="7">Mililitro</option>
                </select>
            </div>
            <div class="btn1Registro">
                <input type="submit" value="Enviar Detalle" class="enviarRegistro">
                <a href="{{route('receta.create')}}" class="enviarRegistro" style="text-decoration: none"> Volver</a>
            </div>
        </form>
    </div>
</div>
@endauth
@endsection