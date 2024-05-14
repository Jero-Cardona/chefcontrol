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
                            <button class="btnOrdenes">Buscar</button>
                        </form>
                        <a href="{{ route('ordenes.pdf', ['button_id' => 1]) }}" class="btnEditar swal-pdfs"><b>Descargar PDF</b></a>
                    </div>
                </div>
                <div class="orden-container">
                    @foreach ($ordenesPorCliente->groupBy('cliente.Nombre') as $cliente => $ordenesDelCliente)
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
                                    <i class="fas fa-hourglass-end fa-2x"></i>
                                    @if (Auth::user()->Id_Rol == '1')
                                    @if ($orden->estado == 'En espera')
                                        <form
                                            action="{{ route('orden.preparacion.iniciar', ['ordenId' => $orden->Consecutivo]) }}"
                                            method="POST">
                                            @csrf
                                            <button class="btnOrdenes" type="submit">Preparación iniciada</button>
                                        </form>
                                    @endif
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
                                            <button class="btnOrdenes" type="submit">Agregar detalle</button>
                                        </form>
                                    @endif
                                </div>
                                <a href="{{ route('orden.pdf', ['ordenId' => $orden->Consecutivo, 'button' => 1]) }}"
                                class="btnEditar swal-descargar" style="margin: 20px 0 10px 0; display: inline-flex;">Descargar Orden de produccion</a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
             {{-- Links de paginación --}}
             @if ($ordenesPorCliente->hasPages())
             <ul class="pagination">
                 {{-- Botón "Primero" --}}
                 @if (!$ordenesPorCliente->onFirstPage())
                     <li><a href="{{ $ordenesPorCliente->url(1) }}">Primero</a></li>
                 @endif
                 {{-- Botón "Anterior" --}}
                 @if ($ordenesPorCliente->onFirstPage())
                     <li class="disabled"><span>Anterior</span></li>
                 @else
                     <li><a href="{{ $ordenesPorCliente->previousPageUrl() }}">Anterior</a></li>
                 @endif
                 {{-- para mostrar el numero de Items --}}
                 {{ $ordenesPorCliente->firstItem() }}
                 de
                 {{ $ordenesPorCliente->total() }}
                 {{-- Páginas --}}
                 @foreach ($ordenesPorCliente->items() as $item)
                     @if (is_string($item))
                         <li class="disabled"><span>{{ $item }}</span></li>
                     @endif
                     @if (is_array($item))
                         @foreach ($item as $page => $url)
                             @if ($page == $ordenesPorCliente->currentPage())
                                 <li class="active"><span>{{ $page }}</span></li>
                             @else
                                 <li><a href="{{ $url }}">{{ $page }}</a></li>
                             @endif
                         @endforeach
                     @endif
                 @endforeach
                 {{-- Botón "Siguiente" --}}
                 @if ($ordenesPorCliente->hasMorePages())
                     <li><a href="{{ $ordenesPorCliente->nextPageUrl() }}">Siguiente</a></li>
                 @else
                     <li class="disabled"><span>Siguiente</span></li>
                 @endif
                 {{-- Botón "Último" --}}
                 @if ($ordenesPorCliente->hasMorePages())
                     <li><a href="{{ $ordenesPorCliente->url($ordenesPorCliente->lastPage()) }}">Último</a></li>
                 @endif
             </ul>
         @endif
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
                        @foreach ($ordenesEnEspera as $orden)
                            {{-- check boxes --}}
                            @if (!in_array($orden->Consecutivo, $ordenesConDetalles))
                            <div class="checkbox-wrapper" style="padding: 5px">
                                <input  id="terms-checkbox-{{  $orden->Consecutivo }}" type="checkbox" name="recetas[]" value="{{ $orden->Consecutivo}}">
                                <label class="terms-label" for="terms-checkbox-{{ $orden->Consecutivo }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 200 200" class="checkbox-svg">
                                        <mask fill="white" id="path-1-inside-1_476_5-37">
                                            <rect height="200" width="200"></rect>
                                        </mask>
                                        <rect mask="url(#path-1-inside-1_476_5-37)" stroke-width="40" class="checkbox-box" height="200" width="200"></rect>
                                        <path stroke-width="15" d="M52 111.018L76.9867 136L149 64" class="checkbox-tick"></path>
                                    </svg>
                                    <span class="label-text">{{ $orden->receta->Nombre }}</span>
                                </label>
                            </div>
                            @endif
                            @endforeach
                        <br>
                        <button class="btnOrdenes" type="submit">Agregar detalles</button>
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
