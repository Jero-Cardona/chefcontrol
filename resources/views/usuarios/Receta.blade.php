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
    <form method="POST" action="{{route('recetas.cantidadmultiplicada', $receta->Id_Receta)}}">
        @csrf
        <label for="cantidad">Cantidad de la receta</label>
        <input type="number" name="cantidad" min="1" required>
        <label for="Id_Cliente">Cliente al que se dirije la orden:</label>
        <select name="Id_Cliente" required>
        @foreach (tbl_cliente::all() as $cliente)
            <option value="{{$cliente->Id_cliente}}">{{$cliente->Nombre}}</option>
        @endforeach
        </select>
        <input type="hidden" name="Fecha"  value="{{ Carbon::now()->format('Y-m-d H:i:s') }}">
        <input type="hidden" name="Id_Empleado" value="{{Auth::user()->Id_Empleado}}">
        <input type="text" name="estado" value="En espera">
        <button type="submit">Calcular</button>
    </form>
<br>
    @if(isset($cantidadesAjustadas))
        <h2>Cantidades ajustadas para {{$cantidad}} cantidad:</h2>
        <ul>
            @foreach($cantidadesAjustadas as $detalle)
                <li>
                    {{ $detalle['producto']->Nombre }} - {{ number_format($detalle['cantidadAjustada'], 0, ',', '.') }} {{ $detalle['unidadMedida']->Unidad_Medida }}
                </li>
            @endforeach
        </ul>
    @endif
</div
@endauth            
@endsection
