
@extends('layouts.app')
    @section('style')
        <link rel="stylesheet" href="{{asset('/css/estilosListasChequeo.css')}}">
    @endsection
    @section('content')
<body>


    <div class="formulario">
        <div class="tittle">
            <h2>Lista inicio jornada</h2>
        </div><br>
        <div class="content">
            <form id="" action="{{ route('lista.store') }}" method="POST">
                @csrf
                <label class="tittle-items">Selecciona los elementos:</label><br><br>
                <label class="items-tareas">
                    @foreach ($estado as $tarea)
                    <input type="checkbox" name="items" value="{{$tarea['id']}}">{{$tarea['nombre']}}<br>
                    @endforeach
                </label><br>
                <input class="btn-submit" type="submit" value="Enviar">

            </form>
        </div>
    </div>
</body>
@endsection
