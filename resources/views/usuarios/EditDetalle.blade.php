@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('/css/ordenes.css')}}">
    

@section('content')
<div class="container">

    <div class="form-container">
        <div class="title-container" style="background-color: rgba(154, 0, 15)">
        <h1>Editar Detalle de Orden #{{ $orden->Consecutivo }}</h1>
    </div>
    <div class="">
        <form class="" action="{{ route('ordenes.detalles.update', $orden->Consecutivo) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="">
                <label for="Fecha_Pedido">Fecha Pedido:</label>
                <input class="" type="datetime-local" name="Fecha_Pedido" value="{{ $orden->detalles->Fecha_Pedido }}" required>
            </div>
            <div class="">
                <label for="">Presentación:</label>
                <input class="" type="text" name="Presentacion" value="{{ $orden->detalles->Presentacion }}" required>
            </div>
            <br>
            <div class="">
                <button class="" type="submit">Actualizar Detalle</button>
            </div>
        </form>
    </div>
</div>
</div>

@endsection