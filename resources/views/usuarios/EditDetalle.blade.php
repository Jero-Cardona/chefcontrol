@extends('layouts.app')

@section('content')
    <div class="card border-danger mb-3">
    <div class="card-header text-center">
        <h1 style="color: red;">Editar Detalle de Orden #{{ $orden->Consecutivo }}</h1>
    </div>
    <div class="card-body">
        <form class="form-group" action="{{ route('ordenes.detalles.update', $orden->Consecutivo) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="Fecha_Pedido">Fecha Pedido:</label>
                <input class="form-control" type="datetime-local" name="Fecha_Pedido" value="{{ $orden->detalles->Fecha_Pedido }}" required>
            </div>
            <div class="form-group">
                <label for="Presentacion">Presentación:</label>
                <input class="form-control" type="text" name="Presentacion" value="{{ $orden->detalles->Presentacion }}" required>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" type="submit">Actualizar Detalle</button>
            </div>
        </form>
    </div>
</div>

@endsection