@extends('layouts.app')
@section('content')
    @auth
        <body class="bodyListas">
            <div class="contenedorListasR">
                <h2 class="tituloListasR">Listas fin de jornada registradas</h2>
                <form class="buscador" style="display: inline-flex; float: end;"
                    action="{{ route('buscar.listas', ['buscar' => 2]) }}" method="GET">
                    <input type="date" placeholder="Buscar por cliente o receta" name="buscar" value="{{ request('buscar') }}">
                    <button>Buscar</button>
                </form>
                <div class="rowListasR">
                    @foreach ($tareasCompletadasPorFecha as $fecha => $tareasCompletadas)
                        <div class="contenedor1ListaR">
                            <div class="cardListaR">
                                <div class="cardHeaderListaR">
                                    <h3 class="cardTitleListaR">Lista número {{ $i }}</h3>
                                </div>
                                <div class="cardBodyListaR" data-variable-i="{{ $i++ }}">
                                    <div class="tablaResponsiveListaR">
                                        <table class="tablaListaR">
                                            <tbody>
                                                {{-- <img style="width: 100px; height: 70px;" src="{{asset('imagenes/proyecto/image21.png')}}"> --}}
                                                <p class="pListaR"><b>Lista realizada en la
                                                        fecha:</b><br>{{ $fecha }}<br><b>Cocinero
                                                        Responsable:</b><br>{{ $tareasCompletadas->first()->usuario->Nombre }}
                                                </p>
                                                <div class="divButtonListaR">
                                                    <a style="text-decoration: none; color: #fff;"
                                                        href="{{ route('vertareas', ['verlistas' => 2, 'fecha' => $fecha]) }}"><button
                                                        class="buttonListaR">Ver detalles</button></a>
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
            <footer class="footerLogin">
                <img class="logo1SenaLogin" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
                <p><b>Servicio nacional de aprendizaje <br>
                        Centro de la innovación, agroindustria y aviación</b></p>
                <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
            </footer>
        </body>
    @endauth
@endsection
