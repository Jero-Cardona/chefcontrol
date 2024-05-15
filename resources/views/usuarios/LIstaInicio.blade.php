<?php
use Carbon\Carbon;
$fechaActual = Carbon::now();
?>
@extends('layouts.app')
@section('title','ChefControl | Lista inicio')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/estilosListasChequeo.css') }}">
@endsection
@section('content')
    @auth
        <body class="contenedorPrincipalLista">
            <div class="contenedorTotalLista">
                <div class="menu-lista">
                    <!-- <button class="botonesMenuLista" href="">Recetas</button><br>
                    <button class="botonesMenuLista" href="">Sugerencias</button><br>
                    <button class="botonesMenuLista" href="">Autorización</button><br>
                    <button class="botonesMenuLista" href="">Formatos</button><br>
                    <button class="botonesMenuLista" href="">Asignación</button><br>
                    <button class="botonesMenuLista" href="">Configuración</button> -->
                </div>
                <div class="formularioLista">
                    <div class="divLista">
                        <h2 class="tittleLista">Lista Inicio de jornada</h2>
                    </div>
                    <div class="contentLista">
                        <form id="form-verificacion" action="{{ route('listainicio.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="Id_Empleado" value="{{ Auth::user()->Id_Empleado }}">
                            <label class="tittle-items">Selecciona los tareas a completar:</label><br><br>
                            <label class="items-tareas">
                                @foreach ($formato as $tarea)
                                <div class="checkbox-wrapper" style="padding: 5px">
                                    <input id="terms-checkbox-{{ $tarea['id'] }}" type="checkbox" name="id_tarea[]" value="{{ $tarea['id'] }}">
                                    <label class="terms-label" for="terms-checkbox-{{ $tarea['id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200" class="checkbox-svg">
                                            <mask fill="white" id="path-1-inside-1_476_5-37">
                                                <rect height="200" width="200"></rect>
                                            </mask>
                                            <rect mask="url(#path-1-inside-1_476_5-37)" stroke-width="40" class="checkbox-box" height="200" width="200"></rect>
                                            <path stroke-width="15" d="M52 111.018L76.9867 136L149 64" class="checkbox-tick"></path>
                                        </svg>
                                        <span class="label-text">{{ $tarea['nombre'] }}</span>
                                    </label>
                                </div>
                                @endforeach
                                <input type="hidden" name="fecha" value="{{ Carbon::now()->format('Y-m-d H:i:s') }}">
                            </label>
                            <input class="btn-submit" type="submit" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
            <footer class="footerLogin">
                <img class="logo1SenaLogin" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
                <p><b>Servicio nacional de aprendizaje <br>
                        Centro de la Innovación, agroindustria y aviación</b></p>
                <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
            </footer>
        </body>
    @endauth
@endsection
