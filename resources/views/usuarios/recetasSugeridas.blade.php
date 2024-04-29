@extends('layouts.app')
@section('content')
  


<div class="contenedorListasR">
    <h2 class="tituloListasR">Mis recetas sugeridas</h2>
    <div class="rowListasR">
            @foreach ($recetas as $receta)
            <div class="contenedor1ListaR">
                <div class="cardListaR">
                    {{-- <div class="cardHeaderListaR">
                        <h3 class="cardTitleListaR">Receta</h3>
                    </div> --}}
                    <div class="cardBodyListaR">
                        <div class="tablaResponsiveListaR">
                            <table class="tablaListaR">
                                <tbody>
                                    
                                    <h2 style="text-align: center;">{{ $receta->Nombre }}</h2>
                                    <img src="{{$receta->imagen}}" alt="{{$receta->Nombre}}" style="height: 150px; width: auto; ">
                                    @if($receta->Estado === 1)
                                    <p>Estado: Estandarizada</p>
                                    <hr>
                                    @else
                                    <p>Estado: En espera</p>
                                    <hr>
                                    @endif
                                    <p>{{$receta->Descripcion}}</p>
                                    <hr>
                                    <ul>
                                        @foreach ($receta->detallesReceta as $detalle)
                                       <li> {{ $detalle->producto->Nombre }} - {{ $detalle->Cantidad }} {{ $detalle->unidadMedida->Unidad_Medida }} </li>
                                        @endforeach
                                    </ul>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection