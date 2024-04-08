
@extends('layouts.app')
@section('content')
@auth
<div>
    <div class="card border-danger mb-3">
        <div class="card-header text-center">
            <h1>{{ $receta->Nombre }}</h1>
        </div>
        <div class="card-body">
            <p>{{ $receta->Descripcion }}</p>
            <img src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}" class="img-fluid">
            <h2>Ingredientes</h2>
            <ul class="list-unstyled">
                @foreach ($receta->detallesReceta as $detalle)
                    <li>
                        {{ $detalle->producto->Nombre }} - {{ $detalle->Cantidad }} {{ $detalle->unidadMedida->Unidad_Medida }}
                    </li>
                @endforeach
            </ul>
            <hr>
            <form id="frmcantidad" method="POST" action="{{ route('recetas.cantidadmultiplicada', $receta->Id_Receta) }}">
                @csrf
                <div class="form-group">
                    <label for="cantidad">Cantidad de la receta:</label>
                    <input class="form-control" type="number" name="cantidad" min="1" required>
                </div>
                <div class="row">
                <div class="col">
                <button class="btn btn-primary" type="submit">Calcular</button>
                </div>
                <div class="col text-right">
                    <a href="{{ route('receta.recetario') }}" class="btn btn-success">Volver</a>
                </div>
            </div>
            </form>
            <br>
            @if(isset($cantidadesAjustadas))
                <h2>Cantidades ajustadas para {{ $cantidad }} porciones:</h2>
                <ul class="list-unstyled">
                    @foreach($cantidadesAjustadas as $detalle)
                        <li>
                            {{ $detalle['producto']->Nombre }} - {{ number_format($detalle['cantidadAjustada'], 0, ',', '.') }} {{ $detalle['unidadMedida']->Unidad_Medida }}
                        </li>
                    @endforeach
                </ul>
            @endif     
        </div>
    </div>
    
@endauth            
@endsection
