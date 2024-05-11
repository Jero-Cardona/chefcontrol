@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/ordenes.css') }}">
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
                <h1>Órdenes de producción en preparación</h1>
                <div class="search-download-container">
                <form class="buscador"
                    action="{{ route('buscar.ordenes', ['buscar' => 2]) }}" method="GET">
                    <input type="text" placeholder="Buscar por cliente o receta" name="buscar"
                        value="{{ request('buscar') }}">
                    <button>Buscar</button>
                </form>
                <a href="{{ route('ordenes.pdf', ['button_id' => 2]) }}" class="btnEditar"><b>Descargar PDF</b></a>
                </div>
            </div>
            <div class="orden-container">
                @foreach ($ordenesEnPreparacion->groupBy('cliente.Nombre') as $cliente => $ordenesDelCliente)
                    <div class="orden">
                        <h2>Cliente: {{ $cliente }}</h2>

                        @foreach ($ordenesDelCliente as $orden)
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
                                    <form action="{{ route('orden.entregado', ['ordenId' => $orden->Consecutivo]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit">Marcar como entregado</button>
                                    </form>
                                @endif

                                <hr>
                                <h3>Detalles de la orden</h3>

                                @if ($orden->detalles)
                                    <h4>Fecha Pedido: {{ $orden->detalles->Fecha_Pedido }}</h4>
                                    <h4>Presentación: {{ $orden->detalles->Presentacion }}</h4>
                                    <a href="{{ route('ordenes.detalles.edit', ['orden' => $orden->Consecutivo]) }}"
                                        class="btn btn-danger">Editar detalle</a>
                                    <hr>
                                @else
                                    <hr>
                                    <h3>Agregar detalle</h3>
                                    <form action="{{ route('ordenes.detalles.store', $orden->Consecutivo) }}" method="POST">
                                        @csrf
                                        <div>
                                            <label for="fecha_pedido">Fecha pedido:</label>
                                            <input class="form-control" type="datetime-local" name="Fecha_Pedido" required>
                                        </div>
                                        <div>
                                            <label>Presentación:</label>
                                            <input type="text" name="Presentacion" required>
                                        </div>
                                        <br>
                                        <button type="submit">Agregar detalle</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
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
