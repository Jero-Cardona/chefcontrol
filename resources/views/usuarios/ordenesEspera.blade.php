@extends('layouts.app')
@section('content')
@auth
<div class="container">
    <div class="card border-danger mb-3">
        <div class="card-header text-center">
            <h1 style="color: #8B0000;">Órdenes de Producción en Espera</h1>
        </div>
        <div class="card-body">
            @foreach($ordenesEnEspera->groupBy('cliente.Nombre') as $cliente => $ordenesDelCliente)
                <h2 class="text-center" style="color: #8B4513;">Cliente: {{ $cliente }}</h2>
                <div class="row">
                    @foreach($ordenesDelCliente as $orden)
                        <div class="col-md-6">
                            <div class="card border-dark mb-3">
                                <div class="card-body">
                                    <h3 style="color: #B22222;">Orden #{{ $orden->Consecutivo }}</h3>
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
                                    @if ($orden->estado == 'En espera')
                                    <form action="{{ route('orden.preparacion.iniciar', ['ordenId' => $orden->Consecutivo]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Preparación iniciada</button>
                                    </form>
                                    @endif
                                    <hr>
                                    <h3 style="color: #B22222;">Detalles de la Orden</h3>
                                    @if($orden->detalles)
                                        <h4 style="color: #000000;">Fecha Pedido: {{ $orden->detalles->Fecha_Pedido }}</h4>
                                        <h4 style="color: #000000;">Presentación: {{ $orden->detalles->Presentacion }}</h4>
                                        <a href="{{ route('ordenes.detalles.edit', ['orden' => $orden->Consecutivo]) }}" class="btn btn-danger">Editar Detalle</a>
                                    @else
                                        <hr>
                                        <h3 style="color: red;">Agregar Detalle</h3>
                                        <form action="{{ route('ordenes.detalles.store', $orden->Consecutivo) }}" method="POST">
                                            @csrf
                                            <div>
                                                <label for="fecha_pedido">Fecha Pedido:</label>
                                                <input class="form-control" type="datetime-local" name="Fecha_Pedido"  required>
                                            </div>
                                            <div>
                                                <label >Presentación:</label>
                                                <input class="form-control" type="text" name="Presentacion"  required>
                                            </div>
                                            <button class="btn btn-danger" type="submit">Agregar Detalle</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>

@endauth
@endsection