
@extends('layouts.app')
    @section('style')
        <link rel="stylesheet" href="{{asset('/css/estilosListasChequeo.css')}}">
    @endsection
    @section('content')
<body>
    <div class="formulario">
        <div class="tittle">
            <h2>Lista de chequeo de Fin jornada</h2>
        </div>
        <div class="content">
            <form id="form-verificacion" action="{{ route('listafin.store') }}" method="POST">
                @csrf
                <label style="margin: 10px 40px;" class="tittle-items">Selecciona los elementos:</label><br>
                    @foreach ($estado as $tarea)
                    <input style="margin: 15px;" type="checkbox" name="items" value="{{$tarea['id']}}">{{$tarea['nombre']}}<br>
                    @endforeach
                <input style="margin: 20px 40px; background-color:rgba(154, 0, 15); color:white" class="btn-submit" type="submit" value="Enviar">
            </form>
        </div>
    </div>
</body>
@endsection