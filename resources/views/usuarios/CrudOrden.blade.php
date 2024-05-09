@extends('layouts.app')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @auth
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card border-danger mb-3">
            <div class="card-header text-center">
                <h1 style="color: #8B0000;">Órdenes de Producción por Cliente</h1>
            </div>
            <div class="card-body">
                @foreach ($ordenesPorCliente as $cliente => $ordenes)
                    <h2 class="text-center" style="color: #8B4513;">Cliente: {{ $cliente }}</h2>
                    <hr>
                    <div class="row">
                        @foreach ($ordenes as $orden)
                            <div class="col-6">
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
                                            <form
                                                action="{{ route('orden.preparacion.iniciar', ['ordenId' => $orden->Consecutivo]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Preparación iniciada</button>
                                            </form>
                                        @elseif ($orden->estado == 'En preparación')
                                            <div class="spinner-border text-primary" role="status"
                                                style="width: 5rem; height: 5rem;">

                                            </div>
                                        @endif
                                        @if ($orden->estado == 'En preparación')
                                            <form action="{{ route('orden.entregado', ['ordenId' => $orden->Consecutivo]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Marcar como entregado</button>
                                            </form>
                                        @endif
                                        @if ($orden->estado == 'Entregado')
                                            <i class="fas fa-check-circle text-success fa-3x"></i>
                                        @endif
                                        <hr>
                                        <h3 style="color: #B22222;">Detalles de la Orden</h3>
                                        @if ($orden->detalles)
                                            <h4 style="color: #000000;">Fecha Pedido: {{ $orden->detalles->Fecha_Pedido }}</h4>
                                            <h4 style="color: #000000;">Presentación: {{ $orden->detalles->Presentacion }}</h4>
                                            <a href="{{ route('ordenes.detalles.edit', ['orden' => $orden->Consecutivo]) }}"
                                                class="btn btn-danger">Editar Detalle</a>
                                        @else
                                            <hr>
                                            <h3 style="color: red;">Agregar Detalle</h3>
                                            <form action="{{ route('ordenes.detalles.store', $orden->Consecutivo) }}"
                                                method="POST">
                                                @csrf
                                                <div>
                                                    <label for="fecha_pedido">Fecha Pedido:</label>
                                                    <input class="form-control" type="datetime-local" name="Fecha_Pedido"
                                                        required>
                                                </div>
                                                <div>
                                                    <label>Presentación:</label>
                                                    <input class="form-control" type="text" name="Presentacion" required>
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
        <hr style="height: 15px">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card text-center">
                        <h2 style="color: green;">Agregar detalles a múltiples recetas</h2>
                        <form class="form-group" action="{{ route('ordenes.detalles.bulk') }}" method="POST">
                            @csrf
                            <div>
                                <label for="fecha_pedido">Fecha Pedido:</label>
                                <input class="form-control" type="datetime-local" name="Fecha_Pedido" required>
                            </div>
                            <div>
                                <label for="presentacion">Presentación:</label>
                                <input class="form-control" type="text" name="Presentacion" required>
                            </div>
                            <div>
                                <label>Seleccionar recetas:</label>
                                @foreach ($ordenesPorCliente as $cliente => $ordenes)
                                    @foreach ($ordenes as $orden)
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="recetas[]"
                                                value="{{ $orden->Consecutivo }}"> {{ $orden->receta->Nombre }}
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <br>
                            <button class="btn btn-success" type="submit">Agregar Detalles</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
