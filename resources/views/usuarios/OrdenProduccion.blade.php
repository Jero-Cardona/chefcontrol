<?php
use App\Models\tbl_cliente;
use Carbon\Carbon;
use App\Models\tbl_receta;

$recetas = tbl_receta::all();
$fechaActual = Carbon::now();
$clientes = tbl_cliente::all(); 
?>

@extends('layouts.app')
@section('content')
@auth
<div class="card border-danger mb-3">
    <div class="card-header text-center">
        <h1>Orden de producción</h1>
    </div>
    <div class="card-body">
        <form id="frmorden" action="{{route('orden.store')}}" method="POST">
            @csrf
            <fieldset>
                <input type="hidden" name="Fecha"  value="{{ Carbon::now()->format('Y-m-d H:i:s') }}">
                <div class="form-group">
                    <label for="Id_Cliente">Cliente al que se dirige la orden:</label>
                    <select class="form-control" name="Id_Cliente">
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->Id_Cliente }}">{{ $cliente->Nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="Id_Empleado" value="{{Auth::user()->Id_Empleado}}">
                <div class="form-group">
                    <label for="Id_Receta">Seleccione la receta:</label>
                    <select class="form-control" name="Id_Receta">
                        @foreach ($recetas as $receta)
                            <option value="{{ $receta->Id_Receta }}">{{$receta->Nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad de porciones:</label>
                    <input class="form-control" type="number" name="cantidad" value="">
                </div>
                <input type="hidden" name="estado" value="En espera">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Crear Orden</button>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('orden.index') }}" class="btn btn-success">Ver Ordenes De Producción</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endauth
@endsection