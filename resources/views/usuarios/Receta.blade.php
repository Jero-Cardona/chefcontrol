@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('/css/calcular.css')}}">
@endsection

@section('content')
@auth
    <div class="container">
        <div class="titulo">
            <h2 class="nombreR">Calcular Porciones</h2>
        </div>
        <div class="receta-info">
            <img class="imgR" src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}">
            <div class="receta-text">
                <h2 class="nombre-ingredientes">{{ $receta->Nombre }}</h2>
                <p class="descripcion">{{ $receta->Descripcion }}</p>
            </div>
        </div>
        <div class="receta-info2">
            <div class="ingredientes">
                <h2 class="nombre-ingredientes">Ingredientes</h2>
                <ul>
                    @foreach ($receta->detallesReceta as $detalle)
                        <li>
                            {{ $detalle->producto->Nombre }} - {{ $detalle->Cantidad }} {{ $detalle->unidadMedida->Unidad_Medida }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="calcular-div">
                <form id="frmcantidad" method="POST" action="{{ route('recetas.cantidadmultiplicada', $receta->Id_Receta) }}">
                    @csrf
                    <div>
                        <label for="cantidad">Cantidad de la receta:</label>
                        <input type="number" name="cantidad" min="1" required>
                    </div>
                    <button type="submit">Calcular</button>
                </form>
            </div>
        </div>

        @if(isset($cantidadesAjustadas))
            <h2 class="nombre-ingredientes">Cantidades ajustadas para {{ number_format($cantidad, 0, '.' , ',' )}} porciones:</h2>
            <ul>
                @foreach($cantidadesAjustadas as $detalle)
                    <li>
                        {{ $detalle['producto']->Nombre }} - {{ number_format($detalle['cantidadAjustada'], 0, '.', ',') }} {{ $detalle['unidadMedida']->Unidad_Medida }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endauth
@endsection
