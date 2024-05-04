@extends('layouts.app')
@section('content')
<div class="container">
    @if (session('success'))
    <div style="padding: 10px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: white; background-color: rgba(255, 102, 0); border-color: #f5c6cb;" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <div class="div1">
        <div class="div2">
            <div class="div3">
                <div class="divHeader">
                    @if ($resultados->isEmpty())
                    <h3 class="titulo">No se encontro : <b>{{$searchTerm}}</b></h3>
                    @else
                    <h3 class="titulo">Resultados para la busqueda de <b>{{$searchTerm}}</b></h3>
                    @endif
                    <form class="buscador" action="{{route('buscar.recetas', ['buscar' => $buscar]) }}" method="GET">
                        @csrf
                        <input type="text" placeholder="Buscar" name="buscar" value="{{ request('buscar')}}">
                        <button>Buscar</button>
                    </form>
                </div>
                <div class="divBody">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descipcion</th>
                                <th>Costo</th>
                                <th>Aporte</th>
                                <th>Estado</th>
                                <th>Etapa</th>
                                <th>imagen</th>
                                @if(Auth::user()->Id_Rol == '1')
                                <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            {{-- registros de las encontradas --}}
                            @foreach ($resultados as $receta)
                            <tr>
                                <td>{{ $receta->Nombre }}</td>
                                <td>{{ $receta->Descripcion }}</td>
                                <td>{{ $receta->Costo_Total }}</td>
                                <td>{{ $receta->Contribucion }}</td>
                                <td>
                                @if($receta->Estado == 1)
                                    Estandarizada
                                @elseif($receta->Estado == 2)
                                    En espera
                                @endif
                                </td>
                                <td>
                               @if($receta->etapa == true)
                                   Activo
                               @else
                                   Inactivo
                               @endif
                               </td>
                                <td> <img style="height: 100px; width: 100px" src="{{$receta->imagen}}" alt=""> </td>
                                @if(Auth::user()->Id_Rol == '1')
                                <td class="crud-form">
                                <a href="{{ route('receta.edit', $receta->Id_Receta) }}" class="btnEditar swal-edit">Editar</a>
                                @if($receta->etapa)
                                <a href="{{ route('receta.inactive', $receta->Id_Receta) }}" class="btnEliminar swal-confirm">Inactivar</a>
                                @else
                                <a href="{{ route('receta.active', $receta->Id_Receta) }}" class="btnEliminar swal-confirm">Activar</a>
                                @endif 
                                </td>
                            @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footerLogin">
    <img class="logo1SenaLogin" src="{{asset('imagenes/proyecto/logoSena.png')}}">
    <p><b>Servicio nacional de aprendizaje <br>
        Centro de la Innovacion, agroindustria y aviacion</b></p>
    <img class="logo3Login" src="{{asset('imagenes/proyecto/logo.svg')}}">
</footer>
@endsection