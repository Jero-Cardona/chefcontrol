@extends('layouts.app')
@section('content')
    @auth
        <div class="contenedorListasR">
            <h2 class="tituloListasR">Listas de Inicio registradas el dia : {{ $searchTerm }}</h2>
            <div class="rowListasR">
                @foreach ($resultados as $fecha => $tareasCompletadas)
                    <div class="contenedor1ListaR">
                        <div class="cardListaR">
                            <div class="cardHeaderListaR">
                                <h3 class="cardTitleListaR">Lista cosa</h3>
                            </div>
                            <div class="cardBodyListaR">
                                <div class="tablaResponsiveListaR">
                                    <table class="tablaListaR">
                                        <tbody>
                                            {{-- <img style="width: 100px; height: 70px;" src="{{asset('imagenes/proyecto/image21.png')}}"> --}}
                                            <p class="pListaR">Lista realizada en la fecha: {{ $fecha }} <br> Cocinero
                                                Responsable: {{ $tareasCompletadas->first()->usuario->Nombre }}</p>
                                            <div class="divButtonListaR">
                                                <a style="text-decoration: none; color: #fff;"
                                                    href="{{ route('tareaInicio', $fecha) }}"><button class="buttonListaR">Ver detalles</button></a>
                                            </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endauth
@endsection
