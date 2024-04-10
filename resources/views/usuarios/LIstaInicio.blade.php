<?php
use Carbon\Carbon;
$fechaActual = Carbon::now();
?>
@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/estilosListasChequeo.css')}}">
@endsection
@section('content')
@auth
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<body>
    <div class="formulario">
        <div class="tittle">
            <h2>Lista inicio jornada</h2>
        </div>
        <div class="content">
            <form id="form-verificacion" action="{{route('listainicio.store')}}" method="POST">
                @csrf
                <input type="hidden" name="Id_Empleado" value="{{Auth::user()->Id_Empleado}}">
                <label style="margin: 5px 40px;" class="tittle-items">Selecciona los elementos:</label><br><br>
                    @foreach ($formato as $tarea)
                    <input style="margin: 10px 15px;" type="checkbox" name="id_tarea[]" value="{{$tarea['id']}}">{{$tarea['nombre']}}<br>
                    @endforeach
                    
                    <input type="hidden" name="fecha" value="{{Carbon::now()->format('Y-m-d H:i:s')}}">
                   
                <input style="margin: 20px 40px; background-color:rgba(154, 0, 15); color:white" class="btn-submit" type="submit" value="Enviar">
            </form>
        </div>
    </div>
</body>
@endauth
@endsection
