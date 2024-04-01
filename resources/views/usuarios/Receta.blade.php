@extends('layouts.app')
@section('content')
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
    <form method="POST" action="{{ route('recetas.cantidadmultiplicada', $receta->Id_Receta) }}">
        @csrf
        <label for="porciones">Número de porciones:</label>
        <input type="number" name="porciones" min="1" required>
        <button type="submit">Calcular</button>
    </form>
<br>
    @if(isset($cantidadesAjustadas))
        <h2>Cantidades ajustadas para {{$porciones}} porciones:</h2>
        <ul>
            @foreach($cantidadesAjustadas as $detalle)
                <li>
                    {{ $detalle['producto']->Nombre }} - {{ number_format($detalle['cantidadAjustada'], 0, ',', '.') }} {{ $detalle['unidadMedida']->Unidad_Medida }}
                </li>
            @endforeach
        </ul>
    @endif
</div
@endsection
