@extends('layouts.app')
@section('title','ChefControl | Mis recetas')
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
                                                style="height: 150px; width: auto; border-radius: 15px;">
                                                <p style="text-align: justify;">{{ $receta->Descripcion }}</p>
                                                <hr>
                                                @if ($receta->Estado === 1)
                                                    <p>Estado: Estandarizada</p>
                                                    <hr>
                                                @else
                                                    <p>Estado: En espera</p>
                                                    <hr>
                                                @endif
                                                
                                                <h5>$COP {{number_format($receta->Costo_Total,  0, '.', ',')}}</h5>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Unidad de Medida</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($receta->detallesReceta as $detalle)
                                                    <tr>
                                                        <td>{{ $detalle->producto->Nombre }}</td>
                                                        <td>{{number_format($detalle->Cantidad, 0,'.', ',') }}</td>
                                                        <td>{{ $detalle->unidadMedida->Unidad_Medida }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="DivBtnEditar-">
                                    <a href="{{ route('receta.edit', $receta->Id_Receta) }}" style="width: 17%; text-aling: right;"
                                        class="btnEditar- swal-edit">Editar</a>
                                </div>
                            </div>
                            <!-- <div class="DivBtnEditar-">
                            <a href="{{ route('receta.edit', $receta->Id_Receta) }}" style="width: 17%; text-aling: right;"
                                class="btnEditar- swal-edit">Editar</a>
                            </div> -->
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <footer class="footerLogin">
            <img class="logo1SenaLogin" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
            <p><b>Servicio nacional de aprendizaje <br>
                Centro de la innovación, agroindustria y aviación</b></p>
            <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
        </footer>
@endsection
