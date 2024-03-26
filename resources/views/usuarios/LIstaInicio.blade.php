
@extends('layouts.app')
    @section('style')
        <link rel="stylesheet" href="{{asset('/css/estilosListasChequeo.css')}}">
    @endsection
    @section('content')
<body>
{{-- <div class="container-check">
    <div class="dashboard"> 
        <ul>
        <div class="buttons">
            <div class="button1">
                <a href="#"><h1>Recetas</h1></a>
            </div>
            <div class="button2">
                <a href="#"><h1>Sugerencias</h1></a>
            </div>
            <div class="button3">
                <a href="#"><h1>Autorización</h1></a>
            </div>
            <div class="button4">
                <a href="#"><h1>Formatos</h1></a>
            </div>
            <div class="button5">
                <a href="#"><h1>Asignación</h1></a>
            </div>
            <div class="button6">
               <a href="#"><h1>Configuración</h1></a>
            </div>
        </div>
        </ul>
    </div> --}}

    <div class="formulario">
        <div class="tittle">
            <h2>Lista inicio jornada</h2>
        </div><br>
        <div class="content">
            <form id="form-verificacion" action="{{ route('lista.store') }}" method="POST">
                @csrf
                <label class="tittle-items">Selecciona los elementos:</label><br><br>
                <label class="items-tareas">
                    @foreach ($estado as $tarea)
                    <input type="checkbox" name="items" value="{{$tarea['id']}}">{{$tarea['nombre']}}<br>
                    @endforeach
    
                </label>
                <input class="btn-submit" type="submit" value="Enviar"> --}}
                {{-- @foreach($tareasCompletadas as $tareaCompletada) --}}
                {{-- <input type="checkbox" name="tareas[]" value="{{ $tareaCompletada->id }}"> {{ $tareaCompletada->nombre }}<br> --}}
                {{-- @endforeach --}}
                <input class="btn-submit" type="submit" value="Enviar">
                {{-- <input type="hidden" name="Id_Empleado" value="{{ $Id_Empleado }}"> --}}
            </form>
        </div>
    </div>
</body>
@endsection