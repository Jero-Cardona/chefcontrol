@extends('layouts.app')
@section('content')
    @auth
        <body class="bodyListas">
            <div class="contenedorListasR">
                <h2 class="tituloListasR">Listas inicio de jornada registradas</h2>
                <div class="buscador-container">
                <form class="buscador"
                    action="{{ route('buscar.listas', ['buscar' => 1]) }}" method="GET">
                    <label for="date" id="buscadorform">Buscar lista por fecha</label>
                    <input type="date" placeholder="Buscar por cliente o receta" name="buscar" value="{{ request('buscar') }}">
                    <button>Buscar</button>
                </form>
                </div>
                <div class="rowListasR">
                    @foreach ($tareasCompletadasPorFecha->groupBy('fecha') as $fecha => $tareasCompletadas)
                        <div class="contenedor1ListaR">
                            <div class="cardListaR">
                                <div class="cardHeaderListaR">
                                    <h3 class="cardTitleListaR">Lista número: {{ number_format($i, 0, ',', '.') }}</h3>
                                </div>
                                <div class="cardBodyListaR" data-variable-i="{{ $i++ }}">
                                    <p class="pListaR"><b>Lista realizada en la fecha:</b><br>{{ $fecha }}<br><b>Cocinero
                                            Responsable:</b><br>{{ $tareasCompletadas->first()->usuario->Nombre }}</p>
                                    <div class="divButtonListaR">
                                        <a href="{{ route('vertareas', ['verlistas' => 1, 'fecha' => $fecha]) }}">
                                            <button class="buttonListaR">Ver Tareas</button>
                                        </a>
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
