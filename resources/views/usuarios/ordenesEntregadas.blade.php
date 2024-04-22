@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('/css/ordenes.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
   
@endsection
@section('content')
@auth
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
        <div class="title-container">
            <h1>Órdenes de Producción Entregadas</h1>
        </div>
        <div class="orden-container">
            @foreach($ordenesEntregadas->groupBy('cliente.Nombre') as $cliente => $ordenesDelCliente)
            <div class="orden">
                <h2>Cliente: {{ $cliente }}</h2>
                    @foreach($ordenesDelCliente as $orden)
                        
                                <div>
                                    <h3>Orden #{{ $orden->Consecutivo }}</h3>
                                    <hr>
                                    <h4>Fecha creación: {{ $orden->Fecha }}</h4>
                                    <h4>Empleado que realizó la orden: {{ $orden->empleado->Nombre }}</h4>
                                    <h4>Receta: {{ $orden->receta->Nombre }}</h4>
                                    <h4>Cantidad de porciones: {{ $orden->cantidad }}</h4>
                                    @if ($orden->receta)
                                    @php
                                        $precioOrden = $orden->receta->Costo_Total * $orden->cantidad;
                                        $precioFormato = number_format($precioOrden, 0, '.', ',');
                                    @endphp
                                    <h4>Precio de la orden: {{ $precioFormato }}</h4>
                                    @endif
                                    <h4>Estado de la orden: {{ $orden->estado }}</h4>
                                    @if ($orden->estado == 'Entregado')
                                    <i class="fas fa-thumbs-up fa-2x"></i>

                                    @endif
                                    <hr>
                                    <h3>Detalles de la Orden</h3>
                                    @if($orden->detalles)
                                        <h4>Fecha de entrega: {{ $orden->detalles->Fecha_Pedido }}</h4>
                                        <h4>Presentación: {{ $orden->detalles->Presentacion }}</h4>
                                        <hr>
                                    @else
                                        <hr>
                                        <h3>Agregar Detalle</h3>
                                        <form action="{{ route('ordenes.detalles.store', $orden->Consecutivo) }}" method="POST">
                                            @csrf
                                            <div>
                                                <label for="fecha_pedido">Fecha Pedido:</label>
                                                <input type="datetime-local" name="Fecha_Pedido"  required>
                                            </div>
                                            <div>
                                                <label >Presentación:</label>
                                                <input type="text" name="Presentacion"  required>
                                            </div>
                                            <br>
                                            <button  type="submit">Agregar Detalle</button>
                                        </form>
                                    @endif
                                </div>
                           
                    @endforeach
                </div>
            @endforeach
        </div>
</div>

@endauth   
@endsection