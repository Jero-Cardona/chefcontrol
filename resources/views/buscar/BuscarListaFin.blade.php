@extends('layouts.app')
@section('style')
    {{-- link de boostrap 5 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection
@section('content')
    @auth
    <body class="bodyListas">
        <div class="contenedorListasR">
            <h2 class="tituloListasR">Listas de Fin de jornada registradas el dia : {{ $searchTerm }}</h2>
            <div class="buscador-container">
                <form class="buscador"
                    action="{{ route('buscar.listas', ['buscar' => 2]) }}" method="GET">
                    <label for="date" id="buscadorform">Buscar lista por fecha</label>
                    <input type="date" placeholder="Buscar por cliente o receta" name="buscar" value="{{ request('buscar') }}">
                    <button>Buscar</button>
                </form>
                </div>
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
                                            <p class="pListaR"><b>Lista realizada en la fecha: </b>{{ $fecha }} <br> <b>Cocinero
                                                Responsable: </b>{{ $tareasCompletadas->first()->usuario->Nombre }}</p>
                                            <div class="divButtonListaR">
                                                <a style="text-decoration: none; color: #fff;"
                                                    href="{{ route('vertareas', ['verlistas' => 2, 'fecha' => $fecha]) }}"><button class="buttonListaR"><b>Ver
                                                        Tareas</b></button></a>
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
    </body>
    @endauth
@endsection
