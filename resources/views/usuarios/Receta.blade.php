@extends('layouts.app')
@section('title', 'ChefControl | Calcular porciones')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/calcular.css') }}">
@endsection
@section('content')
    @auth
        <div class="container">
            <div class="contenedorIngredientesR1">
                <div class="titulo">
                    <h2 class="nombreR">Calcular porciones</h2>
                </div>
                <div class="receta-info">
                    <img class="imgR" src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}">
                    <br>
                    <div class="receta-text">
                        <h2 class="nombre-ingredientes">{{ $receta->Nombre }}</h2>
                        <p class="descripcion1">{{ $receta->Descripcion }}</p>
                    </div>
                </div>
            </div>
            <div class="contenedorIngredientesR2">
                <div class="receta-info2">
                    <div class="ingredientes" style="margin: 0 auto;">
                        <h2 class="nombre-ingredientes">Ingredientes</h2>
                        @if ($receta->detallesReceta->isNotEmpty())

                        <table style="margin: 0 auto; height: 100px; text-align:left;">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad  </th>
                                    <th>Unidad de medida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receta->detallesReceta as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->Nombre }}</td>
                                        <td>{{ number_format($detalle['Cantidad'], 0, '.', ',') }}</td>
                                        <td>{{ $detalle->unidadMedida->Unidad_Medida }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <div class="calcular-div" style="margin: 0 auto;">
                        <form id="frmcantidad" method="POST"
                            action="{{ route('recetas.cantidadmultiplicada', $receta->Id_Receta) }}">
                            @csrf
                            <div class="calcular-div2">
                                <label for="cantidad">Cantidad de la receta:</label>
                                <input type="number" name="cantidad" min="1" required>
                            </div>
                            <button type="submit">Calcular</button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            @if (isset($cantidadesAjustadas))
                <h2 class="nombre-ingredientes">Cantidades ajustadas para {{ number_format($cantidad, 0, '.', ',') }} porciones:</h2>
                <br>
                <table style="margin: 0 auto; width: 80%; height: 100px;">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad ajustada</th>
                            <th>Unidad de medida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cantidadesAjustadas as $detalle)
                            <tr>
                                <td>{{ $detalle['producto']->Nombre }}</td>
                                <td>{{ number_format($detalle['cantidadAjustada'], 0, '.', ',') }}</td>
                                <td>{{ $detalle['unidadMedida']->Unidad_Medida }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endauth
@endsection
