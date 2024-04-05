<?php
use App\Models\tbl_cliente;
use Carbon\Carbon;

$fechaActual = Carbon::now();
$clientes = tbl_cliente::all(); 
?>

@extends('layouts.app')
@section('content')
@auth
<div>
    <h1>{{ $receta->Nombre }}</h1>
    <p>{{ $receta->Descripcion }}</p>
    <img src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}">

    <h2>Ingredientes</h2>
    <ul>
        @foreach ($receta->detallesReceta as $detalle)
            <li>
                {{ $detalle->producto->Nombre }} - {{ $detalle->Cantidad }} {{ $detalle->unidadMedida->Unidad_Medida }}
            </li>
        @endforeach
    </ul>
<hr>
    <form id="frmcantidad" method="POST" action="{{route('recetas.cantidadmultiplicada', $receta->Id_Receta)}}">
        @csrf
        <label for="cantidad">Cantidad de la receta:</label>
        <input type="number" name="cantidadporciones" min="1" required><br><br>
        <button type="submit">Calcular</button>
    </form>
<br>
    @if(isset($cantidadesAjustadas))
        <h2>Cantidades ajustadas para {{$cantidad}} porciones:</h2>
        <ul>
            @foreach($cantidadesAjustadas as $detalle)
                <li>
                    {{ $detalle['producto']->Nombre }} - {{ number_format($detalle['cantidadAjustada'], 0, ',', '.') }} {{ $detalle['unidadMedida']->Unidad_Medida }}
                </li>
            @endforeach
        </ul>
    @endif
    <hr>
    <form id="frmorden" action="#" method="POST">
        <input type="hidden" name="Fecha"  value="{{ Carbon::now()->format('Y-m-d H:i:s') }}">  
        <label for="Id_Cliente">Cliente al que se dirije la orden:</label>
        <select name="Id_Cliente" id="Id_Cliente"><br>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->Id_Cliente }}">{{ $cliente->Nombre }}</option>
            @endforeach
        </select>
        <input type="hidden" name="Id_Empleado" value="{{Auth::user()->Id_Empleado}}"><br>
        <input type="hidden" name="Id_Receta" value=""><br>
        <label for="">Cantidad de porciones</label>
        <input type="number" name="cantidadorden" value="{{ session('cantidad') }}"><br>
        <input type="hidden" name="estado" value="En espera"><br><br>
        <button type="submit">Crear Orden de Producción</button>
    </form>
</div
@endauth            
@endsection
