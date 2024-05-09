@extends('layouts.app')
@section('content')
    <div class="contenedorListasR-">
        <h2 class="tituloListasR-">Mis recetas sugeridas</h2>
        <div class="rowListasR-">
            @if ($recetas->isEmpty())
                <div class="cardHeaderListaR-">
                    <h3 class="cardTitleListaR-">No has sugerido ninguna receta</h1>
                </div>
            @else
                @foreach ($recetas as $receta)
                    <div class="contenedor1ListaR-">
                        <div class="cardListaR-">
                            <div class="cardBodyListaR-">
                                <div class="tablaResponsiveListaR-">
                                    <table class="tablaListaR-">
                                        <tbody>
                                            <h2 style="text-align: center;">{{ $receta->Nombre }}</h2>
                                            <img src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}"
                                                style="height: 150px; width: auto; ">
                                            @if ($receta->Estado === 1)
                                                <p>Estado: Estandarizada</p>
                                                <hr>
                                            @else
                                                <p>Estado: En espera</p>
                                                <hr>
                                            @endif
                                            <p style="text-align: justify;">{{ $receta->Descripcion }}</p>
                                            <hr>
                                            <ul>
                                                @foreach ($receta->detallesReceta as $detalle)
                                                    <li> {{ $detalle->producto->Nombre }} - {{ $detalle->Cantidad }}
                                                        {{ $detalle->unidadMedida->Unidad_Medida }} </li>
                                                @endforeach
                                            </ul>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <a href="{{ route('receta.edit', $receta->Id_Receta) }}" style="width: 17%; text-aling: right;"
                                class="btnEditar swal-edit">Editar</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
