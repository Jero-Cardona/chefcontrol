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
                    <h3 class="titulo">Lista de Clientes</h3>
                    <a href="{{route('clientes.pdf')}}" class="btnEditar" >Descargar pdf</a>
                    <form class="buscador">
                        <input type="text" placeholder="Buscar">
                        <button>Buscar</button>
                    </form>
                </div>
                <div class="divBody">
                    <table class="table">
                        <thead>
                           <tr>
                                <th>Documento</th>
                                <th>Tipo Documento</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Telefono</th>
                                <th>Estado</th>
                                @if(Auth::user()->Id_Rol == '1')
                                <th>Acciones Admin</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{$usuarios = tbl_usuarios::all();}} --}}
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->Id_Cliente }}</td>
                                <td>{{ $cliente->Tipo_identificacion }}</td>
                                <td>{{ $cliente->Nombre }}</td>
                                <td>{{ $cliente->Apellido }}</td>
                                <td>{{ $cliente->Telefono }}</td>
                                <td>{{ $cliente->estado }}</td>
                                @if(Auth::user()->Id_Rol == '1')
                                <td class="crud-active">   
                                <a href="{{ route('cliente.edit', $cliente->Id_Cliente) }}" class="btnEditar swal-edit">Editar</a>
                                @if($cliente->estado)
                                <a href="{{ route('cliente.inactive', $cliente->Id_Cliente) }}" class="btnEliminar swal-confirm">Inactivar</a>
                                @else
                                <a href="{{ route('cliente.active', $cliente->Id_Cliente) }}" class="btnEliminar swal-confirm">Activar</a>
                                @endif   
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                     {{-- Links de paginación --}}
                     @if ($clientes->hasPages())
                     <ul class="pagination">
                         {{-- Botón "Primero" --}}
                         @if (!$clientes->onFirstPage())
                             <li><a href="{{ $clientes->url(1) }}">Primero</a></li>
                         @endif
                 
                         {{-- Botón "Anterior" --}}
                         @if ($clientes->onFirstPage())
                             <li class="disabled"><span>Anterior</span></li>
                         @else
                             <li><a href="{{ $clientes->previousPageUrl() }}">Anterior</a></li>
                         @endif
                         {{-- para mostrar el numero de Items --}}
                         {{$clientes->firstItem()}}
                         de
                         {{$clientes->total()}}
                         {{-- Páginas --}}
                         @foreach ($clientes->items() as $item)
                             @if (is_string($item))
                                 <li class="disabled"><span>{{ $item }}</span></li>
                             @endif
                             @if (is_array($item))
                                 @foreach ($item as $page => $url)
                                     @if ($page == $clientes->currentPage())
                                         <li class="active"><span>{{ $page }}</span></li>
                                     @else
                                         <li><a href="{{ $url }}">{{ $page }}</a></li>
                                     @endif
                                 @endforeach
                             @endif
                         @endforeach
                 
                         {{-- Botón "Siguiente" --}}
                         @if ($clientes->hasMorePages())
                             <li><a href="{{ $clientes->nextPageUrl() }}">Siguiente</a></li>
                         @else
                             <li class="disabled"><span>Siguiente</span></li>
                         @endif
                 
                         {{-- Botón "Último" --}}
                         @if ($clientes->hasMorePages())
                             <li><a href="{{ $clientes->url($clientes->lastPage()) }}">Último</a></li>
                         @endif
                     </ul>
                 @endif
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