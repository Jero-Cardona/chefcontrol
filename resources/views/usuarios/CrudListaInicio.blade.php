@extends('layouts.app')
@section('content')
@auth
<body class="bodyListas">
    <div class="contenedorListasR">
        <h2 class="tituloListasR">Listas Inicio de Jornada Registradas</h2>
        <form class="buscador" style="display: inline-flex; float: end;" action="{{route('buscar.listasFin')}}" method="GET">
            <input type="date" placeholder="Buscar por cliente o receta" name="buscar" value="{{ request('buscar')}}">
            <button>Buscar</button>
        </form>
    <div class="rowListasR">
        @foreach ($tareasCompletadasPorFecha->groupBy('fecha') as $fecha => $tareasCompletadas)
        <div class="contenedor1ListaR">
            <div class="cardListaR">
                <div class="cardHeaderListaR">
                    <h3 class="cardTitleListaR">Lista cosa</h3>
                </div>
                <div class="cardBodyListaR">
                    <p class="pListaR">
                        Realizada en {{ $fecha }}<br>
                        Cocinero Responsable: {{ $tareasCompletadas->first()->usuario->Nombre }}
                    </p>
                    <div class="divButtonListaR">
                        <a href="{{route('tareasInicio', $fecha)}}">
                            <button class="buttonListaR">Ver detalles</button>
                        </a>
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

