@extends('layouts.app')
@section('title','ChefControl | Editar detalle orden')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/ordenes.css') }}">


@section('content')
    <div class="container">

        <div class="form-container">
            <div class="title-container" style="background-color: rgba(154, 0, 15)">
                <h1>Editar detalle de orden #{{ $orden->Consecutivo }}</h1>
            </div>
            <div class="">
                <form class="" action="{{ route('ordenes.detalles.update', $orden->Consecutivo) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <label for="Fecha_Pedido">Fecha pedido:</label>
                        <input class="" type="datetime-local" name="Fecha_Pedido"
                            value="{{ $orden->detalles->Fecha_Pedido }}" required>
                    </div>
                    <div class="">
                        <label for="">Presentación:</label>
                        <input class="" type="text" name="Presentacion"
                            value="{{ $orden->detalles->Presentacion }}" required>
                    </div>
                    <br>
                    <div class="">
                        <button class="btnOrdenes" type="submit">Actualizar detalle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footerLogin">
            <img class="logo1SenaLogin" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
            <p><b>Servicio nacional de aprendizaje <br>
                    Centro de la innovación, agroindustria y aviación</b></p>
            <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
    </footer>

@endsection
