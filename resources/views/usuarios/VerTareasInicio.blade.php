@extends('layouts.app')
@section('content')
@auth
<div class="container">
    <h2 class="mb-4" style="color: #8B0000; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 30px;">Listas Inicio de Jornada Registradas</h2>
    <div class="row">
        @foreach ($tareasCompletadasPorFecha as $fecha => $tareasCompletadas)
        <div class="col-md-6 mb-4" style="padding: 30px 0px;">
            <div class="card" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #efefef">
                <div class="card-header" style="background-color: #8B0000; color: #fff; border-bottom: none; border-radius: 10px 10px 0 0; text-align: center; padding: 20px;">
                    {{-- <h3 class="card-title" style="height: 40px;">Lista realizada en la fecha: {{ $fecha }} - Cocinero Responsable: {{ $tareasCompletadas->first()->usuario->Nombre }}</h3> --}}
                </div>
                <div class="card-body" style="padding: 20px;">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="max-width: 300px; padding: 10px; text-align: left; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa; color: #495057; font-weight: bold;">Tarea</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tareasCompletadas as $tareaCompletada)
                                <tr>
                                    <td style="max-width: 300px; padding: 10px; text-align: left; border-bottom: 1px solid #dee2e6; word-wrap: break-word;">{{ $tareaCompletada->tarea->nombre }}</td>
                                </tr>
                                @endforeach
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
