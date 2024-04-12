<?php
use App\Models\tbl_cliente;
use Carbon\Carbon;
use App\Models\tbl_receta;

$recetas = tbl_receta::all();
$fechaActual = Carbon::now();
$clientes = tbl_cliente::all(); 
?>

@extends('layouts.app')
    @section('style')
       <link rel="stylesheet" href="{{ asset('/css/estilosProducto.css')}}">

        @endsection
@section('content')
@auth
<div class="contenedorFormRegistro">
    <div class="contenedorFormRegistro1">
        <div class="tituloRegistro">
            <h1>Orden de producción</h1>
        </div>
    <form id="formularioLogin" action="{{route('orden.store')}}" method="POST" class="formularioRegistro">
        @csrf
            <input type="hidden" name="Fecha" value="{{ Carbon::now()->format('Y-m-d H:i:s') }}">

            <div class="form1Registro">
                <select class="input" name="Id_Cliente" required>
                <option value="" disabled selected hidden>Cliente al que se dirige la orden</option>
                    @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->Id_Cliente }}">{{ $cliente->Nombre }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="Id_Empleado" value="{{Auth::user()->Id_Empleado}}">

            <div class="form1Registro">
                <select class="input" name="Id_Receta" required>
                <option value="" disabled selected hidden>Seleccione la receta</option>
                    @foreach ($recetas as $receta)
                    <option value="{{ $receta->Id_Receta }}">{{$receta->Nombre}}</option>
                    @endforeach
                </select>
            </div>

             <div class="formRegistro">
               <input name="Cantidad" id="Cantidad" type="text"  required>
                <label for="Cantidad"> Cantidad del producto</label>
            </div>
                <div class="formRegistro">
                <input autofocus type="hidden" name="estado" value="En espera" >
                 {{-- <label for="Cantidad"> Cantidad del producto</label> --}}
               
                
            </div>

             <div class="btn1Registro">
                <input type="submit" value="Enviar" class="enviarRegistro">
                <a href="{{route('receta.create')}}" class="enviarRegistro" style="text-decoration: none"> Volver</a>
            </div>
    </form>
    </div>
</div>
@endauth
@endsection