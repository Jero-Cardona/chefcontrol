<?php
use App\Models\tbl_cliente;
use Carbon\Carbon;
use App\Models\tbl_receta;

$recetas = tbl_receta::all();
$fechaActual = Carbon::now();
$clientesActivos = tbl_cliente::where('estado', true)->get();
?>
@extends('layouts.app')
@section('content')
    @auth
        <div class="contenedorFormRegistro-">
            <div class="contenedorFormRegistro1-">
                <div class="tituloRegistro-">
                    <h1>Orden de producción</h1>
                </div>
                <form class="formularioRegistro-" action="{{ route('orden.store') }}" method="POST" id="form">
                    @csrf
                    <input type="hidden" name="Fecha" value="{{ Carbon::now()->format('Y-m-d H:i:s') }}">
                    <div class="form1Registro-">
                        <select class="input" name="Id_Cliente" required>
                            <option value="" disabled selected hidden>Cliente al que se dirige la orden</option>
                            @foreach ($clientesActivos as $cliente)
                                <option value="{{ $cliente->Id_Cliente }}">{{ $cliente->Nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Usuario que registra el formulario --}}
                    <input type="hidden" name="Id_Empleado" value="{{ Auth::user()->Id_Empleado }}">
                    <div class="form1Registro-">
                        <select class="input" name="Id_Receta" required>
                            <option value="" disabled selected hidden>Seleccione la receta</option>
                            @foreach ($recetas as $receta)
                                <option value="{{ $receta->Id_Receta }}">{{ $receta->Nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="formRegistro-">
                        <input name="cantidad" id="cantidad" type="text" required>
                        <label for="cantidad"> Cantidad del producto</label>
                    </div>
                    <div class="formRegistro-">
                        <input autofocus type="hidden" name="estado" value="En espera">
                        {{-- <label for="Cantidad"> Cantidad del producto</label> --}}
                    </div>
                    <div class="btn1Registro-">
                        <input type="submit" value="Enviar" class="enviarRegistro-">
                    </div>
                </form>
                <img id="imagenlogin" src="{{ asset('imagenes/proyecto/produccion.png') }}">
            </div>
        </div>
        <footer class="footerLogin">
            <img class="logo1SenaLogin" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
            <p><b>Servicio nacional de aprendizaje <br>
                    Centro de la innovación, agroindustria y aviación</b></p>
            <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
        </footer>
    @endauth
@endsection
