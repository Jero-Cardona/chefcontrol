<?php
use Carbon\Carbon;
$fechaActual = Carbon::now();
?>
@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/estilosListasChequeo.css')}}">
@endsection
@section('content')
@auth
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<body class="contenedorPrincipalLista">
    <div class="contenedorTotalLista">
        <div class="menu-lista">
            <button class="botonesMenuLista" href="">Recetas</button><br>
            <button class="botonesMenuLista" href="">Sugerencias</button><br>
            <button class="botonesMenuLista" href="">Autorización</button><br>
            <button class="botonesMenuLista" href="">Formatos</button><br>
            <button class="botonesMenuLista" href="">Asignación</button><br>
            <button class="botonesMenuLista" href="">Configuración</button>
        </div>
        <div class="formularioLista">    
            <div class="divLista">
                <h2 class="tittleLista">Lista fin jornada</h2>
            </div>
            <div class="contentLista">
                <form id="form-verificacion" action="{{ route('listafin.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="Id_Empleado" value="{{Auth::user()->Id_Empleado}}">
                    <label class="tittle-items">Selecciona los elementos:</label><br><br>
                    <label class="items-tareas">
                        @foreach ($formato as $tarea)
                        <input class="cuadro" type="checkbox" name="id_tarea[]" value="{{$tarea['id']}}">{{$tarea['nombre']}}<br>
                        @endforeach
                        <input class="cuadro" type="hidden" name="fecha" value="{{Carbon::now()->format('Y-m-d H:i:s')}}">
                    </label>
                    <input class="btn-submit" type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </div>

    <footer class="footerLogin">
        <img class="logo1SenaLogin" src="{{asset('imagenes/proyecto/logoSena.png')}}">
        <p><b>Servicio nacional de aprendizaje <br>
            Centro de la Innovación, agroindustria y aviación</b></p>
        <img class="logo3Login" src="{{asset('imagenes/proyecto/logo.svg')}}">
    </footer>
</body>
@endauth
@endsection