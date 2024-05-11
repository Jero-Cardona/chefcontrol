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
            <div>
                <div class="title-container">
                    <h1>Órdenes de producción en espera</h1>
                    <div class="search-download-container">
                        <form class="buscador" action="{{ route('buscar.ordenes', ['buscar' => 1]) }}" method="GET">
                            <input type="text" placeholder="Buscar por cliente o receta" name="buscar"
                                value="{{ request('buscar') }}">
                            <button>Buscar</button>
                        </form>
                        <a href="{{ route('ordenes.pdf', ['button_id' => 1]) }}" class="btnEditar"><b>Descargar PDF</b></a>
                    </div>
                </div>
                <div class="orden-container">
                    @foreach ($ordenesPorCliente as $cliente => $ordenesDelCliente)
                        @foreach ($ordenesDelCliente as $orden)
                            <div class="orden">
                                <h2>Cliente: {{ $cliente }}</h2>
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
                                    @if ($orden->estado == 'En espera')
                                        <i class="fas fa-hourglass-end fa-2x"></i>

                                        <form
                                            action="{{ route('orden.preparacion.iniciar', ['ordenId' => $orden->Consecutivo]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit">Preparación iniciada</button>
                                        </form>
                                    @endif
                                    <hr>
                                    @if ($orden->detalles)
                                        <h3>Detalles de la Orden</h3>
                                        <h4>Fecha Pedido: {{ $orden->detalles->Fecha_Pedido }}</h4>
                                        <h4>Presentación: {{ $orden->detalles->Presentacion }}</h4>
                                        <br>
                                        <a href="{{ route('ordenes.detalles.edit', ['orden' => $orden->Consecutivo]) }}">Editar
                                            Detalle</a>
                                        <hr>
                                    @else
                                        <h3>Aún no hay detalle</h3>
                                        <form action="{{ route('ordenes.detalles.store', $orden->Consecutivo) }}"
                                            method="POST">
                                            @csrf
                                            <div>
                                                <label for="fecha_pedido">Fecha pedido:</label>
                                                <input type="datetime-local" name="Fecha_Pedido" required>
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
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="form-container">
                <div>
                    <h2 style="color: black;">Agregar detalles a múltiples recetas</h2>
                    <form action="{{ route('ordenes.detalles.bulk') }}" method="POST">
                        @csrf
                        <div>
                            <label for="fecha_pedido">Fecha Pedido:</label>
                            <input type="datetime-local" name="Fecha_Pedido" required>
                        </div>
                        <div>
                            <label for="presentacion">Presentación:</label>
                            <input type="text" name="Presentacion" required>
                        </div>
                        <div class="checkbox-container">
                            @foreach ($ordenesEnEspera as $orden)
                                @if (!in_array($orden->Consecutivo, $ordenesConDetalles))
                                    <div>
                                        <input type="checkbox" name="recetas[]" value="{{ $orden->Consecutivo }}">
                                        {{ $orden->receta->Nombre }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <br>
                        <button type="submit">Agregar detalles</button>
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
    @endauth
@endsection
