@extends('layouts.app')
@section('content')
@auth
<body class="bodyListas">
    <div class="contenedorListasR">
        <h2 class="tituloListasR">Listas Fin de Jornada Registradas</h2>
        <form class="buscador" style="display: inline-flex; float: end;" action="{{route('buscar.listasFin')}}" method="GET">
            <input type="date" placeholder="Buscar por cliente o receta" name="buscar" value="{{ request('buscar')}}">
            <button>Buscar</button>
        </form>
    <div class="rowListasR">
        @foreach ($tareasCompletadasPorFecha as $fecha => $tareasCompletadas)
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
                                <p class="pListaR">Lista realizada en la fecha: {{ $fecha }}  <br>  Cocinero Responsable: {{ $tareasCompletadas->first()->usuario->Nombre }}</p>
                                <div class="divButtonListaR">
                                    <a style="text-decoration: none; color: #fff;" href="{{route('tareasFin' , $fecha)}}"><button class="buttonListaR">Ver detalles</button></a>
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
