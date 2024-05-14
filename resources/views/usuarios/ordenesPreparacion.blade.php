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
                <h1>Órdenes de producción en preparación</h1>
                <div class="search-download-container">
                <form class="buscador"
                    action="{{ route('buscar.ordenes', ['buscar' => 2]) }}" method="GET">
                    <input type="text" placeholder="Buscar por cliente o receta" name="buscar"
                        value="{{ request('buscar') }}">
                    <button class="btnOrdenes">Buscar</button>
                </form>
                <a href="{{ route('ordenes.pdf', ['button_id' => 2]) }}" class="btnEditar swal-pdfs"><b>Descargar PDF</b></a>
                </div>
            </div>
            <div class="orden-container">
                @foreach ($ordenesEnPreparacion->groupBy('cliente.Nombre') as $cliente => $ordenesDelCliente)
                    @foreach ($ordenesDelCliente as $orden)
                    <div class="orden">
                        <h2>Cliente: {{ $orden->cliente->Nombre . ' ' . $orden->cliente->Apellido }}</h2>

                            <div>
                                <h3>Orden #{{ $orden->Consecutivo }}</h3>
                                <hr>
                                <h4>Fecha: {{ $orden->Fecha }}</h4>
                                <h4>Empleado: {{ $orden->empleado->Nombre . ' ' . $orden->empleado->Apellido }}</h4>
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
                                @if (Auth::user()->Id_Rol == '1')

                                @if ($orden->estado == 'En preparación')
                                    <form action="{{ route('orden.entregado', ['ordenId' => $orden->Consecutivo]) }}"
                                        method="POST">
                                        @csrf
                                        <button class="btnOrdenes" type="submit">Marcar como entregado</button>
                                    </form>
                                @endif
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
                                        <button class="btnOrdenes" type="submit">Agregar detalle</button>
                                    </form>
                                @endif
                            </div>
                            <a href="{{ route('orden.pdf', ['ordenId' => $orden->Consecutivo, 'button' => 2]) }}"
                                class="btnEditar swal-descargar" style="margin: 20px 0 10px 0; display: inline-flex;">Descargar Orden de produccion</a>
                            </div>
                        @endforeach
                @endforeach
            </div>
             {{-- Links de paginación --}}
             @if ($ordenesEnPreparacion->hasPages())
             <ul class="pagination">
                 {{-- Botón "Primero" --}}
                 @if (!$ordenesEnPreparacion->onFirstPage())
                     <li><a href="{{ $ordenesEnPreparacion->url(1) }}">Primero</a></li>
                 @endif
                 {{-- Botón "Anterior" --}}
                 @if ($ordenesEnPreparacion->onFirstPage())
                     <li class="disabled"><span>Anterior</span></li>
                 @else
                     <li><a href="{{ $ordenesEnPreparacion->previousPageUrl() }}">Anterior</a></li>
                 @endif
                 {{-- para mostrar el numero de Items --}}
                 {{ $ordenesEnPreparacion->firstItem() }}
                 de
                 {{ $ordenesEnPreparacion->total() }}
                 {{-- Páginas --}}
                 @foreach ($ordenesEnPreparacion->items() as $item)
                     @if (is_string($item))
                         <li class="disabled"><span>{{ $item }}</span></li>
                     @endif
                     @if (is_array($item))
                         @foreach ($item as $page => $url)
                             @if ($page == $ordenesEnPreparacion->currentPage())
                                 <li class="active"><span>{{ $page }}</span></li>
                             @else
                                 <li><a href="{{ $url }}">{{ $page }}</a></li>
                             @endif
                         @endforeach
                     @endif
                 @endforeach
                 {{-- Botón "Siguiente" --}}
                 @if ($ordenesEnPreparacion->hasMorePages())
                     <li><a href="{{ $ordenesEnPreparacion->nextPageUrl() }}">Siguiente</a></li>
                 @else
                     <li class="disabled"><span>Siguiente</span></li>
                 @endif
                 {{-- Botón "Último" --}}
                 @if ($ordenesEnPreparacion->hasMorePages())
                     <li><a href="{{ $ordenesEnPreparacion->url($ordenesEnPreparacion->lastPage()) }}">Último</a></li>
                 @endif
             </ul>
         @endif
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
