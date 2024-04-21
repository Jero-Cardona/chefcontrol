@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('/css/ordenes.css')}}">
{{-- link de boostrap 5 --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection
@section('content')
{{-- <style>
    body{
    margin: 0px;
    font-family: "literata", serif;
    font-style: italic;
    padding: 0px;
    text-decoration: none;
    box-sizing: border-box;
}
</style> --}}
@auth
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
{{-- <div>
    <div>
        <div>
            <h1 style="color: #8B0000;">Órdenes de Producción en Espera</h1>
        </div>
        <div>
            @foreach($ordenesEnEspera->groupBy('cliente.Nombre') as $cliente => $ordenesDelCliente)
                <h2  style="color: #8B4513;">Cliente: {{ $cliente }}</h2>
                <div >
                    @foreach($ordenesDelCliente as $orden)
                        <div >
                            <div >
                                <div>
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
                                    <button type="submit" >Preparación iniciada</button>
                                    </form>
                                    @endif
                                    <hr>
                                    <h3 style="color: #B22222;">Detalles de la Orden</h3>
                                    @if($orden->detalles)
                                        <h4 style="color: #000000;">Fecha Pedido: {{ $orden->detalles->Fecha_Pedido }}</h4>
                                        <h4 style="color: #000000;">Presentación: {{ $orden->detalles->Presentacion }}</h4>
                                        <a href="{{ route('ordenes.detalles.edit', ['orden' => $orden->Consecutivo]) }}" >Editar Detalle</a>
                                    @else
                                        <hr>
                                        <h3 style="color: red;">Agregar Detalle</h3>
                                        <form action="{{ route('ordenes.detalles.store', $orden->Consecutivo) }}" method="POST">
                                            @csrf
                                            <div>
                                                <label for="fecha_pedido">Fecha Pedido:</label>
                                                <input  type="datetime-local" name="Fecha_Pedido"  required>
                                            </div>
                                            <div>
                                                <label >Presentación:</label>
                                                <input  type="text" name="Presentacion"  required>
                                            </div>
                                            <button type="submit">Agregar Detalle</button>
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
<hr>
        <div >
            <div>
                <div>
                    <div>
                        <h2>Agregar detalles a múltiples recetas</h2>
                        <form  action="{{ route('ordenes.detalles.bulk') }}" method="POST">
                            @csrf
                            <div>
                                <label for="fecha_pedido">Fecha Pedido:</label>
                                <input type="datetime-local" name="Fecha_Pedido"  required>
                            </div>
                            <div>
                                <label for="presentacion">Presentación:</label>
                                <input type="text" name="Presentacion"  required>
                            </div>
                            <div>
                                <label>Seleccionar recetas:</label>
                                @foreach($ordenesPorCliente as $cliente => $ordenes)
                                    @foreach($ordenes as $orden)
                                        <div>
                                            <input type="checkbox" name="recetas[]" value="{{ $orden->Consecutivo }}"> {{ $orden->receta->Nombre }}
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <br>
                            <button  type="submit">Agregar Detalles</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>  --}}

        <div class="container">
            <div>
                <div class="title-container">
                    <h1>Órdenes de Producción en Espera</h1>
                </div>
                <div class="orden-container">
                    @foreach($ordenesEnEspera->groupBy('cliente.Nombre') as $cliente => $ordenesDelCliente)
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
                            @if ($orden->estado == 'En espera')
                                <form action="{{ route('orden.preparacion.iniciar', ['ordenId' => $orden->Consecutivo]) }}" method="POST">
                                    @csrf
                                    <button type="submit">Preparación iniciada</button>
                                </form>
                            @endif
                            <hr>
                            @if($orden->detalles)
                            <h3>Detalles de la Orden</h3>
                                <h4>Fecha Pedido: {{ $orden->detalles->Fecha_Pedido }}</h4>
                                <h4>Presentación: {{ $orden->detalles->Presentacion }}</h4>
                                <a href="{{ route('ordenes.detalles.edit', ['orden' => $orden->Consecutivo]) }}">Editar Detalle</a>
                                <hr>
                            @else
                                <h3 >Aún no hay detalle</h3>
                                <form action="{{ route('ordenes.detalles.store', $orden->Consecutivo) }}" method="POST">
                                    @csrf
                                    <div>
                                        <label for="fecha_pedido">Fecha Pedido:</label>
                                        <input type="datetime-local" name="Fecha_Pedido" required>
                                    </div>
                                    <div>
                                        <label>Presentación:</label>
                                        <input type="text" name="Presentacion" required>
                                    </div>
                                    <button type="submit">Agregar Detalle</button>
                                </form>
                            @endif
                        </div>
                            @endforeach
                        </div>
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
                            @foreach($ordenesPorCliente as $cliente => $ordenes)
                                @foreach($ordenes as $orden)
                                @if ($orden->estado == 'En espera')
                                    <div>
                                        <input type="checkbox" name="recetas[]" value="{{ $orden->Consecutivo }}"> {{ $orden->receta->Nombre }}
                                    </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                        <br>
                        <button type="submit">Agregar Detalles</button>
                    </form>
                </div>
            </div>
        </div>
        
@endauth
@endsection