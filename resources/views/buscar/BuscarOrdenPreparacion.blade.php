@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('/css/ordenes.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
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
        <h1>Resultados de {{$searchTerm}}</h1>
        <form class="buscador" style="display: inline-flex; float: end;" action="{{route('buscar.ordenesPreparacion')}}" method="GET">
            <input type="text" placeholder="Buscar por cliente o receta" name="buscar" value="{{ request('buscar')}}">
            <button>Buscar</button>
        </form>
    </div>

    <div class="orden-container">
        @foreach($resultados->groupBy('cliente.Nombre') as $cliente => $ordenesDelCliente)
            <div class="orden">
                <h2>Cliente: {{ $cliente }}</h2>
                
                @foreach($ordenesDelCliente as $orden)
                    <div>
                        <h3>Orden #{{ $orden->Consecutivo }}</h3>
                        <hr>
                        <h4>Fecha: {{ $orden->Fecha }}</h4>
                        <h4>Empleado: {{ $orden->empleado->Nombre }}</h4>
                        <h4>Receta: {{ $orden->receta->Nombre }}</h4>
                        <h4>Cantidad: {{ $orden->cantidad }}</h4>

                        @if ($orden->receta)
                            @php
                                $precioOrden = $orden->receta->Costo_Total * $orden->cantidad;
                                $precioFormato = number_format($precioOrden, 0, '.', ',');
                            @endphp
                            <h4>Precio de la orden: {{ $precioFormato }}</h4>
                        @endif

                        <h4>Estado: {{ $orden->estado }}</h4>

                        @if ($orden->estado == 'En preparación')
                            <i class="fas fa-utensils fa-spin fa-2x"></i>
                        @endif

                        @if ($orden->estado == 'En preparación')
                            <form action="{{ route('orden.entregado', ['ordenId' => $orden->Consecutivo]) }}" method="POST">
                                @csrf
                                <button type="submit">Marcar como entregado</button>
                            </form>
                        @endif

                        <hr>
                        <h3>Detalles de la Orden</h3>

                        @if($orden->detalles)
                            <h4>Fecha Pedido: {{ $orden->detalles->Fecha_Pedido }}</h4>
                            <h4>Presentación: {{ $orden->detalles->Presentacion }}</h4>
                            <a href="{{ route('ordenes.detalles.edit', ['orden' => $orden->Consecutivo]) }}" class="btn btn-danger">Editar Detalle</a>
                            <hr>
                        @else
                            <hr>
                            <h3>Agregar Detalle</h3>
                            <form action="{{ route('ordenes.detalles.store', $orden->Consecutivo) }}" method="POST">
                                @csrf
                                <div>
                                    <label for="fecha_pedido">Fecha Pedido:</label>
                                    <input class="form-control" type="datetime-local" name="Fecha_Pedido" required>
                                </div>
                                <div>
                                    <label>Presentación:</label>
                                    <input type="text" name="Presentacion" required>
                                </div>
                                <br>
                                <button type="submit">Agregar Detalle</button>
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