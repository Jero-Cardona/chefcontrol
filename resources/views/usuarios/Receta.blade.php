@extends('layouts.app')
@section('style')
    {{-- link de boostrap 5 --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

<link rel="stylesheet" href="{{ asset('/css/calcular.css')}}">
@endsection
@section('content')
@auth

    {{-- <div>
        <div>
            <h2>Calcular Porciones</h2>
        </div>
        <div>
            <h1>{{ $receta->Nombre }}</h1>
        </div>
        <div>
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
            
            <form id="frmcantidad" method="POST" action="{{ route('recetas.cantidadmultiplicada', $receta->Id_Receta) }}">
                @csrf
                <div>
                    <label for="cantidad">Cantidad de la receta:</label>
                    <input type="number" name="cantidad" min="1" required>
                </div>
                
                
                <button  type="submit">Calcular</button>
                </div>
                
            </form>
            <br>
            @if(isset($cantidadesAjustadas))
                <h2>Cantidades ajustadas para {{ number_format($cantidad, 0, '.' , ',' )}} porciones:</h2>
                <ul>
                    @foreach($cantidadesAjustadas as $detalle)
                        <li>
                            {{ $detalle['producto']->Nombre }} - {{ number_format($detalle['cantidadAjustada'], 0, '.', ',') }} {{ $detalle['unidadMedida']->Unidad_Medida }}
                        </li>
                    @endforeach
                </ul>
            @endif 
                
        </div> --}}
        
        <div class="container">
            <div class="titulo">
                <h2 class="nombreR">Calcular Porciones</h2>
            </div>
            <div class="receta-info">
                <div>
                    <h2 class="nombre-ingredientes">{{ $receta->Nombre }}</h3>
                    <img src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}">
                </div>
                <div class="descripcion">
                    <p>{{ $receta->Descripcion }}</p>
                </div>
            </div>
            <div class="receta-info">
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
                <div>
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
