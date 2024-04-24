@extends('layouts.app')
@section('style')
    {{-- link de boostrap 5 --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection
@section('content')
@auth
<div class="contenedorListasR">
    <h2 class="tituloListasR">Listas Inicio de Jornada Registradas</h2>
    <div class="rowListasR">
        @foreach ($tareasCompletadasPorFecha->groupBy('fecha') as $fecha => $tareasCompletadas)
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
                                {{--@foreach ($tareasCompletadas as $tareaCompletada)
                                <tr class="tr2ListaR">
                                    <td>{{ $tareaCompletada->tarea->nombre }}</td>
                                </tr>
                                @endforeach --}}
                                <p class="pListaR">Realizada en {{ $fecha }}<br>  Cocinero Responsable: {{ $tareasCompletadas->first()->usuario->Nombre }}</p>
                                <div class="divButtonListaR">
                                    <a style="text-decoration: none; color: #fff;" href="{{route('tareasInicio' , $fecha)}}"><button class="buttonListaR">Ver detalles</button></a>
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
{{-- Links de paginación --}}
@if ($tareasCompletadasPorFecha->hasPages())
<ul class="pagination">
    {{-- Botón "Primero" --}}
    @if (!$tareasCompletadasPorFecha->onFirstPage())
        <li><a href="{{ $tareasCompletadasPorFecha->url(1) }}">Primero</a></li>
    @endif

    {{-- Botón "Anterior" --}}
    @if ($tareasCompletadasPorFecha->onFirstPage())
        <li class="disabled"><span>Anterior</span></li>
    @else
        <li><a href="{{ $tareasCompletadasPorFecha->previousPageUrl() }}">Anterior</a></li>
    @endif
    {{-- para mostrar el numero de Items --}}
    {{$tareasCompletadasPorFecha->firstItem()}}
    de
    {{$tareasCompletadasPorFecha->total()}}
    {{-- Páginas --}}
    @foreach ($tareasCompletadasPorFecha->items() as $item)
        @if (is_string($item))
            <li class="disabled"><span>{{ $item }}</span></li>
        @endif
        @if (is_array($item))
            @foreach ($item as $page => $url)
                @if ($page == $tareasCompletadasPorFecha->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Botón "Siguiente" --}}
    @if ($tareasCompletadasPorFecha->hasMorePages())
        <li><a href="{{ $tareasCompletadasPorFecha->nextPageUrl() }}">Siguiente</a></li>
    @else
        <li class="disabled"><span>Siguiente</span></li>
    @endif

    {{-- Botón "Último" --}}
    @if ($tareasCompletadasPorFecha->hasMorePages())
        <li><a href="{{ $tareasCompletadasPorFecha->url($tareasCompletadasPorFecha->lastPage()) }}">Último</a></li>
    @endif
</ul>
@endif
@endauth
@endsection
