
@extends('layouts.app')
    @section('style')
        <link rel="stylesheet" href="{{asset('/css/estilosListasChequeo.css')}}">
    @endsection
    @section('content')
<body>
<<<<<<< HEAD


=======
>>>>>>> jero
    <div class="formulario">
        <div class="tittle">
            <h2>Lista inicio jornada</h2>
        </div>
        <div class="content">
<<<<<<< HEAD
            <form id="" action="{{ route('lista.store') }}" method="POST">
=======
            <form id="form-verificacion" action="{{route('listainicio.store')}}" method="POST">
>>>>>>> jero
                @csrf
                <label style="margin: 5px 40px;" class="tittle-items">Selecciona los elementos:</label><br><br>
                    @foreach ($estado as $tarea)
                    <input style="margin: 10px 15px;" type="checkbox" name="items" value="{{$tarea['id']}}">{{$tarea['nombre']}}<br>
                    @endforeach
<<<<<<< HEAD
                </label><br>
                <input class="btn-submit" type="submit" value="Enviar">

=======
                    <input type="hidden" name="fecha">
                    <input type="hidden" name="Id_Empleado" value="{{Auth::user()->Id_Empleado}}">
                <input style="margin: 20px 40px; background-color:rgba(154, 0, 15); color:white" class="btn-submit" type="submit" value="Enviar">
>>>>>>> jero
            </form>
        </div>
    </div>
</body>
@endsection
